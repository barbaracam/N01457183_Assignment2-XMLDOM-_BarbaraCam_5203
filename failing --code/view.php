<?php

$tid = '';
$sub ='';
$dat ='';
$mes ='';
$doc = new DOMDocument();


$doc->load("./xml/tickets.xml");

$tickets = $doc->getElementsByTagName("supportticket");

foreach($tickets as $supportticket) {

$tid .= '<span>   '.$supportticket->getElementsByTagName("tid")->item(0)->nodeValue.'</span>   ';
$sub .= '<span>   '.$supportticket->getElementsByTagName("subject")->item(0)->nodeValue.'</span>   ';
$dat .= '<span>   '.$supportticket->getElementsByTagName("opendate")->item(0)->nodeValue.'</span>   ';
$mes .= '<div class="chat-mes"><div >'.$supportticket->getElementsByTagName("messages")->item(0)->nodeValue.'</div></div>  ';
}

// $messages = $doc->getElementsByTagName("messages");

// foreach($messages as $messages ) {
// $mes .= '<div class="chat-mes">'.$messages->getElementsByTagName("messages")->item(0)->nodeValue.'</div>   ';


// }





$doc->preserveWhiteSpace = false;
$doc->formatOutput = true;


?><html>
<head>
    <title>Tickets</title>
    <meta name="description" content="Tickets">
    <link rel="stylesheet" href="css/styles.css"/>
</head>
<body>
    <!-- Navigation  -->
  <?php
  include_once 'nav.php';
  ?>
  <!-- end Navigation  -->
<h1>Details</h1>

<a href="./tickets.php" id="btn_back">Back</a>
 <div id="lab">
 <div class="lab">Ticket Number:<?php echo $tid; ?></div>
 <div class="lab">Subject:<?php echo $sub; ?></div>
 <div class="lab">Date Opened:<?php echo $dat; ?></div>
 <div class="lab"><?php echo $mes; ?></div>
 <div><!-- TimeStamp--></div> 
</div>

<h2>Chat with us</h2>
<div id="chat">
<form action="" method="POST">
      <div class="chat-div">
        <label for="message">Write your message</label>
      </div>
      <div class="chat-div">
        <textarea id="message" name="message"></textarea>
      </div>
      <div class="chat-div">
        <button type="submit" name="addMes" class="bt">Send</button>
      </div>
</form>
</div>

<!-- Footer  -->
<?php 
include_once 'footer.php';
?>
<!-- end Footer  -->

</body>
</html>