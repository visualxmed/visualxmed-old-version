<?php 
class InfoGraphics {
   public $name;
   public $date;
   public $descrip;
   public $title;

   function __construct($Name, $Date, $Descrip, $Title) {
      $this->name = $Name;
      $this->date = $Date;
      $this->descrip = $Descrip;
      $this->title = $Title;
   }
}

$link = mysqli_connect('localhost', 'root', 'root'); 
if (!$link) 
{ 
  $output = 'Unable to connect to the database server.'; 
  $error = true;
} 
else if (!mysqli_set_charset($link, 'utf8')) 
{ 
  $output = 'Unable to set database connection encoding.'; 
  $error = true;
} 
else if (!mysqli_select_db($link, 'vmdb')) 
{ 
  $output = 'Unable to locate the VisualXMed database.';  
  $error = true;
} 
else {
   $output = 'Database connection established.'; 
   $error = false;
}
if (!$error) {
   $result = mysqli_query($link, "SELECT * FROM infographics GROUP BY name ORDER BY max(createtime) desc LIMIT 6");
   if (!$result) {
      $output = "Error fetching recent infographics: " . mysqli_error($link);
      $error = true;
   }

   if (!$error) {
      while ($row = mysqli_fetch_array($result)) {
         $recentinfo[] = new Infographics($row['name'],$row['createtime'],$row['descrip'],$row['title']);
      }
      $count = count($recentinfo);
   }
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
   <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
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
               <a href="mission.html" class="btn navbutton p0 mxn1 col-xs-3 col-sm-3 col-md-3 col-lg-3">Mission</a>
               <a href="#" class="btn navbutton p0 mxn1 col-xs-3 col-sm-3 col-md-3 col-lg-3">Opportunities</a>
               <a href="contact.html" class="btn navbutton p0 mxn1 col-xs-3 col-sm-3 col-md-3 col-lg-3">Contact Us</a>
            </nav>
         </div>
      </div>
   </div>
</header>
<main>
   <section class="container px2 py2">
      <h3 class="mb3 regular center title">
         Latest Infographics
      </h3>
      <?php 
      $accum = 0;
      if ($error) {
         echo $output; 
      } 
      else {
         $prev = $count - 1;
         $next = 1;
         for ($i = 0; $i < ceil($count/3); $i++) { ?> 
         <div class="clearfix"> </div>
         <div class="row">
            <?php for ($j = 0; $j < 3 && $accum < $count; $j++, $accum++) { ?>
               <div class="cols-xs-4 col-sm-4 col-md-4 col-lg-4 mb3"> 
               <div class="container-limit">
                  <div class="thumbnaili picitem">
                     <a href="<?php echo "#image-" . $accum ?>"> 
                        <img class="img-responsive portrait" src="<?php echo ("lib/images/" . $recentinfo[$accum]->name . ".jpg"); ?>" />
                        <span> <p> <?php echo ($recentinfo[$accum]->title); echo "<br />"; 
                                    echo (date('F-d-Y', strtotime($recentinfo[$accum]->date))); ?> </p> </span>
                     </a>
                  </div>
                  <div class="overlay" id="<?php echo "image-" . $accum ?>">
                     <img class="img-responsive" src="<?php echo ("lib/images/" . $recentinfo[$accum]->name . ".jpg"); ?>" />
                     <div>
                           <h3> <?php echo $recentinfo[$accum]->title ?> </h3> </span>
                           <p> <?php echo nl2br($recentinfo[$accum]->descrip) ?> </p>
                           <a href="<?php echo "#image-" . $prev ?>" class="prev"> Prev </a>
                           <a href="<?php echo "#image-" . $next ?>" class="next"> Next </a>
                     </div>
                     <a href="#page" class="close">xCLOSE </a>
                  </div>
               </div> 
               <!-- <?php echo htmlspecialchars($recentinfo[$accum], ENT_QUOTES, 'UTF-8'); echo ceil($count/4);?> -->
               </div> 
               <?php 
                  $prev = $accum;
                  $next = $accum + 2; 
                  if ($prev >= $count) {
                     $prev = 0;
                  }
                  if ($next >= $count) {
                     $next = 0;
                  }
               } ?> </div>
      <?php } } ?> 
    </section>
</main>
<footer>
   <div class="container px2 py2">
      <div class="clearfix">
         <ul class="list-reset h3 center">
            <li class="inline-block"><a href="index.php" class="btn">Home</a></li>
            <li class="inline-block"><a href="about.html" class="btn">About Us</a></li>
            <li class="inline-block"><a href="mission.html" class="btn">Mission</a></li>
            <li class="inline-block"><a href="#" class="btn">Opportunities</a></li>
            <li class="inline-block"><a href="contact.html" class="btn">Contact Us</a></li>
         </ul>
      </div>
   </div>
</footer>
</body>
</html>