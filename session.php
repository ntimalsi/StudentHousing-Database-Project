<?php

	session_start();
	
	function message() {
		if (isset($_SESSION["message"])) {
			
			$output = "<div class='row'>";
			$output .= "<div data-alert class='alert-box info round'>";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
		else {
			return null;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////
//  Step 8.     Write the function verify_login which will need to be invoked in each of the webpages
//              for the Who's Who site
				//Verify the admin session variable has been set and is not null
				//If either case is false, create a session message "You must login in first"
				//and redirect to indexABC.php
				// function verify_login() {
				// 	if(!isset($_SESSION["admin"])&& $_SESSION["admin"] === NULL) {
				// 	$_SESSION["message"] = "You must login in first!";
				// 	header("Location: indexTIM.php");
				// 	exit;
				// 	}
				// 	}
					
				
				
///////////////////////////////////////////////////////////////////////////////////////////////////	
	
?>