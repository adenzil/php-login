<?php
	session_start();
	$message="";
	if(count($_POST)>0) {
		$conn = mysql_connect("127.0.0.1","root","root");
		mysql_select_db("project",$conn);
		$result = mysql_query("SELECT * FROM users WHERE name='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
		$row  = mysql_fetch_array($result);
		if(is_array($row)) {
			$_SESSION["user_id"] = $row[id];
			$_SESSION["user_name"] = $row[name];
		}
		else {
			$message = "Invalid Username or Password!";
	}
	}
	if(isset($_SESSION["user_id"])) {
		header("Location:data.php");
	}
?>
<html>
<head>
	<title>User Login</title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
	<link rel="icon" type="image/png" href="http://cdn.appstorm.net/mac.appstorm.net/files/2012/07/icon4.png">
</head>
<body>
<form name="frmUser" method="post" action="">
	</br></br>
	</div>
	<table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
		<tr class="tableheader">
			<td align="center" colspan="2">Enter Login Details</td>
		</tr>
		<tr class="tablerow">
			<td align="right">Username</td>
			<td><input type="text" name="user_name"></td>
		</tr>
		<tr class="tablerow">
			<td align="right">Password</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr class="tableheader">
			<td align="center" colspan="2"><input type="submit" name="submit" value="Submit"></td>
		</tr>
	</table>
</form>
<div class="message"><?php if($message!="") { echo $message; } ?>
</body>
</html>