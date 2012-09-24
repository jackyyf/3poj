<div id="content">
<div id="left">
<div class="container">
<div class="post">

    <div class="postcontent">
      	<h2>Submit</h2>
 		<form class="submitform" id="form1" method="post" action="action.php?act=submit">
        	<label for="id">Problem ID</label>
 		  	<input id="id" name="id" type="text" value="{$id}" /> 	
            <br/> <br/>
 		    <label for="lang">Language</label>
 		    <select name="lang" id="lang">
 		    	<option value="C++">C++</option>
 		    	<option value="PAS">Pascal</option>
 		    	<option value="C">C</option>
 		    </select>
 		    <br/> <br/>
 		    <label for="code">Source Code</label> <br />
 		    <textarea name="code" id="source_code" cols="45" rows="5"></textarea>
            <br/><br/>
            <input type="submit" value="Submit" />
            
 		  </form>
    </div>
  <div class="clear"></div>

</div>
</div>
</div>

<div class="clear"></div>

</div>