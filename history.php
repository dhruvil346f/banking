<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction history</title>
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
<table >
        
            <tr>
                
                <th >Sender</th>
                <th >Reciever</th>
                <th >Amount</th>
                
            </tr>
<?php

include 'dbconfig.php';

$sql ="SELECT * FROM history";

$query =mysqli_query($con, $sql);

while($rows = mysqli_fetch_assoc($query))
{
?>

<tr>

<td ><?php echo $rows['Sender']; ?></td>
<td ><?php echo $rows['Reciever']; ?></td>
<td ><?php echo $rows['Amount']; ?> </td>

    
<?php
}

?>
</tbody>
</table>
    
</body>
</html>


