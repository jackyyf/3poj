<div id="content">
<div id="left">
<div class="container">
<div class="post">

    <div class="postcontent">
      	<h2>{$result.name}'s INFO</h2>
        <p id="currentrank">Rank: {$result.rank}</p>
        <div id="leftprofile">
        <p>School: {$result.school}</p>
        <p>Email: {$result.email}</p>
        <p>Motto: {$result.motd}</p>
        </div>
        <div id="rightresults">
        <p>Problems solved: <b>{$result.accept}</b></p>
        <p>Total submissions: {$result.submit}</p>
<!--
        <table id="summarytable">
        <tr class="ac">
        	<th>Accepted</th>
            <td></td>
        </tr>
        <tr class="wa">
        	<th>Wrong Answer</th>
            <td></td>
        </tr>
        <tr class="tle">
        	<th>Time Limit Exceed</th>
            <td></td>
        </tr>
        <tr class="mle">
        	<th>Memory Limit Exceed</th>
            <td></td>
        </tr>
        <tr class="re">
        	<th>Runtime Error</th>
            <td></td>
        </tr>
        <tr class="ce">
        	<th>Compile Error</th>
            <td></td>
        </tr>
        </table>
        </div>
-->
        <div id="solvedlist">
        <h3>List of solved problems:</h3>
        {foreach $result.acceptid as $pid}
        	{if $pid === '' }{continue}{/if}
        	<a href="/problemdisplay.php?id={$pid}">{$pid}</a>
        	{if not $pid@last}
        		{if $pid@iteration is div by 10}
	        		<br />
    	    	{else}
        			|
        		{/if}
        	{/if}
        {/foreach}
        </div>
    </div>
  <div class="clear"></div>

</div>
</div>
</div>

<div class="clear"></div>

</div>