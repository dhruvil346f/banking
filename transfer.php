<?php
include('dbconfig.php');
$result = mysqli_query($con,"SELECT * FROM transaction");
?>
<!DOCTYPE html>
<html>

<head>
    <title> Transfer data</title>
    <style>
        body{
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

<body class="background">
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
if (mysqli_num_rows($result) > 0) {
?>

    <table border=1 style="text-align: center;  ">

        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Email</td>
            <td>Balance</td>
            <td>Transaction</td>

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
            <td>
                <?php echo $row["Balance"]; ?>
            </td>
            <td>
                <form action="usertransaction.php" method="GET">
                    <button name="readId" value="<?php echo $row["Id"]; ?>">Transact</button>
                </form>
            </td>
        </tr>
        <?php
$i++;
}
?>
    </table>
    <?php
}
else{
    echo "No result found";
}
?>
</body>

</html>