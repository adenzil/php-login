<?php
ob_start();
session_start();

if($_POST['action'] == 'call_this') {

        if(isset($_SESSION["user_id"]))
        {
               
            $userid = $_POST['data'];

            $conn = mysql_connect("127.0.0.1","root","root");
            mysql_select_db("project",$conn);

            $result = array();

            $result1 = mysql_query("SELECT * FROM user_name WHERE id = $userid");    
            $row = mysql_fetch_assoc($result1);
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];

            array_push($result, $firstname);
            array_push($result, $lastname);

            $result2 = mysql_query("SELECT * FROM user_contact WHERE id = $userid");
            $row = mysql_fetch_assoc($result2);
            $c_type = $row['type'];
            $c_value = $row['value'];

            array_push($result, $c_type);
            array_push($result, $c_value);

            $result3 = mysql_query("SELECT * FROM user_add WHERE id = $userid");
            $row = mysql_fetch_assoc($result3);
            $add_type = $row['type'];
            $building_name = $row['building_name'];
            $street_name = $row['street_name'];

            array_push($result, $add_type);
            array_push($result, $building_name);
            array_push($result, $street_name);

            print_r(json_encode($result)); 
        }

        else{
            echo (json_encode("1"));
        }

            

}

if($_POST['action'] == 'adduser') {

    $data = json_decode(stripslashes($_POST['data']));
      
    $conn = mysql_connect("127.0.0.1","root","root");
    mysql_select_db("project",$conn);

    $result = array();

     foreach($data as $d){
         array_push($result, $d);
      }



    $result1 = mysql_query("INSERT INTO users (name, password) VALUES (\"$result[0]\", \"$result[7]\");");

    // $result2 = mysql_query("SELECT id from users where name=$result[0] and password=$result[7]");
    // $rows = mysql_fetch_assoc($result2);
    // $id = $rows['id'];

    $result2 = mysql_query("SELECT id from users where name=\"$result[0]\" and password=\"$result[7]\";");

  if($result2 === FALSE) { 
        die(mysql_error()); // TODO: better error handling
    }

    while($row = mysql_fetch_array($result2))
    {
        $id = $row['id'];
    }

    $result3 = mysql_query("INSERT INTO user_name (id, firstname, lastname) VALUES (\"$id\", \"$result[0]\", \"$result[1]\")");

    $result4 = mysql_query("INSERT INTO user_contact (id, type, value) VALUES (\"$id\", \"$result[2]\", \"$result[3]\")");

    $result5 = mysql_query("INSERT INTO user_add (id, type, building_name, street_name) VALUES (\"$id\", \"$result[4]\", \"$result[5]\", \"$result[6]\")");

    echo $result[0];
    //$firstname = $data[0];
    //echo ($data[0]);

}


if($_POST['action'] == 'search') {

    $t = $_POST['type'];
    $search = $_POST['search'];

    if($t=="building")
    {
        $c = "building_name";
    }
    else{
        $c = "street_name";
    }

    $conn = mysql_connect("127.0.0.1","root","root");
    mysql_select_db("project",$conn);

    $result = array();

    $result1 = mysql_query("SELECT distinct user_name.firstname, user_name.id from user_name inner join user_add on user_name.id=user_add.id where $c=\"$search\"");
    //$row = mysql_fetch_array($result1);

  if($result1 === FALSE) { 
        die(mysql_error());
    }

    while($row = mysql_fetch_array($result1))
    {
        $name = $row['firstname'];
        $id = $row['id'];
        array_push($result, $id);
        array_push($result, $name);
    }

   
    
    print_r(json_encode($result));

}


if($_POST['action'] == 'delete') {

    $id = $_POST['data'];

    $conn = mysql_connect("127.0.0.1","root","root");
    mysql_select_db("project",$conn);

    $result1 = mysql_query("DELETE user_name, user_add FROM user_name, user_add WHERE user_name.id = $id and user_add.id = $id");    


    $result2 = mysql_query("DELETE user_contact FROM user_contact WHERE user_contact.id = $id");


    $result2 = mysql_query("DELETE users FROM users WHERE users.id = $id");

    echo "user deleted";

    
}


if($_POST['action'] == 'loadtable') {

    $conn = mysql_connect("127.0.0.1","root","root");
    mysql_select_db("project",$conn);

    $res=array();
    $result = mysql_query("SELECT id,name FROM users");
    $numrows=mysql_num_rows($result);
    $count = 2;
               while($row = mysql_fetch_assoc($result)) {
                    $a = $row['id'];
                    $b = $row['name'];
                    array_push($res, $a);
                    array_push($res, $b);
                    array_push($res, $count);
                    $count++;
               }
    print_r(json_encode($res));
}

?>