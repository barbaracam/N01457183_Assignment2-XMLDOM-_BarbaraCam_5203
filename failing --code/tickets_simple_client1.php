<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tickets</title>
    <meta name="description" content="Tickets">
    <link rel="stylesheet" href="css/styles.css"/>
    <meta name="viewport" content="width=device-width">
</head>
<?php

session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
var_dump($userid);

$rows = '';
$tickets = simplexml_load_file("./xml/tickets.xml");
$users = simplexml_load_file("./xml/users.xml");


// $tickid = (isset($_GET['id']) ? $_GET['id'] : '');

// for($i = 0; $i < sizeof($tickets); $i++){
  if($tickets->supportticket->creator->id == $userid){

    foreach ($tickets->children() as $tickets) {
    $rows .=  '<tr>' ; 
    $rows .= '<td>'.$tickets->supportticket->creator->id.'</td>';    
    $rows .= '<td>'.$tickets->supportticket->tid.'</td>';
    $rows .= '<td>'.$tickets->supportticket->status.'</td>';
    $rows .= '<td>'.$tickets->supportticket->opendate.'</td>';
    $rows .=  '</tr>' ; 
    }

  }
   


// foreach ($tickets->children() as $tickets) {
//     $rows .= '<tr>';
//     $rows .= '<td>'.$tickets->tid.'</td>';
//     $rows .= '<td>'.$tickets->opendate.'</td>';
//     $rows .= '<td>'.$tickets->status.'</td>';
//     $rows .= "<td><a href='./view_simple_client.php?tid=".$tickets->tid."' class='bt' />View</a></td>";
//     $rows .= '</tr>';
// }

$dom1 = dom_import_simplexml($tickets)->ownerDocument;
$dom1->preserveWhiteSpace = false;
$dom1->formatOutput = true;
$dom1->save("./xml/tickets.xml");

$dom2 = dom_import_simplexml($users)->ownerDocument;
$dom2->preserveWhiteSpace = false;
$dom2->formatOutput = true;
$dom2->save("./xml/users.xml");

$tickets->preserveWhiteSpace = false;
$tickets->formatOutput = true;

$users->preserveWhiteSpace = false;
$users->formatOutput = true;

?>
<body><!-- Navigation  -->
  <?php
  include_once 'nav_client.php';
  ?>
  <!-- end Navigation  -->

  <h3>Welcome <span id="theuser">Back!</span></h3>
  <!-- Add Ticket  -->
  <div id="block1">
    <form action="" method="POST">
      <div id="sub">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" placeholder= "Only decorative"/>
        <button type="submit" name="addTick" id="addSubmit" class="bt">Add Ticket</button>
        </div>      
    </form>
<!-- end Ticket Add  -->
<!-- ticket table -->
    <h1>Tickets</h1>
    <div id="tableresults">
        <table>
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Date Opened</th>
                    <th>Status</th>
                    <th>Client ID</th>
                </tr>
            </thead>
            <tbody>                
                <?php
                echo $rows;
            ?>  <!-- <td><form action="./view.php" method="post">
                        <input type="hidden" name="id" value=""/>
                        <input type="submit" class="bt" name="viewTicket" value="View"/>
                    </form>
                    </td> -->                
            </tbody>
        </table>
    </div>
</div>
    <!-- End Ticket Table  -->
     <!-- Footer  -->
<?php 
include_once 'footer.php';
?>
<!-- end Footer  -->

</body>
</html>
