<?php
/* Getting current working input value */
$get_value = $_POST['value'] ?? '' ;
/* Getting name attribute of current working input field */
$get_name = trim($_POST['name']) ?? '' ;
/* For storing all the details after processing */
$output=[];

function valid_email($email) {
return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? false : true;
}

/* Accept only alphabet and space */
function valid_name($name) {
return (!preg_match("/^[a-zA-Z ]*$/", $name)) ? false : true;
}

if(isset($get_value) && ($get_value!='') && strlen($get_value) >3){
	/* for email */
	if ($get_name == 'email') {
		$check = valid_email(trim($get_value));
		if(!$check){
			$output = ['color' => 'red', 'error' => 'error in mail'];
		}else{
			$output = ['color' => 'green', 'error' => 'good'];
		}
	} /* for email ------------ends */

	/* for name */
	if ($get_name == 'f_name') {
		
		$check = valid_name(trim($get_value));
		if(!$check || trim($get_value) == '' || strlen(trim($get_value)) <=3 ){
			$output = ['color' => 'red', 'error' => 'error in name'];
		}else{
			$output = ['color' => 'green', 'error' => 'good'];
		}
	} /* for name ------------ends */

	/* for password */
	if ($get_name == 'paswd') {
			$output = ['color' => 'green', 'error' => 'good'];
	} /* for password ------------ends */

	}elseif(strlen($get_value) == 0 ){
		/* Reset the processing */
		$output = ['color' => '', 'error' => ''];
	}else{
		/* This will run when the length of the input field is inbetween 1(include) and 3(include)*/
	$output = ['color' => 'red', 'error' => 'length must be greater than 3'];	
}

/*
Convert php array to JSON by using php's default json_encode() function.
Suppose the array
$output = ['color' => 'green', 'error' => 'good'];
then its equivalent JSON will be
{color: "green", error: "good"}
*/
$json = json_encode($output);
/* Below echo will be return by the server after processing this php page */
echo $json;
?>