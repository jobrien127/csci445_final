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
			
			$email = $_COOKIE["user"];
			$pw = $_COOKIE["pw"];
			$msg = "You have attempted to register a Social Harmony and Interaction Table account with this email address.\n
					To activate this account, please click the link attached:\n
					http://luna.mines.edu/fall_2018/nfuller/csci445_final-master/csci445_final-master/register.php?user=" . (string)$email;
	?>
	
	<body>
		<section>
			<?php
				if($auth === NULL) {
					echo "An Email has been sent to the provided address. Click the link in the email to register your account.";
					
					mail($email, "S.H.I.T. Account Activation", $msg, $headers);
					
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
					else {
						echo "Looks like something went wrong. Please try registering again and another email will be sent to you.";
					}
				}
			?>
			<a href="index.php">Return to Login</a>
		</section>
	</body>
</html>