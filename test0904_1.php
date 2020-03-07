//要抓到carParkbk的值 carParkbk和test0728合併 或 0513_1.carParkbk.test0728分開
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="js/web3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js"></script>
    
</head>
<body>
    <div>
         <?php
            $ID=$_GET['ID'];
            $Owner=$_GET['Owner'];
            $OwnerAddr=$_GET['OwnerAddr'];
            $Address=$_GET['Address'];
            $Image=$_GET['Image'];
            $UnitPrice=(int)$_GET['UnitPrice'];
            $Hour=(int)$_GET['Hour'];
            $Available=$_GET['Available'];

            $Total=$UnitPrice*$Hour;

            echo "ID=".$ID."<br>";
            echo "Owner=".$Owner."<br>";
            echo "OwnerAddr=".$OwnerAddr."<br>";
            echo "Address=".$Address."<br>";
            echo "Image=".$Image."<br>";
            echo "UnitPrice=".$UnitPrice."<br>";
            echo "Hour=".$Hour."<br>";
            echo "Available=".$Available."<br>";

            echo "Total=".$Total."<br>";
        ?>
    </div>
 <div>
    <h2>停車場：<em id="message"></em></h2>
    <input type="text" id="sellerIP" value="<?php echo $Address ?>"></br>
    <input type="text" id="pay" value="<?php echo $Total ?>"></br>
    <input type="button" id="Pay_btn" value="Confirm" onclick="Pay1();"></br>
    <h6 id="ContractInfo">contractInfo</h6>
    <script>
    
        var web3 = new Web3(window.web3.currentProvider);
        var sellerGet = <?php echo $Address ?>;
        var Contract;
    
        var abi =[{"constant":true,"inputs":[],"name":"seller","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"value","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"buyer","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"state","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_selleradd","type":"address"}],"name":"Pay","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"inputs":[],"payable":true,"stateMutability":"payable","type":"constructor"},{"anonymous":false,"inputs":[],"name":"Aborted","type":"event"},{"anonymous":false,"inputs":[],"name":"PurchaseConfirmed","type":"event"},{"anonymous":false,"inputs":[],"name":"ItemReceived","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"selleradd","type":"address"},{"indexed":false,"name":"seller","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"LogPurchase","type":"event"}]
        var address = '0xC7Fe30C5A031ecAAe42939d8b63AA317E75f3D06';
            
        
async function init(){
          
            Contract = await new web3.eth.Contract(abi,address);
         }
        init(); 
async function Pay1(){
    var sellerA=document.getElementById("sellerIP").value;//要seller位置
    var version=web3.version.api;
    document.getElementById("ContractInfo").innerHTML=version;
    var accounts = await web3.eth.getAccounts();
var payvalue=document.getElementById("pay").value;
//var payvalue=2;
        Contract.methods.Pay(sellerA)
            .send({from:accounts[0],value:web3.utils.toWei(payvalue, "finney")})//要payvalue  value=unitprice*hour
            .then(function(data){
                console.log(data);
            })
        }
        
   //     document.getElementById('Pay_btn').addEventListener('click',Pay1);
    </script>
</body>
</html>