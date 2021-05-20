<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css?V=<?php echo time();?>">
    <title>Abhishek yadav | TSF e-Banking Services</title>
</head>

<body>
<?php

// Connecting to DB
    $servername= "localhost";
    $username= "root";
    $password="";
    $database= "tsf";
    $conn= mysqli_connect($servername, $username, $password, $database);
    if(!$conn){
        die('<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Connection Failed!. Regret for the inconvinience caused.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
    }
    // Creating Connection to Table
        $sql= "SELECT * FROM `tsf`";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            die('<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> Fetching records Failed!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
        }
?>
    <div class="container">
        <div class="left_container">
            <div id="head">
                <img src="images/Bank_logo.png" alt="Logo">
                <div id="title">
                    <span id="titleText1">The Sparks Foundation</span>
                    <span id="titleText2">Banking & Financial Services</span>
                </div>
            </div>

            <div id="footer">
                <span>Copyright &copy;2021 TSF Banking Services</span></br>
                <span>Designed & Developed by <strong title="Abhishek kumar yadav" style="font-family:'Dancing Script';font-size: 1.4rem;font-weight: 700;cursor:pointer;">Abhishek yadav</strong></span></br>
                    <a href="mailto:btech15151.18@bitmesra.ac.in?subject=Mail From TSF Banking Site&body=Hello Developer" target="_blank"><img src="images/email.png" alt="Email" title="Drop me an e-mail"></a>
                    <a href="https://www.linkedin.com/in/abhishek-kumar-yadav-a071aa204/" target="_blank"><img src="images/linkedin.png" alt="LinkedIn" title="Get me on LinkedIn"></a>
            </div>
        </div>
        <div class="right_container">
            <div id="menu">
                <button class="menu_button" onclick="customers()" title="See all Customers"><img src="images/customer.png"> Customers</button>
                <button class="menu_button" onclick="transfers()" title="Check all Transfers"><img src="images/pay.png"> All Transfers</button>
            </div>  

<!-- CUSTOMER TABLE -->

        <div id="customers">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" width="100%">
            <div id="CustomerCard">
                <span id="Card_title">Account Holder Details</span>
                <div><label for="ID">Customer ID:</label> <input type="hidden" id="Customer_ID" name="ID" value=""></input><span class="Card_content"></span></div>
                <div><label for="Name">A/C Holder Name:</label> <input type="hidden" id="Customer_Name" name="Name" value=""></input> <span class="Card_content"> </span></div>
                <div><label for="Balance">Current_Balance:</label> <input type="hidden" id="Current_Balance" name="Balance" value=""></input> <span class="Card_content"> </span></div>
                <hr color="grey" size="1px">
                <span><label for="sendTo">Send To:</label></span>
                <div id="send">
                    <select name="sendTo" id="sendTo">
                    <option value="" default selected hidden>Choose the Reciever</option>
                            <?php
                            $nameQuery= "SELECT * FROM `tsf`";
                            $list = mysqli_query($conn,$nameQuery);
                                while($cNames= mysqli_fetch_array($list)){
                                echo '<option value="'.$cNames['Customer_ID'].'">'.$cNames['Customer_Name'].'</option>';
                                }
                            ?>
                    </select>
                <input type="text" placeholder="Enter Amount" id="amount" name="amount">
                </div>
                <div id="Amount">
                    <button id="transaction" type="Submit" onclick="WDvisible()" title="Send Money">Send Money</button>
                </div>
               
            </div>
        </form>

            <table id="customers_table" cellspacing="4px">
                <tr id="back">
                    <td colspan="5"><button id="Back" onclick="goback()" title="Go Back">&LeftArrow;</button></td>
                </tr>
                <tr id="TableTitle">
                    <td colspan="5">Account Holders</td>
                </tr>
                <tr>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Customer e-Mail</th>
                    <th>Current Balance</th>
                    <th>Status</th>
                </tr>
                <?php
                        while($row=mysqli_fetch_array($result)){                                            
                ?>
                <tr class="customer_rows" onclick="showCard('<?php echo $row['Customer_ID'];?>' ,'<?php echo $row['Customer_Name'];?>', '<?php echo '&#8377; '.$row['Current_Balance'];?>')">
                    <td class="customer_cells" id="Customer_ID"><?php echo $row['Customer_ID'];?></td>
                    <td class="customer_cells" id="Customer_Name"><?php echo $row['Customer_Name'];?></td>
                    <td class="customer_cells" id="Customer_email"><?php echo $row['Customer_email'];?></td>
                    <td class="customer_cells" id="Current_Balance"><?php echo '&#8377; '.$row['Current_Balance'];?></td>
                    <td class="customer_cells" id="Status">
                    <?php
                        if($row['Status']==1){
                            echo '<span style="font-size:2rem;color:rgb(0,255,0);" title="Active">&#8718;</span>';
                        }
                        else{
                            echo '<span style="font-size:2rem;color:rgb(255,0,0);" title="Inactive">&#8718;</span>';
                        }
                    }
                    ?></td>
                </tr>                    
            </table>
        </div>

<!-- TRANSFER TABLE -->
<?php
    $tra= "SELECT * FROM `transfer_table`";
        $res = mysqli_query($conn,$tra);
        if(!$res){
            die('<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> Fetching records Failed!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
        }
?>
    <div id="transfers">
        <table id="transfer_table" cellspacing="4px">
            <tr id="back">
                <td colspan="5"><button id="Back" onclick="goback()" title="Go Back">&LeftArrow;</button></td>
            </tr>
            <tr id="TableTitle">
                <td colspan="6">Transfer History</td>
            </tr>
            <tr>
                <th rowspan="2">Transaction ID</th>
                <th colspan="2">Sender</th>
                <th colspan="2" class="rec">Reciever</th>
                <th rowspan="2">Transfer Amount</th>
            </tr>
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th class="rec">Customer ID</th>
                <th class="rec">Customer Name</th>
            </tr>
            <?php
                        while($Trow=mysqli_fetch_array($res)){                                            
            ?>
            <tr class="customer_rows">    
                <td class="customer_cells" id="Trans_ID"><?php echo $Trow['Trans_ID'];?></td>
                <td class="customer_cells" id="Sender_ID"><?php echo $Trow['Sender_ID'];?></td>
                <td class="customer_cells" id="Sender_Name"><?php echo $Trow['Sender_Name'];?></td>
                <td class="customer_cells" id="Receiver_ID"><?php echo $Trow['Receiver_ID'];?></td>
                <td class="customer_cells" id="Receiver_Name"><?php echo $Trow['Receiver_Name'];?></td>
                <td class="customer_cells" id="Trans_Amount"><?php echo '&#8377; '.$Trow['Trans_Amount'];?></td>
            </tr>                    
            <?php
                        }
            ?>
        </table>
    </div>
</div>
<script type="text/javascript">
       
    function goback(){
        document.getElementById("customers").style.display="none";
        document.getElementById("transfers").style.display="none";
        document.getElementById("menu").style.display="flex";
    }
    function customers(){
        document.getElementById("customers").style.display="block";
        document.getElementById("CustomerCard").style.display="none";
        document.getElementById("menu").style.display="none";
    }
    function transfers(){
        document.getElementById("transfers").style.display="block";
        document.getElementById("menu").style.display="none";
    }
    function WDvisible(){
        <?php
        $amount=0;
        $SenderBalance=0;
        $RBal=0;
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $SenderId=$_POST['ID'];
                $SenderName=$_POST['Name'];
                $SenderBalance=$_POST['Balance'];
                $RecieverID=$_POST['sendTo'];
                $amount=$_POST['amount'];

        $getRName="SELECT * FROM tsf WHERE Customer_ID='$RecieverID'";
        $Reciever=mysqli_fetch_array(mysqli_query($conn,$getRName));
        $RBal=$Reciever['Current_Balance'];
       
        //Sender's DATA fetching
        $getRName="SELECT * FROM tsf WHERE Customer_ID='$SenderId'";
        $Senders=mysqli_fetch_array(mysqli_query($conn,$getRName));
if( (int)$Senders['Current_Balance'] > $_POST['amount'] and (int)$Senders['Current_Balance']>0 )
{
        $sent= (int)$Senders['Current_Balance'] - $_POST['amount'];
       
$amountupdate1="UPDATE `tsf` SET `Current_Balance` = '$sent' WHERE `tsf`.`Customer_ID` = '$SenderId'";
        $r1=mysqli_query($conn,$amountupdate1);

        //To Transaction Table
        $transfer = "INSERT INTO transfer_table(Sender_ID, Sender_Name, Receiver_ID, Receiver_Name, Trans_Amount) VALUES ('$SenderId','$SenderName','$RecieverID','$Reciever[Customer_Name]','$amount')";
                $r2 = mysqli_query($conn,$transfer);
               
        //Reciever's DATA fetching
                $Recieve= (int)$RBal + $_POST['amount'];
        $amountupdate2="UPDATE `tsf` SET `Current_Balance` = '$Recieve' WHERE `tsf`.`Customer_ID` = '$RecieverID'";
                $r=mysqli_query($conn,$amountupdate2);
            }
}
else{
    echo 'alert("Insufficient Funds!");';
}
        ?>
    }
    function showCard(){
        document.getElementById("CustomerCard").style.display="flex";
        document.getElementById("CustomerCard").getElementsByClassName("Card_content")[0].innerText=arguments[0];
        document.getElementById("CustomerCard").getElementsByTagName("input")[0].value=arguments[0];
        document.getElementById("CustomerCard").getElementsByClassName("Card_content")[1].innerText=arguments[1];
        document.getElementById("CustomerCard").getElementsByTagName("input")[1].value=arguments[1];
        document.getElementById("CustomerCard").getElementsByClassName("Card_content")[2].innerText=arguments[2];
        document.getElementById("CustomerCard").getElementsByTagName("input")[2].value=arguments[2];
    }
</script>
</body>
</html>