<?php 
	if(isset($result)) {
 ?>
<form action="index.php?c=user&a=edit&u=<?php echo $result['username'] ?>" method="post" accept-charset="utf-8">
	<table border="1" align="center">
		<tr>
			<td colspan="2" align="center"><?php 
				if(isset($err)){
					echo $err;
				} else {
					echo 'Edit user';
				}
			 ?>
			</td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" required name="username" value="<?php echo $result['username'] ?>"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" required name="password" value="<?php echo $result['password'] ?>"></td>
		</tr>
		<tr>
			<td>Permission</td>
			<td><select required name="level">
				<option <?php if($result['level'] == 0){ echo 'selected';} ?> value="0">Normal user</option>
				<option <?php if($result['level'] == 1){ echo 'selected';} ?> value="1">Admin</option>
			</select></td>
		</tr>
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