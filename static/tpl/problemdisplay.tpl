<div id="content">
<div id="left">
<div class="container">
<div class="post">

    <div class="postcontent">
      	<h2>{$result.title}</h2>
      	<div class="limit">
      		<span>Time limit: {$result.cpulimit} ms</span><br/>
      		<span>Memory Limit: {$result.memlimit} kb</span>
      	</div>
 	<div class="problem_description">
    	{$result.content|escape:"htmlall"}
    </div>
    
    <div class="input_format">
    <h3>Input</h3>
  	{$result.input|escape:"htmlall"}
    </div>
    <div class="output_format">
    <h3>Output</h3>
    {$result.output|escape:"htmlall"}
    </div>
    <div class="note">
    <h3>Hint</h3>
    {$result.hint|escape:"htmlall"}
    </div>
    
    </div>
  	<div class="clear"></div>

	<div class="sample">
    <table>
    <tr>
    	<th>Sample Input</th>
        <th>Sample Output</th>
    </tr>
    <tr>
    	<td><pre>{$result.samplein|escape:"htmlall"}</pre></td>
        <td><pre>{$result.sampleout|escape:"htmlall"}</pre></td>
    </tr>
    </table> <br/>
    </div>
</div>
</div>
</div>
<div id="sidebar">
<div class="container">

<h2 id="submit"><a href="/submit.php?id={$id}">Submit!</a></h2>

<h2>Problem Info</h2>
<div class="latestposts">
<ul class="shadow">
<li>Submissions: {$result.submit}</li>
<li>user solved: {$result.accept}</li>
</ul>
</div>

</div>
</div>

<div class="clear"></div>

</div>