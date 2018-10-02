<?php 
if (isset($result)) {
	
?>
<form method="post" accept-charset="utf-8">
	<table border="1" align="center">
		<tr>
			<td colspan="7">Server list! <a href="index.php?c=server&a=add">Add server (+)</a> <a href="index.php?c=server&a=scanall">Scan all</a> <a href="index.php?c=server&a=list_all_report">View all scan</a></td>
		</tr>
		<tr>
			<td><b>IP</b></td>
			<td><b>Owner</td>
			<td><b>View</b></td>
			<td><b>Scan</b></td>
			<td><b>Edit</b></td>
			<td><b>Delete</b></td>
		</tr>
		<?php  
		foreach ($result as $row) {
			echo '<tr>';
				echo '<td>'.$row['ip'].'</td>';
				echo '<td>'.$row['owner'].'</td>';
				echo '<td><a href="index.php?c=server&a=list_report&ip='.$row['ip'].'">Report</a></td>';
				echo '<td><a href="index.php?c=server&a=scan&ip='.$row['ip'].'&owner='.$row['owner'].'">Scan</a></td>';
				echo '<td><a href="index.php?c=server&a=edit&s='.$row['ip'].'">Edit</a></td>';
				echo '<td><a href="index.php?c=server&a=delete&s='.$row['ip'].'">Delete</a></td>';
			echo '</tr>';
		}
		 ?>
	</table>
</form>
<?php 
	} 
?>