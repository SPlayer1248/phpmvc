<?php 
	if(isset($result)) {
 ?>
<form action="index.php?c=server&a=edit&s=<?php echo $result['ip'] ?>" method="post" accept-charset="utf-8">
	<table border="1" align="center">
		<tr>
			<td colspan="2" align="center"><?php 
				if(isset($err)){
					echo $err;
				} else {
					echo 'Edit server';
				}
			 ?>
			</td>
		</tr>
		<tr>
			<td>IP</td>
			<td><input type="text" required name="ip" value="<?php echo $result['ip'] ?>"></td>
		</tr>
		<?php if($_SESSION['level'] == 1) {echo '<tr>
			<td>Owner</td>
			<td><input type="text" required name="owner" value="'.$result['owner'].'"></td>
		</tr>';}?>
		<tr>
			<td colspan="2">
				<input type="submit" name="submit" value="Update">
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
</form>
<?php 
	}
 ?>