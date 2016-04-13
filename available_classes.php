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
			$classes = $_SESSION["classes"];	//Take in the list of classes from the session
			$classesCanTake = array();	//setup the array for the list of classes we can take
			$fourxx = 0;	//helper variable for determining if the user has taken ANY 400 level class
			foreach($classes as $key => $value){	//Iterate through the list of classes and check for a 400 level class
				if ($value > 400){
					$fourxx += 1;
				}
			}
			if (count($classes) == 0){	//if the user has no classes, then they can only take 201
				array_push($classesCanTake,201);
			}
			/*A group of if-else checks for classes that we can take
			* We don't worry about duplicates or order because those are resolved later
			*/
			if (in_array(201,$classes)){
				array_push($classesCanTake,202);
			}
			if (in_array(202,$classes)){
				array_push($classesCanTake,203,486,304);
			}
			if (in_array(203,$classes)){
				array_push($classesCanTake,457,452,451,313,331,341);
			}
			if (in_array(313,$classes)){
				array_push($classesCanTake,411,435,421);
			}
			if (in_array(331,$classes)){
				array_push($classesCanTake,431,432,433,473);
			}
			if (in_array(341,$classes)){
				array_push($classesCanTake,481,461,421,475,476,456,455,453,443,441,437,436,427,471,435);
				if ($fourxx > 0){	//if the user has taken a 400 level class then they can take 447
					array_push($classesCanTake,447);
				}
			}
			if (in_array(421,$classes)){
				array_push($classesCanTake,487,483,426);
			}
			if (in_array(435,$classes)){
				array_push($classesCanTake,493);
			}
			if (in_array(447,$classes)){
				array_push($classesCanTake,448);
			}
			if (in_array(461,$classes)){
				array_push($classesCanTake,465,466);
			}
			if (in_array(471,$classes)){
				array_push($classesCanTake,493,479,478,477);
			}
			if (in_array(481,$classes)){
				array_push($classesCanTake,465,466,487);
			}

		sort($classesCanTake);	//Sort the array
		$classesCanTake = array_unique($classesCanTake);	//remove duplicates
		$classesCanTake = array_diff($classesCanTake, $classes);	//remove classes that the user has already taken
		
		echo "<b><u>Available Classes</u></b><br><br>";
		foreach($classesCanTake as $key => $value){	//print out the values in the array
			echo "CMSC ";
			echo $value;
			echo "<br>";
		}
		?>
		<br>
		<br>
		<a href="class_search.php">Back to Search Page</a>
		</div>
	</body>
</html>
