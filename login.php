<?php
// Start the session
session_start();
$_SESSION = array();
$_SESSION["numClasses"] = 1;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hello!</title>
</head>
<body>
<?php 
	mysql_connect("studentdb-maria.gl.umbc.edu", "justus2", "yfgA3FkSBGtiO4Mc") or die("Could not connect to MySQL");
	mysql_select_db("justus2") or die("No such database");
	
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email = $_POST["email"];

	$qry = "SELECT * FROM user_list433 WHERE email='$email'";
	$result = mysql_query($qry);
	if ($result && mysql_num_rows($result) != 0) {
		$classes = array();
		$_SESSION["email"] = $email;
		$qry = "SELECT class1,class2,class3,class4,class5,class6,class7,class8,class9,class10,class11,class12 FROM class_list433 WHERE email='$email'";
		$result = mysql_query($qry) or die(mysql_error()); 
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$x = 1;
		
		while ($x < 12) {
			$selection = "class" . $x;
			array_push($classes, $row[$selection]);
			$x++;
		}
		$_SESSION["classes"] = $classes;
		echo "Welcome back, $firstname $lastname";
		echo "!<br><br>";
		echo "Retreiving your classes...";
		echo '<script type="text/javascript">
		setTimeout(function(){window.location = "http://userpages.umbc.edu/~justus2/cmsc433/project/class_search.php"},2000);
		</script>';
	}
	else {
		$qry = "INSERT INTO user_list433 (first,last,email) VALUES ('$firstname', '$lastname', '$email')";
		mysql_query($qry) or die(mysql_error());
		$qry = "INSERT INTO class_list433 (email) VALUES ('$email')";
		$_SESSION["email"] = $email;
		mysql_query($qry) or die(mysql_error());
		echo "Welcome $firstname $lastname";
		echo "!<br><br>";
		echo "Redirecting to class search...";
		echo '<script type="text/javascript">
        setTimeout(function(){window.location = "http://userpages.umbc.edu/~justus2/cmsc433/project/class_search.php"},2000);
		</script>';
	}
?>

</body>
</html>