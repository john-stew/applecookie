<html>
<body>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//echo ("MySQL - PHP Connect Test <br/>");
$hostname = "localhost";
$username = "cs20121638";
$password = "dbpass";
$dbname = "db20121638";

$connect = new mysqli($hostname, $username, $password, $dbname) 
     or die("DB Connection Failed");
 
if($connect) {
// echo("MySQL Server Connect Success! <br/>");
}
else {
 echo("MySQL Server Connect Failed! <br/>");
}

$id = $pw = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = test_input($_POST["ID"]);
  $pw = test_input($_POST["PW"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//echo "<br>" . $id . "<br>";
$sql = "SELECT * FROM ORDERINFO where name = '$id'";

$result = $connect->query($sql);

if($result->num_rows > 0){
    echo "<script>alert(\"ID is already used.\");</script>";

//echo "<script>document.location.href='http://cspro.sogang.ac.kr/~cse20121642/sign_up.html';</script>";
echo"<script>
   history.back();
</script>";

 } else{
// sql to insert into table
$sql = "INSERT INTO ORDERINFO (NAME, EMAIL) 
VALUES ('$id','$pw')";

if ($connect->query($sql) === TRUE) {
 echo("WELCOM $id! LOG IN OUR SERVICE<p>");
echo(' <input type="button" name="move_to_log_in" value="go to log in page" onclick="location.href=\'http://cspro.sogang.ac.kr/~cse20121642/log_in.html\'";>
');
} else {
 echo("Error: " . $sql . "<br>" . $connect->error);
}
} 

$connect->close() ;
?>


</body>
</html>
