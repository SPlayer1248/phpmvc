<?php 
if(isset($_SESSION['level']) === 1){
	echo '<a href="index.php?c=user&a=list">User</a>';
	echo '<br>';
}
echo '<a href="index.php?c=server&a=list">Server</a>';
if (isset($result)) {
	
?>
<form method="post" accept-charset="utf-8">
	<table border="1" align="center">
		<tr>
			<td colspan="7" align="center">Report list!</td>
		</tr>
		<tr>
			<td><b>IP</b></td>
			<td><b>Owner</td>
			<td><b>Host name</b></td>
			<td><b>OS name</b></td>
			<td><b>Open ports</b></td>
			<td><b>Filtered ports</b></td>
			<td><b>Date scan</b></td>
		</tr>
		<?php  
		foreach ($result as $row) {
			echo '<tr>';
				echo '<td>'.$row['ip'].'</td>';
				echo '<td>'.$row['owner'].'</td>';
				echo '<td>'.$row['hostname'].'</td>';
				echo '<td>'.$row['os'].'</td>';
				echo '<td>'.$row['open_ports'].'</td>';
				echo '<td>'.$row['filtered_ports'].'</td>';	
				echo '<td>'.$row['date'].'</td>';	
			echo '</tr>';
		}
		 ?>
	</table>
</form>
<?php 
	} 
?>