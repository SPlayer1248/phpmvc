<?php 

if (isset($result)) {
	
?>
<form method="post" accept-charset="utf-8">
	<table border="1" align="center">
		<tr>
			<td colspan="5">Server list! <a href="index.php?c=server&a=add">Add server (+)</a></td>
		</tr>
		<tr>
			<td><b>IP</b></td>
			<td><b>Owner</td>
			<td><b>View</b></td>
			<td><b>Edit</b></td>
			<td><b>Delete</b></td>
		</tr>
		<?php  
		foreach ($result as $row) {
			echo '<tr>';
				echo '<td>'.$row['ip'].'</td>';
				echo '<td>'.$row['owner'].'</td>';
				echo '<td>Test</td>';
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