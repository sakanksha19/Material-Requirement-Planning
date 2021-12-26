<?php
	//define parameters
	$host = "localhost";
	$port;
	$login = "root";
	$password = '';
	$dname = "MRP";

    $con = @new mysqli($host, $login, $password, $dname, $port);
	//Connect to the mysql server

	//Handle connection errors 
	if (mysqli_connect_errno() != 0) {
	    $errno = mysqli_connect_errno();
	    $errmsg = mysqli_connect_error();
	    die("Connect Failed with: ($errno) $errmsg<br/>\n");
	}
?>
<html>
<head> 
    <title>Order</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <style>
    body {
               padding-top: 60px;
               font-size:25px;
               background: blanchedalmond;
        }
    .moneyTransfer{
        color:Black;
        background:#E6E6FA;
        padding: 20px;
        position: fixed;
        top:74%;
        left:50%;
        transform: translate(-50%, -50%);
    }
    * {
  box-sizing: border-box;
}

.row {
  display: flex;
}
.column {
  flex: 33.33%;
  padding: 5px;
}
    </style>   
    <script type="text/javascript">
    
        if(window.history.replaceState){
            
            window.history.replaceState(null, null, window.location.href); 
        }
       
    </script>
</head>
<body>
<img src="bg.jpg" alt="factory" style= "width:100%; height: 90%; position: absolute; z-index:-1; opacity: 0.9">
  <?php include('navbar.php'); ?>
  <div class="row">
   <div class="column">
    <img src="jeans.jpg" alt="jeans" style="width: 95%; height: 50%">
  </div>
  <div class="column">
    <img src="shirt.jpg" alt="shirt" style="width: 95%; height: 50%">
  </div>
  <div class="column">
    <img src="t-shirt.jpg" alt="t-shirt" style="width: 95%; height: 50%">
  </div>
</div>
<div class = 'moneyTransfer'>
    <h1> Order Products</h1>
   
    <form name="myForm" action="ResultPage.php"  onsubmit="return validateForm()" method="post">
        <table id="table1">
        <tr>
            <td>Date</td>
            <td><input type="Date" name="Ddate"   required><td>
        </tr>
        <tr>
            <td>Product ID</td>
            <td><input type="number" name="Pid"  required ><td>
        </tr>
      
        <tr>
            <td>Product </td>
            <td><input type="text" name="Name"  required ><td>
        </tr>
            <td>Requirements </td>
            <td><input type="number" name="req" required><td>
        </tr>
        <tr>
            <td><input type= "hidden" name= "form_submitted" value="1"></td>
            <td> <input type="submit" value="ORDER"><td>
        </tr>
       
        </table>
    </form>
</div>

 <script>
 
 function validateForm() {
            var x = document.forms["myForm"]["Ddate"].value;
            var y = document.forms["myForm"]["Pid"].value;
            var z = document.forms["myForm"]["Name"].value;
            var a = document.forms["myForm"]["req"].value;

          
            if (x == "" || y==""|| z==""||a=="") {
                alert("Fill it!!");
                return false;
            }
           
 }
        
            
 </script>
 
</body>
</html>
