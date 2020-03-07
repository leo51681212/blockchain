<?PHP
header("Content-Type: text/html; charset=utf8");
if(!isset($_POST["submit"])){
exit("錯誤執行");
}//檢測是否有submit操作 
include('connect.php');//連結資料庫
$uname = $_POST['uname'];//post獲得使用者名稱錶單值
$pword = $_POST['pword'];//post獲得使用者密碼單值
if ($uname && $pword){//如果使用者名稱和密碼都不為空
$sql = "select * from member where uname = '$uname' and pword='$pword'";//檢測資料庫是否有對應的username和password的sql
$result = mysqli_query($conn, $sql);//執行sql
$rows=mysqli_num_rows($result);//返回一個數值
if($rows){//0 false 1 true
?>
	<script>
		window.location.href='member.html';
	</script>
<?php
		}
		else{
?>
	<script>
		window.location.href="indexl.html";
	</script>
<?php
		}
	}
	else{
?>
	<script>
		alert("無此帳號...");
		window.location.href="indexl.html";
	</script>
<?php
	}
?>