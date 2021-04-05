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
// var_dump($userid);

$rows = '';
$doc = simplexml_load_file("./xml/tickets.xml");

foreach ($doc->children() as $tickets) {
    $rows .= '<tr>';
    $rows .= '<td>'.$tickets->tid.'</td>';
    $rows .= '<td>'.$tickets->opendate.'</td>';
    $rows .= '<td>'.$tickets->status.'</td>';
    $rows .= "<td><a href='./view_simple_staff.php?tid=".$tickets->tid."' class='bt' />View</a></td>";
    $rows .= '</tr>';
}

$dom = dom_import_simplexml($doc)->ownerDocument;
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->save("./xml/tickets.xml");

?>
    <body>
    <!-- Navigation  -->
        <?php
        include_once 'nav_staff.php';
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
                    <?php echo $rows; ?>         
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
