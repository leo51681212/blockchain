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
  <h6 id="pay">pay</h6>
    <h6 id="ContractInfo">contractInfo</h6>
      <input type="button" id="Pay_btn" value="Pay" onclick="Pay();"></br>
    <script>
    
        var web3 = new Web3(window.web3.currentProvider);
       
        var Contract;
    
        var abi =[{"constant":true,"inputs":[],"name":"seller","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"value","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"buyer","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"state","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_selleradd","type":"address"}],"name":"Pay","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"inputs":[],"payable":true,"stateMutability":"payable","type":"constructor"},{"anonymous":false,"inputs":[],"name":"Aborted","type":"event"},{"anonymous":false,"inputs":[],"name":"PurchaseConfirmed","type":"event"},{"anonymous":false,"inputs":[],"name":"ItemReceived","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"selleradd","type":"address"},{"indexed":false,"name":"seller","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"LogPurchase","type":"event"}]
        var address = '0xC7Fe30C5A031ecAAe42939d8b63AA317E75f3D06';
            
        
async function init(){
          
            Contract = await new web3.eth.Contract(abi,address);
             document.getElementById("ContractInfo").innerHTML=address;
         }
        init(); 
        async function Pay(){
     document.getElementById("pay").innerHTML="3"; 
document.getElementById("ContractInfo").innerHTML="start of Pay";
Pay1();
            
        }
async function Pay1(){
   
    
       document.getElementById("ContractInfo").innerHTML="start Pay1()";     
     var accounts = await web3.eth.getAccounts();
document.getElementById("pay").innerHTML=accounts[0];

        }
        
   //     document.getElementById('Pay_btn').addEventListener('click',Pay1);
    </script>
</body>
</html>