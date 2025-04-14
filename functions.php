<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) {
		# code...

		$text .= rand(0,9);
	}

	return $text;
}

function get_sensor_data($con) {
    // Get temperature and humidity data
    $query = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 10";
    $result = mysqli_query($con, $query);
    
    if(!$result) {
        return false;
    }

    $data = array();
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}
