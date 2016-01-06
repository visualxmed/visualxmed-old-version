<?php
	$target_dir = "lib/images/";
	$target_file = $target_dir . basename($_FILES["infograph"]["name"]);
	$uploadOk = 1;
	$errors = '';
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["infograph"]["tmp_name"]);
	    if($check !== false) {
	        $errors .= "File is an image - " . $check["mime"] . ".\n";
	        $uploadOk = 1;
	    } else {
	        $errors .= "File is not an image.\n";
	        $uploadOk = 0;
	    }
	}
	if (file_exists($target_file)) {
	    $errors .= "Sorry, file already exists.\n";
	    $uploadOk = 0;
	}
	if ($_FILES["infograph"]["size"] > 5000000) {
	    $errors .= "Sorry, your file is too large.\n";
	    $uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $errors .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
	    $uploadOk = 0;
	}
	if ($uploadOk == 0) {
	    $errors .= "Sorry, your file was not uploaded.\n";
	} else {
		$link = mysqli_connect('localhost', 'root', $_POST['pass']); 
		if (!$link) 
		{ 
		  $errors .= "Unable to connect to the database server. Password incorrect.\n"; 
		} 
		else if (!mysqli_set_charset($link, 'utf8')) 
		{ 
		  $errors .= "Unable to set database connection encoding.\n"; 
		} 
		else if (!mysqli_select_db($link, 'vmdb')) 
		{ 
		  $errors .= "Unable to locate the VisualXMed database.\n";  
		} 
		else {
		   $errors .= "Database connection established. \n"; 
		   	if (move_uploaded_file($_FILES["infograph"]["tmp_name"], $target_file)) {
		   		$name = mysqli_real_escape_string($link, $_POST['name']);
		   		$descrip = mysqli_real_escape_string($link, $_POST['msg']);
		   		$title = mysqli_real_escape_string($link, $_POST['title']);
		   		$sql_command = 'INSERT INTO infographics SET name="' . $name .
		   						'", title="' . $title . '", createtime=CURTIME()' .
		   						', descrip="' . $descrip . '"'; 
		   		if (!mysqli_query($link, $sql_command)) {
		   			$errors .= "Error adding infographic information to database. Do manually. \n";
		   		}
	        	$errors .= "The file ". basename( $_FILES["infograph"]["name"]). " has been uploaded.\n";
	    	} else {
	        	$errors .= "Sorry, there was an error uploading your file.\n";
	    	}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>VisualxMed - where visuals empower health literacy</title>
</head>
<body>
	<?php echo nl2br($errors) ?>
	<a href="upload.html"> Back to Uploads </a>
</body>
</html>