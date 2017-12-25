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
$cookie1 =$cookie2 = "";
$cookie_name1 = "Ca";
$cookie_name2 = "Cb";
$today= date("Y-m-d");

$cookie1 = $_COOKIE[$cookie_name1];
$cookie2 = $_COOKIE[$cookie_name2];
//echo $date.$text.$memo.$cookie;
// sql to insert into table
//$sql = "INSERT INTO SCHEDULE (USERNAME, LALA, TEXT, MEMO) 
//VALUES ('$cookie','$date','$text','$memo')";

$sql = "DELETE FROM SCHEDULE WHERE K_VALUE = $cookie1";
$result = $connect->query($sql); 

//echo $cookie;
if ($connect->query($sql) === TRUE) {

// echo("WELCOM $id! LOG IN OUR SERVICE");
echo "<script>alert(\"Your Schdule has been updated.\");</script>";
echo "<script> history.back(); </script>";
//echo "<script>document.location.href='http://cspro.sogang.ac.kr/~cse20121642/search2.html';</script>";

echo(' <input type="button" name="move_to_log_in" value="go to log in page" onclick="location.href=\'http://cspro.sogang.ac.kr/~cse20121642/log_in.html\'";>
');
} else {
 echo("Error: " . $sql . "<br>" . $connect->error);
}
 
$connect->close() ;
?>


</body>
</html>
