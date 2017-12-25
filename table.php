<html>
<h2>What's on your schedule</h2>
<hr>
<body>
<?php
echo ("<input type=button value=\"refresh\" onclick=\"location.reload()\"><p>");
error_reporting(E_ALL);
ini_set("display_errors", 1);

//echo ("MySQL - PHP Connect Test <br/>");
$hostname = "localhost";
$username = "cs20121638";
$password = "dbpass";
$dbname = "db20121638";

$connect = new mysqli($hostname, $username, $password, $dbname) 
     or die("DB Connection Failed");
/* 
if($connect) {
 echo("MySQL Server Connect Success! <br/>");
}
else {
 echo("MySQL Server Connect Failed! <br/>");
}
*/
$cookie_name = "user";
$today= date("Y-m-d");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $date = $_POST["date"];
  $text = test_input($_POST["text1"]);
  $memo = test_input($_POST["text2"]);
}

$cookie = $_COOKIE[$cookie_name];
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
 $id = $_COOKIE[$cookie_name];
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// sql to show table

$sql = "SELECT MEMO, TEXT, LALA FROM SCHEDULE";

$sql_add =  " WHERE LALA between date_add(now(), interval -4 day) and date_add(now(), interval +3 day)";
//$sql_add = " ";
$sql_id = " and USERNAME = '$id' ORDER BY LALA ASC" ;
$sql = $sql . " " . $sql_add . " " . $sql_id;
$result = $connect->query($sql);

if ($result->num_rows > 0) {
 // output data of each row
 echo("<table border= '5' solid black cellspacing='2' cellpadding='3'>");
//
 echo("<tr><td><I><b>DATE</b></I></td>");
 while($row = $result->fetch_assoc()){
  echo("<td>" . $row["LALA"]. "</td>");
 }
 echo("</tr>");
$result = $connect->query($sql);

  echo("<tr><td><I><b>SCHEDULE</b></I></td>");
 while($row = $result->fetch_assoc()){
  echo("<td>" . $row["TEXT"]. "</td>");
 }
 echo("</tr>");
$result = $connect->query($sql);

 echo("<tr><td><I><b>MEMO</b></I></td>");
 while($row = $result->fetch_assoc()){
  echo("<td>" . $row["MEMO"]. "</td>");
 }
 echo("</tr>");


//
 echo("</table>");
} else {
 echo("0 results");
}

// 
$connect->close() ;
?>


</body>
</html>
