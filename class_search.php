<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>CMSC Class Selector</title>
		<link rel="stylesheet" type="text/css" href="433.css">
	</head>
	<body>
		<div id="head">
		<h1>Comp Sci Class Selector</h1>
		<h2>Class Search</h2></div>
		<div id="search">
		<form method="post">
			<input type="text" name="num" placeholder="Enter your 3 Digit CMSC Class Number"><br><br>
			<input type="submit" name="submit" value="Add Class" formaction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<br><br>
			<b><u>Completed Classes</u></b><br><br>
			<?php
				mysql_connect("studentdb-maria.gl.umbc.edu", "justus2", "yfgA3FkSBGtiO4Mc") or die("Could not connect to MySQL");
				mysql_select_db("justus2") or die("No such database");	//connect to the database
				$email = $_SESSION["email"];	//pull user email for class storage
				$allclasses = array(201, 202, 203, 232, 291, 299, 304, 313, 331, 341, 352, 391, 404, 411, 421, 426, 427, 431, 432, 433, 435, 436, 437, 441, 442, 443, 444, 446, 447, 448, 451, 452, 453, 455, 456, 457, 461, 465, 466, 471, 473, 475, 476, 477, 478, 479, 481, 483, 484, 486, 487, 491, 493, 495, 498, 499);//list of all available class numbers

				if (isset($_SESSION["classes"])) {	//set class array to stored user classes if available
					$classes = $_SESSION["classes"];
					$classes = array_filter($classes);
				}
				else {	//otherwise initialize the empty array
					$classes = array();
				}
				$num = $_POST["num"];	//get user input

				if (!in_array($num, $classes) && in_array($num, $allclasses)) {
					array_push($classes, $num);
					$_SESSION["classes"] = $classes;
					$selection = "class" . $_SESSION["numClasses"];
					$qry = "UPDATE class_list433 SET $selection = '$num' WHERE email = '$email'";
					$result = mysql_query($qry) or die(mysql_error());
					//if user input is valid, push to database and session var, then print
					
					foreach($classes AS $class){
						echo "CMSC ";
						echo "$class<br>";
					}

					$_SESSION["numClasses"]++;
				}
				else {
					foreach($classes AS $class){
						echo "CMSC ";
						echo "$class<br>";
					}
					
					//display nice error messages
					if (!in_array($num, $allclasses)) {
						echo '<br><span class="hidden">Class does not exist</span>';
					}
					
					if (in_array($num, $classes)) {
						echo '<br><span class="hidden">Class Already Added</span>';
					}
				}
			?>
			<br><br>
			<input type="submit" name="submit" value="Submit List" formaction="available_classes.php">
		</form>
		</div>
	</body>
</html>