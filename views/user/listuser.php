<?php 
if(isset($_SESSION['level']) === 1){
	echo '<a href="index.php?c=server&a=list">Server</a>';
}
if (isset($result)) {
	
?>
<form method="post" accept-charset="utf-8">
	<table border="1" align="center">
		<tr>
			<td colspan="5">User list! <a href="index.php?c=user&a=add">Add user (+)</a></td>
		</tr>
		<tr>
			<td><b>Username</b></td>
			<td><b>Password</td>
			<td><b>Level</b></td>
			<td><b>Edit</b></td>
			<td><b>Delete</b></td>
		</tr>
		<?php  
		foreach ($result as $row) {
			echo '<tr>';
				echo '<td>'.$row['username'].'</td>';
				echo '<td>'.$row['password'].'</td>';
				echo '<td>'.$row['level'].'</td>';
				echo '<td><a href="index.php?c=user&a=edit&u='.$row['username'].'">Edit</a></td>';
				echo '<td><a href="index.php?c=user&a=delete&u='.$row['username'].'">Delete</a></td>';
			echo '</tr>';
		}
		 ?>
	</table>
</form>
<?php 
	} 
?>