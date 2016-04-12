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
		<h2>Available Classes</h2></div>
		<div id="search">
		<?php
		$completed = $_SESSION["completed"];
		?>
		Placeholder
		</div>
	</body>
</html>