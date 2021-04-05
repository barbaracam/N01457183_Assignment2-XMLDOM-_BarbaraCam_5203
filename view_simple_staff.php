<?php

// $tid = '';
// $sub ='';
// $dat ='';
// $mes ='';
// $doc = new DOMDocument();

// $doc->load("./xml/tickets.xml");
// $tickets = $doc->getElementsByTagName("supportticket");
// foreach($tickets as $supportticket) {

// $tid .= '<span>   '.$supportticket->getElementsByTagName("tid")->item(0)->nodeValue.'</span>   ';
// $sub .= '<span>   '.$supportticket->getElementsByTagName("subject")->item(0)->nodeValue.'</span>   ';
// $dat .= '<span>   '.$supportticket->getElementsByTagName("opendate")->item(0)->nodeValue.'</span>   ';
// $mes .= '<div class="chat-mes"><div >'.$supportticket->getElementsByTagName("messages")->item(0)->nodeValue.'</div></div>  ';
// }
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
// var_dump($userid);

$tickets = simplexml_load_file("./xml/tickets.xml");
$users = simplexml_load_file("./xml/users.xml");

$tickid = (isset($_GET['tid']) ? $_GET['tid'] : '');
for($i = 0; $i < sizeof($tickets); $i++){
    if($tickets->supportticket[$i]->tid == $tickid){

      $tuserid = $tickets->supportticket[$i]->client;    
      $ticketid = $tickets->supportticket[$i]->tid;
      $ticketsubject = $tickets->supportticket[$i]->subject;
      $ticketopendate = $tickets->supportticket[$i]->opendate;
      $ticketdmessage = $tickets->supportticket[$i]->messages->message;
      $ticketlab = $tickets->supportticket[$i]->messages->message['id'];  
    }
    
}
// var_dump($ticketid);
$time = new DateTime;
$current_datetime = $time->format(DateTime::ATOM);

if(isset($_POST['addMes'])){
    if($_POST['message'] != "" || $_POST['message'] !=null){
        $datamessage = $_POST['message'];

        for($i = 0; $i<sizeof($tickets); $i++){
          if($tickets->supportticket[$i]->tid == $tickid){
            $message = $tickets->supportticket[$i]->messages->addChild('message', $datamessage);
            $message->addAttribute('id', $userid);
            $message->addAttribute('TimeStamp', $current_datetime);

            $dom = dom_import_simplexml($tickets)->ownerDocument;
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->save("./xml/tickets.xml");            
          }
        }
    }
}

// foreach ($doc->children() as $tickets) {
    
//     $rows .= "<div>Ticket Number: <span class='addinfo'>".$tickets->tid."</span></div>";
//     $rows .= "<div>Subject: <span class='addinfo'>".$tickets->subject."</span></div>";
//     $rows .= "<div>Date: <span class='addinfo'>".$tickets->opendate."</span></div>";
//      $messages = $tickets->messages;
    
//          foreach($messages->children() as $message){
//         $rows .= "<div>Messages: <span class='addinfo'>".$tickets->messages->message."</span></div>";
//      }

?><html>
  <head>
      <title>Tickets</title>
      <meta name="description" content="Tickets">
      <link rel="stylesheet" href="css/styles.css"/>
  </head>
  <body>

      <!-- Navigation  -->
    <?php
    include_once 'nav_staff.php';
    ?>
    <!-- end Navigation  -->

    <h1>Details</h1>
    <div class="linkback">
      <a href="./tickets_simple_staff.php" class="back" id="btn_back">Back</a>
    </div>
    <div>
      <div class="lab">Ticket Number: <span><?php echo $ticketid; ?></span></div>
      <div class="lab">Subject: <span><?php echo $ticketsubject; ?></span></div>
      <div class="lab">Date Opened: <span><?php echo $ticketopendate; ?></span></div>
      <div class="lab">Messages: <div><span><?php 
                      foreach($ticketdmessage as $ticketmessage){
                        
                        echo( '' .$ticketlab. " : " . $ticketmessage . '<br>' );                  
                      }       
      ?></span></div></div>    
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