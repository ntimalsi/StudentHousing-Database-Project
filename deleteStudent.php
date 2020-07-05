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
	
  	if (isset($_GET["id"]) && $_GET["id"] !== "") {
//////////////////////////////////////////////////////////////////////////////////////				
	  //Prepare and execute a query to DELETE FROM using GET id in criterion - WHERE PersonID = ?
	  $ID=$_GET["id"];	
	  $query="DELETE FROM Student WHERE Student_ID=?";
	  $stmt=$mysqli->prepare($query);	  
	  $stmt->execute([$ID]);
		if ($stmt) {
			//Create SESSION message that Person successfully deleted
			$_SESSION["message"]="Person successfully deleted";
			
			
		}
		else {
			//Create SESSION message that Person could not be deleted
			$_SESSION["message"]="Person could not be deleted";
			
		}
		
		//************** Redirect to readPeople.php
		redirect("readPeople.php");
		
//////////////////////////////////////////////////////////////////////////////////////				
	}
	else {
		$_SESSION["message"] = "Person could not be found!";
		//header("Location: readPeople.php");
		//exit;
		redirect("readPeople.php");
	}

			
			
//Define footer with the phrase "Who's Who"
//Release query results
//Close database
new_footer("Who's Who");
	$stmt -> close();

	
	Database::dbDisconnect();

?>