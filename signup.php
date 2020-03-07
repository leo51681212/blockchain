<?php //signup.php 註冊程式--改良
header("Content-Type: text/html; charset=utf8");
if(!isset($_POST['submit'])){
exit("錯誤執行");
}//判斷是否有submit操作
$uname=$_POST['uname'];//post獲取表單裡的name
$pword=$_POST['pword'];//post獲取表單裡的password
$tname=$_POST['tname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$address=$_POST['address'];
include('connect.php');//連結資料庫
$q="INSERT INTO `member`(`uname`, `pword`, `tname`, `email`, `phone`, `address`) VALUES ('$uname','$pword','$tname','$email','$phone','$address')";//向資料庫插入表單傳來的值的sql
$reslut=mysqli_query($conn,$q);//執行sql
if ($reslut){
?>
  <script>
    alert("帳號新增完成...");
    window.open('indexl.html','_blank');
    //window.location.replace('indexl.html');

  </script>
<?php
  }
  else
  {
?>
  <script>
    alert("帳號新增失敗...");
    window.location.href="signup.html";
  </script>
  <?php
   }