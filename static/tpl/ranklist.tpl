<div id="content">
<div id="left">
<div class="container">
<div class="post">

    <div class="postcontent">
      <h2>Ranklist</h2>
 	<div class="ranklist">
    	<table>
        	<tr>
            	<th>Rank</th>
            	<th>User</th>
                <th>Solved</th>
                <th>Submition</th>
        	</tr>
        	{foreach $result as $row}
            <tr>
            	{$rank = $rank + 1}
            	<td class="rank">{$rank}</td>
				<td class="userid"><a href="/user.php?id={$row.id}">{$row.name}</a></td>
                <td class="usersolved">{$row.accept}</td>
                <td class="usersolved">{$row.submit}</td>
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
