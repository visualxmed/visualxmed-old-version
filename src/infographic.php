<!DOCTYPE html>
<html>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />

   <title>VisualxMed - where visuals empower health literacy</title>

   <!-- Load CSS -->
   <link href="lib/basscss/basscss.min.css" rel="stylesheet">
   <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- <link rel="stylesheet" href="lib/tachyons/css/tachyons.css"> -->
   <link rel="stylesheet" href="lib/css/globalstyle.css">
   <link rel="stylesheet" href="lib/css/infographic.css">
   <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
   <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
   <!-- icon -->
   <link rel="apple-touch-icon" sizes="57x57" href="icons/apple-icon-57x57.png">
   <link rel="apple-touch-icon" sizes="60x60" href="icons/apple-icon-60x60.png">
   <link rel="apple-touch-icon" sizes="72x72" href="icons/apple-icon-72x72.png">
   <link rel="apple-touch-icon" sizes="76x76" href="icons/apple-icon-76x76.png">
   <link rel="apple-touch-icon" sizes="114x114" href="icons/apple-icon-114x114.png">
   <link rel="apple-touch-icon" sizes="120x120" href="icons/apple-icon-120x120.png">
   <link rel="apple-touch-icon" sizes="144x144" href="icons/apple-icon-144x144.png">
   <link rel="apple-touch-icon" sizes="152x152" href="icons/apple-icon-152x152.png">
   <link rel="apple-touch-icon" sizes="180x180" href="icons/apple-icon-180x180.png">
   <link rel="icon" type="image/png" sizes="192x192"  href="icons/android-icon-192x192.png">
   <link rel="icon" type="image/png" sizes="32x32" href="icons/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="96x96" href="icons/favicon-96x96.png">
   <link rel="icon" type="image/png" sizes="16x16" href="icons/favicon-16x16.png">
   <link rel="manifest" href="icons/manifest.json">
   <meta name="msapplication-TileColor" content="#ffffff">
   <meta name="msapplication-TileImage" content="icons/ms-icon-144x144.png">
   <meta name="theme-color" content="#ffffff">
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
            <nav class="clearfix center nav-hover">
               <a href="index.php" class="btn navbutton p0 py3 mxn1 col-xs-2 col-sm-2 col-md-2 col-lg-2">Home</a>
               <a href="about.html" class="btn navbutton p0 py3 mxn1 col-xs-2 col-sm-2 col-md-2 col-lg-2">About</a>
               <a href="mission.html" class="btn navbutton p0 mxn1 col-xs-2 col-sm-2 col-md-2 col-lg-2">Mission</a>
               <a href="#" class="btn navbutton p0 mxn1 col-xs-2 col-sm-2 col-md-2 col-lg-2">Opportunities</a>
               <a href="contact.html" class="btn navbutton p0 mxn1 col-xs-2 col-sm-2 col-md-2 col-lg-2">Contact Us</a>
            </nav>
         </div>
      </div>
   </div>
</header>
<main>
   <?php 

   $dbhost = "localhost";
   $dbname = "vmdb";
   $dbuser = "root";
   $dbpass = "root";

   global $vmdb;

   $vmdb = new mysqli();
   $vmdb->connect($dbhost,$dbuser,$dbpass,$dbname);
   $vmdb->set_charset("utf8");

   if ($tutorial_db->connect_errno) {
       printf("Connection failed: %sn", $tutorial_db->connect_error);
       exit();
   }

   $search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_GET['image']);
   $dir_path = "lib/images/" . $search_string . ".jpg";
   $search_string = $vmdb->real_escape_string($search_string);

   if (strlen($search_string) >= 1 && $search_string != '') {
       $query = 'SELECT * FROM infographics WHERE name = "' . $search_string . '" LIMIT 1';
       $result = $vmdb->query($query);
       /* gets the first */
       while($results = $result->fetch_array()) {
         $result_array[] = $results;
      }
      echo "<div class='infograph'>";
      if (isset($result_array)) {
         $infographic = $result_array[0];
         echo  "<img src='" . $dir_path . "'/>"; 
      }
      else {
         echo "<p class='regtext'> Image Not Found. Try another query. </p>";
      }
      echo "</div>";
   } 
   ?>    
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