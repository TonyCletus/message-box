<?php

//Message Variables
$msg = '';
$msgClass = '';

//Check for Submit
if (filter_has_var(INPUT_POST, 'submit')) {
  //echo 'passed';

  //Get Form Data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

  //Check Required Fields
  if (!empty($email) && !empty($name) && !empty($message)) {
    //Check Email Validition
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $msg = 'Please enter A vaild email';
      $msgClass = 'alert-danger';
    }else {
      //Recipient Email Infos
      $toEmail = 'codetocreate.ctc@gmail.com';
      $subject = 'Contact Request from ' .$name;
      $body = '<h2>Contact Request</h2>
            <h3>Name:</h3><p>' .$name.'</p>
            <h3>Email:</h3><p>' .$email.'</p>
            <h3>Message:<h3><p>' .$message. '</p>
            ';

      //Email Headers
      $headers = "MIME-Version: 1.0" ."\r\n";
      $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

      
      //Supporting Headers
      $headers .= "From: " .$name. "<".$email.">". "\r\n";

        if(mail($toEmail, $subject, $body, $headers)){
        //Email Sent
        $msg ='Message sent successfully!';
        $msgClass = 'alert-success';
      //Failed  
      }else{
        $msg = 'Message sending failed!';
        $msgClass = 'alert-danger';
      }
    }
  } else{
    $msg = 'Please fill all fields';
    $msgClass = 'alert-danger';
  }

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Message Box</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  
  <div class="text-center">
     <a href="index.php" class="title">Message<span class="color">Box</span></a>
     <hr>
  </div>
  <div class="modal-dialog text-center">
  <div class="col-sm-8 main-section">
    <div class="modal-content">
       <div class="col-12 user-img">
          <img src="img/loader.gif">
      </div>
      <?php if($msg != '') : ?>
            <p class="alert <?php echo $msgClass; ?>">
            <?php echo $msg; ?>
            </p>
          <?php endif ?>
      <form method="post" action="<?php $_SERVER['PHP_SELF']; ?> ">
      <div class="form-group">
        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>" placeholder="Enter Name" class="form-control">
      </div>
      <div class="form-group">
        <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>" placeholder="Enter Email" class="form-control">
      </div>
      <div class="form-group">
        <textarea class="form-control" name="message" rows="4" cols="10" placeholder="Say Something...."><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
      </div>
      <button class="btn" name="submit">Submit</button>
      </div>
      <div>
      </div>
    </form>
  </div>
 </div>
</div>
<footer class="text-center footer">
  <b>2018, Created with  &#x1F49F; By &#x1F466;<a href="https://tonycletus.herokuapp.com">Tony Cletus</a></b>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
<script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
</body>
</html>