 <?php 
 ini_set("max_execution_time", 86400);
 date_default_timezone_set('Asia/Baku');
 header("Content-Type:text/html; charset=UTF-8");
try {
   $db=new PDO("mysql:host=localhost;dbname=kadir;charset=utf8",'root','');
}
catch (PDOExpception $e) {
   echo $e->getMessage();
}
?>