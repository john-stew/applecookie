<html>
<body>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo ("MySQL - PHP Connect Test <br/>");
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
$date = $text = $memo = $cookie = "";
$cookie_name = "user";
$today= date("Y-m-d");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $date = $_POST["date"];
  $text = test_input($_POST["text1"]);
  $memo = test_input($_POST["text2"]);
  $friend = test_input($_POST["friend"]);
}
$cookie = $_COOKIE[$cookie_name];

echo $date.$text.$memo.$cookie;
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// sql to insert into table
$sql = "INSERT INTO SCHEDULE (USERNAME, LALA, TEXT, MEMO) 
VALUES ('$cookie','$date','$text','$memo')";

//$sql = "SELECT TEXT FROM SCHEDULE WHERE USERNAME = '$cookie_name' and LALA = '$today'";
//$result = $connect->query($sql); 


if ($connect->query($sql) === TRUE) {

// echo("WELCOM $id! LOG IN OUR SERVICE");
echo "<script>alert(\"Your Schdule has been updated.\");</script>";
//echo "<script> history.back(); </script>";
echo "<script>document.location.href='http://cspro.sogang.ac.kr/~cse20121642/main.html';</script>";

echo(' <input type="button" name="move_to_log_in" value="go to log in page" onclick="location.href=\'http://cspro.sogang.ac.kr/~cse20121642/log_in.html\'";>
');
} else {
 echo("Error: " . $sql . "<br>" . $connect->error);
}
 
$connect->close() ;
?>


</body>
</html>
