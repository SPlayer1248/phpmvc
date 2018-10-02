<form action="index.php?c=user&a=add" method="post" accept-charset="utf-8">
	<table border="1" align="center">
		<tr>
			<td colspan="2" align="center"><?php 
				if(isset($err)){
					echo $err;
				} else {
					echo 'Add new user';
				}
			 ?>
			</td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" required name="username"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" required name="password"></td>
		</tr>
		<tr>
			<td>Permission</td>
			<td><select required name="level">
				<option  value="0">Normal user</option>
				<option  value="1">Admin</option>
			</select></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="submit" value="Add">
				<input type="reset" value="Reset">
			</td>
		</tr>
	</table>
</form>