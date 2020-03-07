<?php
$servername = "127.0.0.1";
$database = "blockchain";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);//連結資料庫
if(!$conn){
	die("Connection failed: " . mysqli_connect_error());//如果連結失敗輸出錯誤
}
$sql="select * from member";
$result = mysqli_query($conn, $sql);

/*if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else
{echo "DB accessed"."</br>"; 
}*/
?>