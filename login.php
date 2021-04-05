<?php 

session_start();
$xmlusers = simplexml_load_file("./xml/users.xml");
$usern = "";
$password = "";

if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];


for($i = 0; $i < sizeof($xmlusers); $i++){
    if($xmlusers->user[$i]->username == $username && $xmlusers->user[$i]->password == $password){
   
        $_SESSION['userid'] = (string)$xmlusers->user[$i]['id'];
        $_SESSION['username'] = $username;
        if($xmlusers->user[$i]['type'] == 'client'){
          header("Location:tickets_simple_client.php");
        }
        else {
          header("Location:tickets_simple_staff.php");
        }
    }

    else {
            echo "Your username or passwords doesnt match our data";
    }
    
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <title>Login</title>
</head>

<body>
  <!-- Navigation  -->
  <?php
  include_once 'nav.php';
  ?>
  <!-- end Navigation  -->


  <!-- login form -->
  <div id="logindiv">
  <fieldset>
    <legend>
      <h1>Please Log In</h1>
    </legend>
    <form action="login.php" method="POST">
      <div class="form-div">
        <label for="username">Username</label>
        <input type="text" id="uname" name="username">
      </div>
      <div class="form-div">
      <label for="password">Password</label>
      <input type="password" id="password" name="password">
    </div>
    <div class="form-div">
      <input type="submit" name="login"  id="logB" class="bt" value="Log in">
    </div>
      <div id="errMessage">
        <?php //echo $errMessage; ?>
      </div>
    </form>
  </fieldset>
</div>
  <!-- End login form -->

  <!-- Footer  -->
<?php 
include_once 'footer.php';
?>
<!-- end Footer  -->

</body>

</html>