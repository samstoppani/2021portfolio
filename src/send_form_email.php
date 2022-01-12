<html>
  <head>
    <meta charset="UTF-8">
    <meta http_equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <title>Message Sent!</title>
    <link  rel="shortcut icon" type="image/png" href="images/favicon.svg" alt="Sam Stoppani"/>

    <link rel="stylesheet" href="css/bootstrap.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link async rel="stylesheet" href="css/main.css">
    <link async rel="stylesheet" href="css/animate.css">

    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi+2|Montserrat|Muli|Quicksand|Raleway|Sen&display=swap" rel="stylesheet">
</head>
<?php

if(isset($_POST['email'])) {
 
    $email_to = "samstoppani@gmail.com";
    $email_subject = "Personal Profile Enquiry";
 
    function died($error) {
        // error code
        echo "<body style=' background: rgb(143,137,227);
                            background: linear-gradient(135deg, rgba(143,137,227,1) 0%, rgba(255,174,241,1) 100%);'>";
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($message) < 2) {
    $error_message .= 'The Message you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>
<body>
    <div class="row h-100" id="contactFormSent">
        <div class="d-flex mx-auto align-items-center">
            <div class="col-12">
                <h1 class="text-center p-5 wow fadeIn" data-wow-delay="0.4s">
                    <i class="fas fa-thumbs-up fa-5x"></i>
                </h1>
                 <h4 class="text-center wow fadeInUp" data-wow-delay="0.5s">
                    Thank you for getting in touch. I will contact you shortly.
                </h4>
            </div>

        </div>
    </div>
    <script src="js/wow.min.js"></script>

    <script src="js/jquery-3.4.1.min.js"></script>

    <script type="text/javascript" src="js/main.js"></script>

    <script src="js/lazysizes.min.js" async></script>
    <script src="js/fontAwesome.js" ></script>
  <script>
        new WOW().init();
  </script>
</body>
<?php
 
}
?>

</html>