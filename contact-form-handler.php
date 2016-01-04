<?php
$errors = '';
$email = "mzang13@gmail.com";
if(empty($_POST['name'])  || empty($_POST['email']) || empty($_POST['msg']) || empty($_POST['hear'])) {
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['name']; 
$email_address = $_POST['email']; 
$message = $_POST['msg']; 
$hear = $_POST['hear'];

if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email_address)) {
    $errors .= "\n Error: Invalid email address";
}

if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u",
		$name)) {
	$errors .= "\n Error: Must have valid first and last name";
}

if(empty($errors))
{
	$to = $email; 
	$email_subject = "Contact form submission: $name";
	$email_body = "You have received a new message. ".
	" Here are the details:\n Name: $name \n Email: $email_address \n Message \n $message \n Hear \n $hear"; 
	
	$headers = "From: $email\n"; 
	$headers .= "Reply-To: $email_address";
	
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: contact-form-received.html');
} 
?>
<!DOCTYPE html> 
<html>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />

   <title>VisualxMed - where visuals empower health literacy</title>

   <!-- Load CSS -->
   <link href="lib/basscss/basscss.min.css" rel="stylesheet">
   <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- <link rel="stylesheet" href="lib/tachyons/css/tachyons.css"> -->
   <link rel="stylesheet" href="lib/css/indexstyle.css">
   <link rel="stylesheet" href="lib/css/contact.css">
   <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
   <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
   <!-- Load JS -->
   <script src="lib/jquery/jquery-2.1.4.js"></script>

</head>

<body>
<header>
   <div class="container px2 py3">
      <div class="clearfix h2">
         <div class="row">
            <div class="col-12">
               <div class="header mb2">
                  <img class="logo lg-col-4 sm-col-6 align-middle" src="lib/images/logo.png" />
                  <h1 class="slogan align-bottom center sm-col-6 lg-col-8 inline-block mxn1">where visuals empower health literacy</h1>
               </div>
            </div>
         </div>

         <div class="row">   
            <nav class="clearfix center">
               <a href="about.html" class="btn navbutton p0 py3 mxn1 col-xs-3 col-sm-3 col-md-3 col-lg-3">About</a>
               <a href="#" class="btn navbutton p0 mxn1 col-xs-3 col-sm-3 col-md-3 col-lg-3">Mission</a>
               <a href="#" class="btn navbutton p0 mxn1 col-xs-3 col-sm-3 col-md-3 col-lg-3">Opportunities</a>
               <a href="index.html" class="btn navbutton p0 mxn1 col-xs-3 col-sm-3 col-md-3 col-lg-3">Home</a>
            </nav>
         </div>
      </div>
   </div>
</header>
<p class="contacttext center"> <?php
echo nl2br($errors);
?> </p> 
<footer>
   <div class="container px2 py2">
      <div class="clearfix">
         <ul class="list-reset h3 center">
            <li class="inline-block"><a href="#" class="btn">Home</a></li>
            <li class="inline-block"><a href="#" class="btn">About Us</a></li>
            <li class="inline-block"><a href="#" class="btn">Mission</a></li>
            <li class="inline-block"><a href="#" class="btn">Opportunities</a></li>
            <li class="inline-block"><a href="#" class="btn">Contact Us</a></li>
         </ul>
      </div>
   </div>

</footer>
</body>
</html>