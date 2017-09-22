<?php
//上传的文件保存，然后发邮件。记录日志崩溃情况，然后自动上传日志
//问题一：上传文件的类型。
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="uft-8">
	<title>文件上传</title>
</head>
<body>
	<h1>文件上传</h1>
	<form action="interface/uploadLog.php" method="post" enctype="multipart/form-data">
        date<input type="text" name="date">
        <br/>
        appName<input type="text" name="appName">
        <br/>
        appVersionName<input type="text" name="appVersionName">
        <br/>
        appVersionCode<input type="text" name="appVersionCode">
        <br/>
        androidVersion<input type="text" name="androidVersion">
        <br/>
        sdk<input type="text" name="sdk">
        <br/>
        vendor<input type="text" name="vendor">
        <br/>
        model<input type="text" name="model">
        <br/>
		<input type="file" accept="*" name="logFile" id="file" />
		<br/>
		<input type="submit" name="submit" value="Submit" />
</form>
</body>
</html>