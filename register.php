<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="feed.css">
        <title>Test Page</title>
        <script>
        </script>
    </head>

	<?php
			$servername = "localhost";
			$username = "nfuller";
			$password = "UGCIQIMA";

			// Create connection
			$conn = new mysqli($servername, $username, $password);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			$auth = $_GET["user"];
			$reset = $_POST["forgot"];
			
			if($reset == "YES") {
				$email = $_POST["email"];
			}
			else {
				$email = $_COOKIE["user"];
			}
			$pw = $_COOKIE["pw"];
			$msg = "You have attempted to register a Social Harmony and Interaction Table account with this email address.\n
					To activate this account, please click the link attached:\n
					http://luna.mines.edu/fall_2018/nfuller/csci445_final-master/csci445_final-master/register.php?user=" . (string)$email;
	?>
	
	<body>
		<section>
			<?php
				if($auth === NULL && $reset != "YES") {
					echo "An Email has been sent to the provided address. Click the link in the email to register your account.";
					
					mail($email, "S.H.I.T. Account Activation", $msg);
					
				}
				else if($reset == "YES") {
					echo "An Email with a new password has been sent to the provided email address.";
					
					$newpass = rand();
					
					$newmsg = "You have requested a password reset for your Social Harmony and Interaction Table account with this email address.\n
							Your new password is as follows:\n".(string)$newpass;
					$sql = "UPDATE f18_nfuller.USERS
					SET Password = ?
					WHERE Email = ?";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("ss", $newpass, $email);
					$result = $stmt->execute();	
					$stmt->close();
					
					mail($email, "S.H.I.T. Password Reset", $newmsg);
				}
				else {
					if($auth == $email) {
						$sql = "INSERT INTO f18_nfuller.USERS(Email,Password,ID)
						SELECT ?, ?, COUNT(ID)
						FROM f18_nfuller.USERS";
						$stmt = $conn->prepare($sql);
						$stmt->bind_param("ss", $email, $pw);
						$result = $stmt->execute();	
						$stmt->close();
						
						echo "Thank you for authorizing your account.";
					}
					else if ($auth == "logon") {
						echo "You are not currently logged in. Please log in and try again.";
					}
					else {
						echo "Looks like something went wrong. Please try registering again and another email will be sent to you.";
					}
				}
			?>
			<a href="index.php">Return to Login</a>
		</section>
	</body>
</html>