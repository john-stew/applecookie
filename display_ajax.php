<?php
$search_value = $_GET['search_value'];
$search_tag = $_GET['search_tag'];

error_reporting(E_ALL);
ini_set("display_errors", 1);

$hostname = "localhost";
$username = "cs20121638";
$password = "dbpass";
$dbname = "db20121638";

$connect = new mysqli($hostname, $username, $password, $dbname) 
     or die("DB Connection Failed");
//$result = mysql_select_db($dbname,$connect);
 
if($connect) {
// echo("MySQL Server Connect Success! <br/>");
}
else {
 echo("MySQL Server Connect Failed! <br/>");
}

// define variables and set to empty values

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$cookie_name = "user";

if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
 $id = $_COOKIE[$cookie_name];
}

$sql = "SELECT K_VALUE, MEMO, TEXT, LALA FROM SCHEDULE";

$sql_add =  " WHERE $search_tag LIKE '%$search_value%'";
$sql_id = " and USERNAME = '$id'";
//echo("<p>");
if($search_tag != "" && $search_value != ""){
 $sql = $sql . " " . $sql_add . " " . $sql_id;
// echo("search tag : $search_tag <br/>");
// echo("search value : $search_value <br/>");
} else{
 echo("If there's no search tag or value, print total table <br/>");
}
echo("<p>");
$result = $connect->query($sql);

if ($result->num_rows > 0) {
 echo("<html>");
// echo("<script>"); 
// output data of each row
 echo("<table border='3' solid green cellspacing='2' cellpadding='3'");
 echo("<tr>");
 echo("<td>MEMO</td><td>TEXT</td><td>DATE</td><td>delete</td></tr>");

 while($row = $result->fetch_assoc()){
  //echo $row["K_VALUE"]. $row["LALA"];
  echo("<tr>");
  echo("<td>" . $row["MEMO"]. "</td><td>" . $row["TEXT"] . "</td><td>" . $row["LALA"] . "</td><td>");
  echo("<button onclick=");
  $cookie_1 = "Ca";
  $cookie_v1 = $row["K_VALUE"];
  setcookie($cookie_1,$cookie_v1);
  echo(";");
  $cookie_2 = "Cb";
  $cookie_v2 = $row["MEMO"];
  setcookie($cookie_2,$cookie_v2);
  echo(";");
  echo("window.location.href='http://cspro.sogang.ac.kr/~cse20121642/cgi-bin/delete.php'");
  echo(">DELETE</button>");
 echo("</td></tr>");
 }
 echo("</table>");
// echo("</script>");
 echo("</html>");
} else {
 echo("0 results");
}
 
$connect->close() ; 
?>
