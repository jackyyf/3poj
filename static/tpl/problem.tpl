<div id="content">
<div id="left">
<div class="container">
<div class="post">

    <div class="postcontent">
      <h2>Problemset</h2>
 	<div class="problemlist">
    	<table>
        	<tr>
            	<th>ID</th>
                <th>Title</th>
                <th>Submit</th>
                <th>Accepted</th>
        	</tr>
        	{foreach $result as $cnt=>$row}
            <tr class="alt{$cnt%2+1}">
            	<td class="probid">{$row.id}</td>
                <td><a href="/problemdisplay.php?id={$row.id}">{$row.title}</a></td>
                <td class="usersolved">{$row.submit}</td>
                <td class="usersolved">{$row.accept}</td>
            </tr>
            {/foreach}
        </table>
    </div>
    </div>
  <div class="clear"></div>

</div>
</div>
</div>

<div class="clear"></div>

</div>
