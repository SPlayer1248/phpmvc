<html>
<head>
	<title>Add servers</title>
</head>
<body>
	<h2>Add server</h2>
<form action="" method="post">
	IP:<br>
	<input type="text" name="ip"><br>
	<?php if($_SESSION['level'] == 1) {echo 'Owner:<br>
	<input type="text" name="owner"><br>'; }?>
	<input type="submit" name="add" value="Add">
</form>
<br>
or
<br><br>
<form action="" method="post" enctype="multipart/form-data">
    Select file of IPs to upload:
    <input type="file" name="fileIP" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
</body>
</html>