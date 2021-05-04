<?php
include('dbconfig.php');

if(isset($_POST['submit']))
{   
    $amount1=$_POST['amount1'];
    
    $id2=$_POST['amount'];
    $id1=$_GET['readId'];
    
    

    $sql = "SELECT * FROM transaction WHERE id=$id1";
    $query = mysqli_query($con,$sql);
    $result1 = mysqli_fetch_array($query);

    $sql= "SELECT * FROM transaction where id=$id2";
    $query = mysqli_query($con,$sql);
    $result2 = mysqli_fetch_array($query);
    if(($amount1)<0)
    {
        echo '<script type="text/javascript">';
        echo 'alert("Error.Negative values cannot be transferred")';
        echo '</script>';
    }
    else if($amount1 >  $result1['Balance']){
        echo '<script type="text/javascript">';
        echo 'alert("Insufficient Balance")';
        echo '</script>';
    }
    else if($amount1 == 0){
        echo '<script type="text/javascript">';
        echo 'alert("Zero amount cannot be transferred")';
       
        echo '</script>';
    }
    else{
        $newamt = $result1['Balance'] - $amount1;
        $sql = "UPDATE transaction set Balance=$newamt where id=$id1";
        mysqli_query($con,$sql);

        $newamt = $result2['Balance'] + $amount1;
        $sql = "UPDATE transaction set Balance=$newamt where id=$id2";
        mysqli_query($con,$sql);

        $sender = $result1['Name'];
        $receiver = $result2['Name'];
        $sql = "INSERT INTO history VALUES ('$sender','$receiver','$amount1')";
        $query = mysqli_query($con,$sql);

        if($query){
            echo "<script> alert('Transaction Successful');
                window.location='history.php';
                </script>";
        }
        $newamt = 0;
        $amount1 = 0;
    }


}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trsansaction Page</title>
    <style>
        body {
            background-image: url(bg.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-position-y: -200px;


        }



        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 50%;
            margin-top: 88px;
            margin-left: 358px;


        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;

        }

        tr:nth-child(even) {
            background-color: white;
        }

        #transfertext {
            margin-left: 297px;
            position: relative;
            top: 38px;

        }

        #amount {

            position: relative;
            top: 30px;

            left: 347px;
            height: 30px;
            width: 50%;
        }

        #trnsfrvalue{
            
            width: 50%;
            position: relative;
            top: 32px;
            left: 347px;
            height: 30px;
        }
        

        

        #submit {
            position: relative;
            top: 63px;
            left: 642px;
            height: 38px;
            border-radius: 7px;
            width: 129px;


        }
        .navbar {
            display: flex;
            
            }

        .navbar #menu{
         margin-left: 630px;
         font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
         
        }

        .navbar #menu li {
          padding: 23px 23px;
          list-style: none;
          display: inline;
          font-size: 21px;
          
          
          
          
            
        }
        .navbar #menu li #items{
          text-decoration: none;
          color:rgb(250, 78, 16);
            }

        .navbar #header{
            color:rgb(250, 78, 16);
            margin-left: 30px;
            margin-top: 6px;
            
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
    </style>
    
</head>

<body>
<nav>
        
           

        
        <div class="navbar">
            <h1 id="header">Online Banking System</h1>
            <ul id="menu">
                <li><a id="items" href="index.html">Home</a></li>
               
                <li><a id="items" href="transfer.php">Transfer Money</a></li>
                <li><a id="items" href="history.php">Transaction History</a></li>
            </ul>
        </div>
    
    </nav>
    <?php
    include('dbconfig.php');
    $id=$_GET['readId'];
    $result1 = mysqli_query($con,"SELECT Balance FROM transaction where ID='$id'");
    $result = mysqli_query($con,"SELECT * FROM transaction where ID='$id'");

    if(mysqli_num_rows($result1) > 0) {
        $i=0;
while($row = mysqli_fetch_array($result1)) {
        $balance= $row["Balance"];
}
$i++;

    }
    
if (mysqli_num_rows($result) > 0) {
?>


    <table border=1 style="text-align: center;  ">

        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Email</td>
            <td >Balance</td>


        </tr>
        <?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
        <tr>
            <td>
                <?php echo $row["Id"]; ?>
            </td>
            <td>
                <?php echo $row["Name"]; ?>
            </td>
            <td>
                <?php echo $row["Email"]; ?>
            </td>
            <td >
                <?php echo $row["Balance"]; ?>
            </td>
            <?php
$i++;
}
?>
    </table>
    <?php
}

?>
    <br><br>
    <form  method="post">
        
        <div id="transfertext">Transfer to:</div> <br>
        <select name="amount" id="amount"  style="width: 50%; align-content: center; ">
            <?php
    $result3 = mysqli_query($con,"SELECT * FROM transaction where Id<>$id ");
    $i=0;
while($row = mysqli_fetch_array($result3)) {
    $name=$row["Name"];
    

    ?>
            <option name="trnsframt" value="<?php echo $row["Id"]; ?>">
                <?php echo $row["Name"];  echo "      ";echo '('.$row["Balance"].')';?>
            </option>




            <?php
    $i++;
    
}
?>




        </select><br><br><br>

        <div id="transfertext"> Amount:</div><br>
        <input type="number" name="amount1" id="trnsfrvalue">
        <br>
     
     
     
        <input type="submit" value="Transfer" name="submit" id="submit">

    </form>



</body>

</html>