<?php 

//Add beginning code to 
//1. Require the needed 3 files
//2. Connect to your database
//3. Output a message, if there is one
	require_once("session.php"); 
	require_once("included_functions.php");
	require_once("database.php");
	new_header("Here is Who's Who!"); 
	$mysqli = Database::dbConnect();
	$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (($output = message()) !== null) {
		echo $output;
	}
	echo "<h3>Update to Who's who!</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {
///////////////////////////////////////////////////////////////////////////////////////////				
		//Step 2.
		//Create an UPDATE query using anonymous parameters and the criterion WHERE PersonID = ?
		//Student (Student_ID, Student_gender, Student_address, Student_classification, Student_fname, Student_lname, Student_phone) VALUES (?,?,?,?,?,?,?)
		$query="UPDATE RA SET RA_fname=?, RA_lname=?, Flr_ID=?, Dorm_ID=?, RA_address, RA_phone WHERE RA_ID=?";
	
	
		//Prepare and execute query (use $_POST values from submitted form)
		$stmt=$mysqli->prepare($query);
		$stmt->execute([$_POST["rafirstname"], $_POST["ralastname"], $_POST["flrid"], $_POST["dormid"], $_POST["raaddress"], $_POST["raphone"], $_POST["raid"]]);
		
		//Verify $stmt executed - create a SESSION message
		if($stmt){
			$_SESSION["message"]=$_POST["rafirstname"]." ".$_POST["ralastname"]." is changed";
		} else{
			$_SESSION["message"]="Error changing".$_POST["rafirstname"]." ".$_POST["ralastname"];
		}
		//Redirect back to readPeople.php
		redirect("readPeople.php");

///////////////////////////////////////////////////////////////////////////////////////////

		//Output query results and return to readPeople.php			

		if($stmt) {
			$_SESSION["message"] = $_POST["rafirstname"]." ".$_POST["ralastname"]." has been changed";
			echo $_POST['rafirstname']." ".$_POST['ralastname']." has been changed<br />";
		}
		else {
			$_SESSION["message"] = "Error! Could not add person";
			echo "Error! Could not change ".$_POST['rafirstname']." ".$_POST['ralastname']."<br />";
		}
		

	}
	else {
///////////////////////////////////////////////////////////////////////////////////////////
	  //Step 1.
	  if (isset($_GET["id"]) && $_GET["id"] !== "") {
		  $ID=$_GET["id"];
	  //Prepare and execute a query to SELECT * using GET id in criterion - WHERE PersonID = ?
		$query="SELECT * from RA WHERE RA_ID=?";
		$stmt=$mysqli->prepare($query);
		$stmt->execute([$ID]);
	  

	  
		//Verify statement successfully executed - I assume that results are returned to variable $stmt
		if ($stmt)  {
			//Fetch associative array from executed prepared statement
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			//Output whose profile we are updating
			//UNCOMMENT ONCE YOU'VE COMPLETED THE FILE
			echo "<h3>".$row["RA_fname"]." ".$row["RA_lname"]."'s Profile</h3>";


			//Create form with inputs for each field in people table, pre-populating the values

			//DON'T FORGET your submit button - use class attribute (i.e., class='button tiny round')
			echo"<form action ='editRA.php' method='post'>";
					//          Include <input> tags for each of the attributes in person:
					//                  First Name, Last Name, Birthdate, Birth City, Birth State, Region
					echo "<input type='hidden' name='raid' value='{$ID}'/>";
					echo "First Name: <input type=text name='rafirstname' value='{$row["RA_fname"]}' />";
					echo "Last Name: <input type=text name='ralastname' value='{$row["RA_lname"]}' />";
					echo "Floor ID: <input type=text name='flrid' value='{$row["Flr_ID"]}' />";
					echo "Dorm ID: <input type=text name='dormid' value='{$row["Dorm_ID"]}' />";
					echo "Address: <input type=text name='raaddress' value='{$row["RA_address"]}' />";
					echo "Phone number: <input type=text name='raphone' value='{$row["RA_phone"]}' />";
					//			Finally, add a submit button - include the class 'tiny round button'
					echo "<p><input type='submit' name='submit' value='Add' class='tiny round button'/>";
					echo "<form>";}
			
			
			
			
			
///////////////////////////////////////////////////////////////////////////////////////////

			echo "<br /><p>&laquo:<a href='readPeople.php'>Back to Main Page</a>";
			echo "</label>";
			echo "</div>";
					

		}
		//Query failed. Return to readPeople.php and output error
		else {
			$_SESSION["message"] = "Person could not be found!";
			redirect("readPeople.php");
		}
	  }
    
					
//Define footer with the phrase "Who's Who"
//Release query results
//Close database
new_footer("Who's Who");
$stmt -> close();
Database::dbDisconnect();
?>

