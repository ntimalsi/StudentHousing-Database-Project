<?php 
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

	
	//****************  Add Query
	//  Query people to select PersonID, FirstName, and LastName, sorting in ascending order by LastName
	$query="SELECT *, RA_fname, RA_lname from Student NATURAL JOIN Room NATURAL JOIN RA ORDER BY Student_lname ASC;";



	//  Prepare and execute query
	$stmt=$mysqli->prepare($query);
	$stmt->execute();			
				


if ($stmt) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Students</h2>";
		echo "<table>";
		echo "  <thead>";
		echo "    <tr><th>ID</th>";
		echo "    <th>Name</th>";
		echo "    <th>Gender</th>";
		echo "    <th>Address</th>";
		echo "    <th>Classification</th>";
		echo "    <th>Phone</th>";
		echo "    <th>RA Name</th><th></th><th></th></tr>";
		echo "  </thead>";
		echo "  <tbody>";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			//Output FirstName and LastName
			echo "<td>".$row["Student_ID"]."</td>";
			echo "<td>".$row["Student_fname"]." ".$row["Student_lname"]."</td>";
			echo "<td>".$row["Student_gender"]."</td>";
			echo "<td>".$row["Student_address"]."</td>";
			echo "<td>".$row["Student_classification"]."</td>";
			echo "<td>".$row["Student_phone"]."</td>";
			echo "<td>".$row["RA_fname"]." ".$row["RA_lname"]."</td>";
			//Create an Edit and Delete link - USE HTML
			//Edit should direct to editPeople.php, sending PersonID in URL
			//Delete should direct to deletePeople.php, sending PersonID in URL - include onclick to confirm delete
			
?>
			
			<td><a href="editStudent.php?id=<?php echo urlencode($row["Student_ID"]);?>">Edit</a></td> &nbsp;
			<td><a href="deleteStudent.php?id=<?php echo urlencode($row["Student_ID"]);?>" onclick="return confirm('Are you sure you want to delete?'); ">Delete</a></td>
<?php

			
			echo "</tr>";
		}
		echo "  </tbody>";
		echo "</table>";
		echo "<br /><br /><a href='createStudent.php'>Add a Student</a> | <a href='addLogin.php'>Add an admin</a> | <a href='logout.php'>Logout</a><br /><br />";

		echo "</center>";
		echo "</div>";
	}

	$query="SELECT * from RA ORDER BY RA_lname ASC;";



	//  Prepare and execute query
	$stmt=$mysqli->prepare($query);
	$stmt->execute();	

	if($stmt){
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>RAs</h2>";
		echo "<table>";
		echo "  <thead>";
		echo "    <tr><th>ID</th>";
		echo "    <th>Name</th>";
		echo "    <th>Dorm ID</th>";
		echo "    <th>Floor ID</th>";
		echo "    <th>Address</th>";
		echo "    <th>Phone</th><th></th><th></th></tr>";
		echo "  </thead>";
		echo "  <tbody>";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			//Output FirstName and LastName
			echo "<td>".$row["RA_ID"]."</td>";
			echo "<td>".$row["RA_fname"]." ".$row["RA_lname"]."</td>";
			echo "<td>".$row["Flr_ID"]."</td>";
			echo "<td>".$row["Dorm_ID"]."</td>";
			echo "<td>".$row["RA_address"]."</td>";
			echo "<td>".$row["RA_phone"]."</td>";
			//Create an Edit and Delete link - USE HTML
			//Edit should direct to editPeople.php, sending PersonID in URL
			//Delete should direct to deletePeople.php, sending PersonID in URL - include onclick to confirm delete
			
?>
			
			<td><a href="editRA.php?id=<?php echo urlencode($row["RA_ID"]);?>">Edit</a></td> &nbsp;
			<td><a href="deleteRA.php?id=<?php echo urlencode($row["RA_ID"]);?>" onclick="return confirm('Are you sure you want to delete?'); ">Delete</a></td>
<?php

			
			echo "</tr>";
		}
		echo "  </tbody>";
		echo "</table>";
		echo "<br /><br /><a href='createRA.php'>Add an RA</a> | <a href='addLogin.php'>Add an admin</a> | <a href='logout.php'>Logout</a><br /><br />";
		echo "</center>";
		echo "</div>";
	}

	$query="SELECT * from Supervisor ORDER BY Supervisor_lname ASC;";

	//  Prepare and execute query
	$stmt=$mysqli->prepare($query);
	$stmt->execute();	

	if($stmt){
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Supervisors</h2>";
		echo "<table>";
		echo "  <thead>";
		echo "    <tr><th>ID</th>";
		echo "    <th>Name</th>";
		echo "    <th>Dorm ID</th>";
		echo "    <th>Address</th>";
		echo "    <th>Phone</th><th></th><th></th></tr>";
		echo "  </thead>";
		echo "  <tbody>";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			//Output FirstName and LastName
			echo "<td>".$row["Supervisor_ID"]."</td>";
			echo "<td>".$row["Supervisor_fname"]." ".$row["Supervisor_lname"]."</td>";
			echo "<td>".$row["Dorm_ID"]."</td>";
			echo "<td>".$row["Supervisor_address"]."</td>";
			echo "<td>".$row["Supervisor_phone"]."</td>";
			//Create an Edit and Delete link - USE HTML
			//Edit should direct to editPeople.php, sending PersonID in URL
			//Delete should direct to deletePeople.php, sending PersonID in URL - include onclick to confirm delete
			
?>
			
			<td><a href="editSupervisor.php?id=<?php echo urlencode($row["Supervisor_ID"]);?>">Edit</a></td> &nbsp;
			<td><a href="deleteSupervisor.php?id=<?php echo urlencode($row["Supervisor_ID"]);?>" onclick="return confirm('Are you sure you want to delete?'); ">Delete</a></td>
<?php

			
			echo "</tr>";
		}
		echo "  </tbody>";
		echo "</table>";
		echo "<br /><br /><a href='createSupervisor.php'>Add a Supervisor</a> | <a href='addLogin.php'>Add an admin</a> | <a href='logout.php'>Logout</a>";
		echo "</center>";
		echo "</div>";
	}

	new_footer("Who's Who");
	$stmt -> close();

	
	Database::dbDisconnect();
 ?>