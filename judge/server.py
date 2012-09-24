#!/usr/bin/python2

import multiprocessing, socket, hashlib, MySQLdb, sys, select, ctypes, Queue, time, struct, signal

# Add missing EPOLL Event EPOLLRDHUP
if not "EPOLLRDHUP" in dir(select):
	select.EPOLLRDHUP = 0x2000
# Event Added

servcurVersion = [0, 0, 1, 24]
clntminVersion = [0, 0, 1, 24]
clntmaxVersion = [0, 0, 9999, 9999]

def VersionComp(clientVersion):
	global clntminVersion, clntmaxVersion
	if len(clientVersion) != 4:
		return 0x80000000
	for i in range(0, 4):
		clientVersion[i] = int(clientVersion[i])
		if clientVersion[i] > clntmaxVersion[i]:
			return 1
		elif clientVersion[i] < clntminVersion[i]:
			return -1
	return 0

mysqlconf = {
	"host": "localhost",
	"port": 3306,
	"user": "root",
	"pass": "meiyoumima",
	"dbname": "pjudge",
	"prefix": "pj_",
	"charset": "utf8"
}

serverconf = {
	"address": "",
	"port": 1046,
	"keepalive": 30,
}

status = {}

class ClientStatus():
	def __init__(self, socketid):
		self.socketid = socketid
		self.id = -1
		self.idle = False
		self.login = False

def getStatus(socketid):
	global status
	if status.has_key(socketid):
		return status.get(socketid)
	else :
		status[socketid] = ClientStatus(socketid)
		return status.get(socketid)

class MyError:
	pass

def mySend(socket, message):
	socket.sendall(struct.pack("!i", len(message)) + message)

def myRead(socket):
	l = clientSocket.recv(4)
	if l == '': # socket closed, no data can be read
		raise MyError
	l = struct.unpack("!i", l)
	ret = ''
	while l > 0:
		data = clientSocket.recv(l)
		if data == '':
			raise MyError
		ret += data
		l -= len(data)
	return ret

class Judge:
	pass

class Server:
	def __init__(self):
		global serverconf, mysqlconf
		self.judgePool = multiprocessing.Queue()
		print >>sys.stderr, "Connecting to MySQL Server..."
		try:
			self.mysqlconn = MySQLdb._mysql.connect(host = mysqlconf["host"], port = mysqlconf["port"], user = mysqlconf["user"], passwd = mysqlconf["pass"], db = mysqlconf["dbname"])
		except:
			print >>sys.stderr, "MySQL Server Connect Failed."
			exit()
		print >>sys.stderr, "Connect Successfully"
		print >>sys.stderr, "Initializing network..."
		self.socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		self.socket.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
		try:
			self.socket.bind((serverconf["address"], serverconf["port"]))
		except:
			print >>sys.stderr, "Unable to bind on port", serverconf["port"]
			exit()
		print >>sys.stderr, "Bind to port", serverconf["port"], "successfully."
		self.socket.listen(5)
		self.status = multiprocessing.Value('b', True)
		self.terminated = multiprocessing.Value('b', False)
		#print >>sys.stderr, "Waiting for incoming connection..."
	
	def main(self):
		self.mysqlThread = multiprocessing.Process(target = self.mysqlProcess, args = (self.mysqlconn, self.judgePool), name = "mysqlThread")
		self.mysqlThread.daemon = True
		self.mysqlThread.start()
		self.epoll = select.epoll()
		self.acceptThread = multiprocessing.Process(target = self.acceptProcess, args = (self.socket.fileno(), self.epoll.fileno()), name = "acceptThread")
		self.acceptThread.daemon = True
		self.acceptThread.start()
		self.workPool = multiprocessing.Pool(processes = 5)
		while self.status.value:
			ok = self.epoll.poll()
			for i in range(0, len(ok)):
				ok[i] = ok[i] + (getStatus(ok[i][0]), )
			self.workPool.map_async(func = self.workProcess, iterable = ok, callback = workFinalize)

	def acceptProcess(self, socketno, epollno):
		serverSocket = socket.fromfd(socketno, socket.AF_INET, socket.SOCK_STREAM)
		epollHandler = epoll.fromfd(epollno)
		print >>sys.stderr, "Accept Thread Started."
		while self.status.value:
			client, address = serverSocket.accept()
			print >>sys.stderr, "Connection Accepted From [" + address[0] + ':' + str(address[1]) + "]"
			epollHandler.register(client.fileno(), select.EPOLLIN | select.EPOLLOUT | select.EPOLLRDHUP)
		
	def mysqlProcess(self, conn, queue):
		global mysqlconf
		print >>sys.stderr, "MySQL Polling Thread Started."
		while True:
			qstring = "SELECT id FROM " + mysqlconf["prefix"] + "pending WHERE status=1"
			conn.query(qstring)
			res = conn.store_result()
			while True:
				row = res.fetch_row()
				if not row:
					break
				print >>sys.stderr, "Adding", row[0][0], "to pending queue."
				try:
					queue.put_nowait(row[0][0])
				except Queue.Full:
					print >>sys.stderr, "Pending Queue is full. Keeping back in MySQL database."
					continue
				qstring = "UPDATE " + mysqlconf["prefix"] + "pending SET status=0 WHERE id=" + row[0][0] + " LIMIT 1"
				conn.query(qstring)
			time.sleep(3)

	def workProcess(self, action):
		status = action[2]
		clientSocket = socket.fromfd(action[0], socket.AF_INET, socket.SOCK_STREAM)
		_event = action[1]
		if _event & (select.EPOLLERR | select.EPOLLHUP | select.EPOLLRDHUP): # Error occured or socket closed
			return (False, action[0])
		"""
		l = clientSocket.recv(4)
		if l == '': # socket closed, no data can be read
			return (False, action[0])
		l = struct.unpack("!i", l)
		data = clientSocket.recv(l)
		"""
		try:
			data = myRead(clientSocket)
		except MyError:
			return (False, action[0])
		command = data[:4]
		if command == 'CLNT':
			version = data[5:].split(" ")
			res = VersionComp(version)
			if res == 0x80000000:
				response = "103 Version Not Valid\n"
				clientSocket.sendall(struct.pack("!i", len(response)) + response)
				return (False, action[0])
			elif res == -1:
				response = "101 Client out of date. Please upgrade your client."
				

	def workFinalize(self, result):
		if not result[0]:
			clientsocket = socket.fromfd(result[1], socket.AF_INET, socket.SOCK_STREAM)
			clientsocket.shutdown()
			clientsocket.close()
			del status[result[1]]
		else :
			global status
			status[result[1]] = result[2]
			

	def cleanUp():
		pass

class MySQL:
	pass

def cleanUp(_signal = None, _frames = None):
	global server
	server.status.value = False
	print "Caught SIGTERM, Server closing..."
	while not server.terminated.value:
		time.sleep(1)
	print "All Process Terminated. Server exiting..."
	return True


server = Server()
