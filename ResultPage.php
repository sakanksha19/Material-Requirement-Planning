<?php
	//define parameters
	$host = "localhost";
	$port;
	$login = "root";
	$password = '';
	$dname = "MRP";

    $con = @new mysqli($host, $login, $password, $dname, $port);
	//Connect to the mysql server
	
    $sql = "SELECT * FROM DemandTable" ;
    $result = $con->query($sql);

	//Handle connection errors 
	if (mysqli_connect_errno() != 0) {
	    $errno = mysqli_connect_errno();
	    $errmsg = mysqli_connect_error();
	    die("Connect Failed with: ($errno) $errmsg<br/>\n");
	}
?>

<html>
<head> 
    <title>Demand</title>
    <style>
    body {
               padding-top: 60px;
               font-size:25px;
               background: blanchedalmond;
        }
    .center{
      
        padding-top:5px;
        display: block;
        margin-top: 20px;
        margin-left: auto;
        margin-right: auto;    
    }
    .center2{
        font-size:20px;
        width:100%;
    }
    table {
    margin: 0 auto;
  }
    td,th { border: 1px solid #ddd; padding: 8px;}
    #Table{ font-family: Arial, sans-serif; border-collapse: collapse;}
    #Table tr:nth-child(even){ background-color: #d2d3d4; }
    #Table tr:nth-child(odd){ background-color: #dee2e3; }
    #Table tr:hover{ background-color: #b5d0eb; }
    #Table th { padding-top: 12px; padding-bottom: 12px; text-align:left; background-color:  #608fb3; color:white; }

    </style>    
     <script type="text/javascript">
    
    if(window.history.replaceState){
        
        window.history.replaceState(null, null, window.location.href); 
    }
    
</script>
</head>
<body>
<img src="bg.jpg" alt="not found" style= "width:100%; height: 100%; position: absolute; z-index:-1; opacity: 0.7">
<?php include('navbar.php'); ?>
<?php 
  // order

  if(isset($_POST['form_submitted']))
  {
      $DATE = $_POST['Ddate'];
      $Product_No = $_POST['Pid'];
      $NAME = $_POST['Name'];
      $Requirement = $_POST['req'];

      if(empty($DATE) || empty($Product_No) || empty($Requirement)|| empty($NAME)){       
        echo "<script> alert('Empty Fields !!');
        window.location.href='Order.php';
        </script>";  
        exit() ;           
      }
    

      $InsertDemandtable= "Insert into DemandTable VALUES ('$DATE' , '$Product_No', '$NAME', '$Requirement')";
    
            if($con->query($InsertDemandtable)==true){
                    ?> 
                   <img class ="center" src="Imgc.png" alt=""  height="250" width="250">
                   <h1 style="text-align: center; font-size: 60px; padding-top: 0px">Thank you for your order<h1>
                    <?php

     
             }
             else{
              ?> 
              <script>alert("Error!!")</script>
              <?php
             }
    }

    // demand;
    if(isset($_POST['form_submit']))
    {
        $DATE = $_POST['Ddate'];
       
        if(empty($DATE)){       
          echo "<script> alert('Empty Fields !!');
          window.location.href='Order.php';
          </script>";  
          exit() ;           
        }
        else{
            ?> 
        <script>alert($DATE)</script>
        <?php
        }
        
        $yarnCount=0;
        $dyesCount=0;
        $fabricsCount=0;
        $decorativeCount=0;

        $yarnsTotalPrice=0;
        $dyesTotalPrice=0;
        $fabricsTotalPrice=0;
        $decorativeTotalPrice=0;


       
        // query for product value;

        $sqls = "Select sum(ProductReq) from DemandTable where Demanddate<='$DATE' AND  Product_id = 101"; 
        $sqlj = "Select sum(ProductReq) from DemandTable where Demanddate<='$DATE' AND  Product_id = 102"; 
        $sqlt = "Select sum(ProductReq) from DemandTable where Demanddate<='$DATE' AND  Product_id = 103"; 
        
        $shirt=0;
        $jeans=0;
        $Tshirt=0;

        if($result1 = $con->query($sqls)){            
            $row1 = $result1->fetch_array(); 
            $shirt=$row1['sum(ProductReq)'];

            //   echo $shirt ;
                                
         }   
         
         if($result2 = $con->query($sqlj)){            
            $row2 = $result2->fetch_array(); 
            $jeans=$row2['sum(ProductReq)'];

              // echo $jeans ;
                                
         }  
         
         if($result3 = $con->query($sqlt)){            
            $row3 = $result3->fetch_array(); 
            $Tshirt=$row3['sum(ProductReq)'];

            //echo $Tshirt ;
                                
         }  
      
         $prods = "Select * from Materialrequirements where Product_id = 101"; 
         $prodj = "Select * from Materialrequirements where Product_id = 102"; 
         $prodt = "Select * from Materialrequirements where Product_id = 103";
         
         if($res1 = $con->query($prods)){            
            $row1 = $res1->fetch_array(); 
           
            $yarnCount=$yarnCount+($shirt*$row1['Yarns']);
            $dyesCount=$dyesCount+($shirt*$row1['DYES']);
            $fabricsCount=$fabricsCount+($shirt*$row1['Fabrics']);
            $decorativeCount=$decorativeCount+($shirt*$row1['Decoratives']);

         }  

         if($res2 = $con->query($prodj)){            
            $row2 = $res2->fetch_array(); 
           
            $yarnCount=$yarnCount+($jeans*$row2['Yarns']);
            $dyesCount=$dyesCount+($jeans*$row2['DYES']);
            $fabricsCount=$fabricsCount+($jeans*$row2['Fabrics']);
            $decorativeCount=$decorativeCount+($jeans*$row2['Decoratives']);

         }  

         if($res3 = $con->query($prodt)){            
            $row3 = $res3->fetch_array(); 
           
            $yarnCount=$yarnCount+($Tshirt*$row3['Yarns']);
            $dyesCount=$dyesCount+($Tshirt*$row3['DYES']);
            $fabricsCount=$fabricsCount+($Tshirt*$row3['Fabrics']);
            $decorativeCount=$decorativeCount+($Tshirt*$row3['Decoratives']);

         }  
         
         $totalProducts=$shirt+$jeans+$Tshirt;
         $totalBill=0;

         // prices

         $priceY = "Select * from  PriceTable where Material = 'Yarns'"; 
         
       //  echo $totalProducts;

       // Date:2022-01-06
    //    YARNS REQUIREMENT:750           
    //    YARNS BILL:7500 

    //    DYES REQUIREMENT:750 
    //    DYES BILL:3750 

    //    FABRICS REQUIREMENT:1075           
    //    FABRICS BILL:16125 

    //    DECORATIVES REQUIREMENT:1100   
    //    DECORATIVES BILL:22000 

    //    TOTAL NUMBER OF ORDERS:60 
    //    TOTAL BILL:₹49375 

    // check remaining;

    $remY = "Select * from  availableData where Material = 'Yarns'"; 

    if($r1 = $con->query($remY)){            
     $r1 = $r1->fetch_array(); 
     $yarnCount=$yarnCount-$r1['rem'];
    } 

    $remdy = "Select * from  availableData where Material = 'Dyes'"; 

    if($r2 = $con->query($remdy)){            
     $r2 = $r2->fetch_array(); 
     $dyesCount=$dyesCount-$r2['rem'];
    }

    $remF = "Select * from  availableData where Material = 'Fabrics'"; 

    if($r3 = $con->query($remF)){            
     $r3 = $r3->fetch_array(); 
     $fabricsCount=$fabricsCount-$r3['rem'];

    } 

    $remD = "Select * from  availableData where Material = 'Decoratives'"; 

    if($r4 = $con->query($remD)){            
     $r4 = $r4->fetch_array(); 
     $decorativeCount=$decorativeCount-$r4['rem'];

    }

    $priceY = "Select * from  PriceTable where Material = 'Yarns'"; 

       if($r1 = $con->query($priceY)){            
        $r1 = $r1->fetch_array(); 
        $yarnsTotalPrice=$yarnCount*$r1['price'];
       }  
      
       //echo $yarnsTotalPrice;
        
       $pricedy = "Select * from  PriceTable where Material = 'Dyes'"; 
         
       //  echo $totalProducts;

       if($r2 = $con->query($pricedy)){            
        $r2 = $r2->fetch_array(); 
        $dyesTotalPrice=$dyesCount*$r2['price'];
       }  

       $priceF = "Select * from  PriceTable where Material = 'Fabrics'"; 


       if($r3 = $con->query($priceF)){            
        $r3 = $r3->fetch_array(); 
        $fabricsTotalPrice=$fabricsCount*$r3['price'];

       }  
       
       $priceD = "Select * from  PriceTable where Material = 'Decoratives'"; 

       if($r4 = $con->query($priceD)){            
        $r4 = $r4->fetch_array(); 
        $decorativeTotalPrice=$decorativeCount*$r4['price'];

       }  

       // total bill;

        $totalBill=$yarnsTotalPrice+$dyesTotalPrice+$fabricsTotalPrice+$decorativeTotalPrice;
        
        


        echo "<div id='Printable'  style=' font-size: 20px; padding-top: 0px;margin: 0px 0px 0px 0px ; font-weight:bold' >
        <pre>------------------------------------------------------------------------------------------------------------------</br>  
                                                 Total Price 
                                               Date:$DATE
        </br>------------------------------------------------------------------------------------------------------------------</br>
                                          YARNS REQUIREMENT:$yarnCount           
                                          YARNS BILL:₹$yarnsTotalPrice <br /> 
                                          DYES REQUIREMENT:$dyesCount 
                                          DYES BILL:₹$dyesTotalPrice <br /> 
                                          FABRICS REQUIREMENT:$fabricsCount           
                                          FABRICS BILL:₹$fabricsTotalPrice <br />
                                          DECORATIVES REQUIREMENT:$decorativeCount   
                                          DECORATIVES BILL:₹$decorativeTotalPrice </br > 
                                          TOTAL NUMBER OF ORDERS:$totalProducts 
                                          TOTAL BILL:₹$totalBill 
        </br>-------------------------------------------------------------------------------------------------------------------</pre> 
            <input class='btn btn-primary' style='position: absolute;  /> 
         </div> ";
    }

    $con->close();
?>          
</body>
</html>
