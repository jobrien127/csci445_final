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
			$email = (string)$_POST["email"];
			$pw = (string)$_POST["pass"];
			$p_content = (string)$_POST["content"];
			$tstamp = (string)$_POST["time"];
			$dstamp = (string)$_POST["date"];
			
			$DEBUG = "Working";
			
			$sql = "SELECT COUNT(ID)
			FROM f18_nfuller.USERS U
			WHERE U.Email = ? AND U.Password = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $email, $pw);
			$stmt->bind_result($id, $userCount);
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();
			
			$sql = "SELECT ID
			FROM f18_nfuller.USERS U
			WHERE U.Email = ? AND U.Password = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $email, $pw);
			$stmt->bind_result($id);
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();
			if($userCount === 0) {
				$DEBUG = "Failed";
				// invalid password handling
			}
			else {
				$sql = "INSERT INTO f18_nfuller.POSTS(User_ID, Content, TStamp, ID)
				SELECT ?, ?, ?, COUNT(ID)
				FROM f18_nfuller.POSTS";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("iss", $id, $p_content, $tstamp);
				$result = $stmt->execute();	
				$stmt->close();
			}
	?>
	
	<body>
		<section>
			Post Successfully Created! <?php echo $DEBUG ?>
		</section>
	</body>
</html>