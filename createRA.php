<?php 
//Add beginning code to 
//1. Require the needed 3 files
//2. Connect to your database
//3. Output a message, if there is one
	require_once("session.php"); 
	require_once("included_functions.php");
	require_once("database.php");
	//verify_login();
	new_header("Here is Who's Who!"); 
	$mysqli = Database::dbConnect();
	$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (($output = message()) !== null) {
		echo $output;
	}

	echo "<h3>Add to Who's who!</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {
		if( (isset($_POST["raid"]) && $_POST["raid"] !== "") && (isset($_POST["firstname"]) && $_POST["firstname"] !== "") &&(isset($_POST["lastname"]) && $_POST["lastname"] !== "") &&(isset($_POST["dormid"]) && $_POST["dormid"] !== "") &&(isset($_POST["flrid"]) && $_POST["flrid"] !== "") &&(isset($_POST["personaddress"]) && $_POST["personaddress"] !== "") &&(isset($_POST["personphone"]) && $_POST["personphone"] !== "") ) {
//////////////////////////////////////////////////////////////////////////////////////////////////
					//STEP 2.
					//Create and prepare query to insert information that has been posted
					$query="INSERT INTO RA (RA_ID, RA_fname, RA_lname, Dorm_ID, flr_ID, RA_address, RA_phone) VALUES (?,?,?,?,?,?,?)";


					
					// Execute query
					$stmt = $mysqli->prepare($query);
					$stmt -> execute([$_POST["raid"], $_POST["firstname"], $_POST["lastname"],
					$_POST["dormid"],$_POST["flrid"], $_POST["personaddress"], $_POST["personphone"]]);
					
					
					//Verify $stmt executed - create a SESSION message
					if($stmt){
						$_SESSION["message"]=$_POST["firstname"]." ".$_POST["lastname"]." has been added";
					} else{
						$_SESSION["message"]="Error adding".$_POST["firstname"]." ".$_POST["lastname"];
					}
					//change to real filename later
					redirect("readPeople.php");
				
					
//////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
				$_SESSION["message"] = "Unable to add person. Fill in all information!";
				redirect("createRA.php");
		}
	}
	else {
//////////////////////////////////////////////////////////////////////////////////////////////////
					// STEP 1.  Create a form that will post to this page: createRA.php
					echo"<form action ='createRA.php' method='post'>";
					//          Include <input> tags for each of the attributes in person:
					//                  First Name, Last Name, Birthdate, Birth City, Birth State, Region
					echo "ID number: <input type=text name='raid'/>";
					echo "First Name: <input type=text name='firstname'/>";
					echo "Last Name: <input type=text name='lastname'/>";
					echo "Dorm ID: <input type=text name='dormid'/>";
					echo "Flr ID: <input type=text name='flrid'/>";
					echo "Address: <input type=text name='personaddress'/>";
					echo"Phone number: <input type=text name='personphone'/>";
					//			Finally, add a submit button - include the class 'tiny round button'
					echo "<p><input type='submit' name='submit' value='Add' class='tiny round button'/>";
					echo "<form>";}
					
					
					
//////////////////////////////////////////////////////////////////////////////////////////////////
				

	echo "</label>";
	echo "</div>";
	echo "<br /><p>&laquo:<a href='readPeople.php'>Back to Main Page</a>";
	?>


<?php 
//Define footer with the phrase "Who's Who"
//Release query results
//Close database
new_footer("Who's Who");
$stmt -> close();
Database::dbDisconnect();
?>