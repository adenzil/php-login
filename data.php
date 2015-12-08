<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome <?php echo $_SESSION["user_name"]; ?></title>
	<link rel="icon" type="image/png" href="http://cdn.appstorm.net/mac.appstorm.net/files/2012/07/icon4.png">
 	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.js"></script>
  	<script type="text/javascript" src="abc.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>

<div id="top">
	<table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
		<tr class="tableheader">
			<td align="center">User Dashboard</td>
		</tr>
		<tr class="tablerow">
			<td>
				<?php
				if($_SESSION["user_name"]) {
					?>
					Welcome <b><font size="5"color="black"><?php echo $_SESSION["user_name"]; ?></font></b>. Click here to <a href="logout.php" tite="Logout">Logout.</a>
					<?php
				}
				else{
					header("Location:index.php");
				}
				?>
			</td>
		</tr>
	</table>
</div>

</br></br></br>

<script>var count=1;</script>

<div id="mid">

	<div id="midleft" >
		<table border="0" cellpadding="10" cellspacing="1" width="500" align="center" id="users">
		<tr>
			<th>ID</th>
			<th>NAME</th>
		</tr>
        <tr> </tr>
		</table>
	</div>

	<div id="midright">
		<!-- <button onclick="myFunction(count,'',count++)" id="adduser">Add user</button> -->
		<div class="main-content">
    		<a class="show-popup" href="#" data-showpopup="1" >Add new user</a>
		</div>

		<div class="overlay-bg">
		</div>

		<div class="overlay-content popup1">
		   	FIRST NAME : <input type="text" id="addfirstname"></input>
            </br></br>
            LAST NAME : <input type="text" id="addlastname"></input>
            </br></br>
            <select id="addnum">
					<option value="mobile">Mobile</option>
					<option value="landline">landline</option>
			</select>
            Number : <input type="number" id="addnumber"></input>
            </br></br>
            <select id="addhouse">
					<option value="permanent">Permanent</option>
					<option value="temporary">Temporary</option>
			</select>
			<br><br>
            BUILDING : <input type="text" id="addbuildingname"></input>
            </br></br>
            STREET : <input type="text" id="addstreetname"></input>
            </br></br>
            Password : <input type="password" id="pwd"></input>
            </br></br>
            <button id="addnew">SAVE</button>
		    <button class="close-btn">Close</button>
		</div>

		<div id="search">
			</br></br>
		    </br></br>
		    SEARCH :
		    </br></br>
			<select id="searchselect">
				<option value="building">building</option>
				<option value="street">street</option>
			</select>
			</br></br>
			<input type="text" placeholder="type here to search" id="searchhere"></input>
		</div>
		</br></br>
		<div id="result">
		</div>

	</div>

</div>

</br></br></br>

<div id="bottom">
	<div class="tabs">

    <ul class="tab-links">
        <li class="active"><a href="#tab1">NAME</a></li>
        <li><a href="#tab2">CONTACT</a></li>
        <li><a href="#tab3">ADDRESS</a></li>
    </ul>
 
    <div class="tab-content">
        <div id="tab1" class="tab active">
            FIRST NAME : <input type="text" id="editfirstname"></input>
            </br></br>
            LAST NAME : <input type="text" id="editlastname"></input>
            <button id="save_name">SAVE</button>
        </div>
 
        <div id="tab2" class="tab">
           	<select id="num">
					<option value="mobile">Mobile</option>
					<option value="landline">landline</option>
			</select>
            Number : <input type="text" id="number"></input>
            <button id="save_address">SAVE</button>
        </div>
 
        <div id="tab3" class="tab">
        	<select id="house">
					<option value="permanent">Permanent</option>
					<option value="temporary">Temporary</option>
			</select>
			<br><br>
            BUILDING : <input type="text" id="buildingname"></input>
            STREET : <input type="text" id="streetname"></input>
            <button id="save_address">SAVE</button>
        </div>

    </div>
</div>
</div>


</body>
</html>