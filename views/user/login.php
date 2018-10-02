
<form action="index.php?c=user&a=login" method="post">
	<div>
		<?php
			if(isset($err)){
				echo $err;
			}
		 ?>
	</div>
	Username:<br>
	<input type="text" name="username"><br>
	Password:<br>
	<input type="text" name="password"><br><br>
	<input type="submit" name="submit" value="Login">
</form>
