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
 
if($connect) {
 echo("MySQL Server Connect Success! <br/>");
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

echo "<br>" . $id . "<br>";
$sql = "SELECT * FROM ORDERINFO where name = '$id' and email = '$pw'";

$result = $connect->query($sql);

if($result->num_rows > 0){ // id ok
    echo "<script>alert(\"log in!\");</script>";
$cookie_name = "user";
$cookie_value = $id;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

echo "<script>document.location.href='http://cspro.sogang.ac.kr/~cse20121642/main_frame.html';</script>";
 } else{
    echo "<script>alert(\"CHECK YOUR ID OR PW AGAIN!\");</script>";

//echo "<script>document.location.href='http://cspro.sogang.ac.kr/~cse20121642/log_in.html';</script>";
echo "<script>
   history.back();
</script>";
} 

$connect->close() ;
?>


</body>
</html>
