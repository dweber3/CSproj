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
				mysql_select_db("justus2") or die("No such database");
				$email = $_SESSION["email"];

				if (isset($_SESSION["classes"])) {
					$classes = $_SESSION["classes"];
					$classes = array_filter($classes);
				}
				else {
					$classes = array();
				}
				$num = $_POST["num"];

				if (preg_match("/^[2-4][0-9][0-9]$/", $num) && !in_array($num, $classes)) {
					array_push($classes, $num);
					$_SESSION["classes"] = $classes;
					$selection = "class" . $_SESSION["numClasses"];
					$qry = "UPDATE class_list433 SET $selection = '$num' WHERE email = '$email'";
					$result = mysql_query($qry) or die(mysql_error());

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
				}
			?>
			<br><br>
			<input type="submit" name="submit" value="Submit List" formaction="available_classes.php">
		</form>
		</div>
	</body>
</html>