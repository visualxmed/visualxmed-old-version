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

$html = "<li>";
$html .= '<ul><li class="result">';
$html .= '<a href="urlString" target="_blank">';
$html .= '<h3>nameString</h3>';
$html .= '<h4>functionString</h4>';
$html .= '</a>';
$html .= '</li>';
$html .= '</ul>';
$html .= '</li>';

$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $vmdb->real_escape_string($search_string);

if (strlen($search_string) >= 1 && $search_string != '') {
    $query = 'SELECT * FROM infographics WHERE title LIKE "%' . 
    	$search_string .'%" OR name LIKE "%' . $search_string . '%"';
    $result = $vmdb->query($query);
    while($results = $result->fetch_array()) {
    	$result_array[] = $results;
	}
	if (isset($result_array)) {
		foreach ($result_array as $result) {
			$display_function = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['title']);
			$display_url = 'infographic.php?image='.$result['name'];
			$display_name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['name']);
			$output = str_replace('nameString', $display_name, $html);
			$output = str_replace('functionString', $display_function, $output);
			$output = str_replace('urlString', $display_url, $output);

			echo($output);
		} 
	}
	else {
		$output = str_replace('urlString', 'JavaScript:void(0);', $html);
		$output = str_replace('nameString', 'No Results Found.', $output);
		$output = str_replace('functionString', "Sorry :(", $output);
		echo($output);
	}
} 
?>		