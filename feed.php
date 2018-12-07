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
	
	if($_POST["email"] != NULL) {
		$email = (string)$_POST["email"];
		$pw = (string)$_POST["pass"];
		
		setcookie("user", $email, time() + 3600);
		setcookie("pw", $pw, time() + 3600);
	}
	else {
		$email = $_COOKIE["user"];
		$pw = $_COOKIE["pw"];
		
		if($_POST["confirmNewPassword"] != NULL) {
			$newpass = (string)$_POST["confirmNewPassword"];
			setcookie("pw", $newpass, time() + 3600);
			
			$sql = "UPDATE f18_nfuller.USERS
			SET Password = ?
			WHERE Email = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $newpass, $email);
			$result = $stmt->execute();	
			$stmt->close();
		}
		
		if($email == NULL || $pw == NULL) {
			header('Location: register.php?user=logon');
			exit;
		}
	}

	$sql = "SELECT COUNT(ID)
	FROM f18_nfuller.USERS U
	WHERE U.Email = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $email);
	$stmt->bind_result($userCount);
	$stmt->execute();
	$stmt->fetch();
	$stmt->close();
	if($userCount != 0) {
		$sql = "SELECT COUNT(ID)
		FROM f18_nfuller.USERS U
		WHERE U.Email = ? AND U.Password = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss", $email, $pw);
		$stmt->bind_result($userCount);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		if($userCount == 0) {
			setcookie("badLogin", true, time() + 3600);
			header('Location: index.php');
			exit;
			// invalid password handling
		}
	}
	else {
		header('Location: register.php?auth=NULL');
		exit;
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="feed.css">
        <title>Test Page</title>
        <script>
        </script>
    </head>
    <body>
        <div id="wrapper">
            <header>
                <h1>The Feed</h1>
                <p id="displayUsername">Currently Logged In As: <?php echo $_COOKIE["user"] ?></p> 
            </header>
            <div id="changePassword">
                    <form action="feed.php" method="post">
                       New password: <input name="newPassword" type="text"><br>
                       Confirm new password: <input name="confirmNewPassword" type="text">
                       <input name="confirmButton" type="submit" value="Change"> 
                    </form>
            </div>
            <?php include 'header.php';?>
            <div id="content">
					<?php
						$sql = mysqli_query($conn, "SELECT U.Email, P.Content, P.TStamp
						FROM f18_nfuller.USERS U, f18_nfuller.POSTS P
						WHERE U.ID = P.User_ID
						ORDER BY P.TStamp DESC
						LIMIT 100")
						   or die (mysqli_error($conn));

						while ($row = mysqli_fetch_array($sql))
						{
							echo "
                <div id='post'>
				<p> At " . date("h:i:sa on Y/m/d GMT", $row['TStamp']) . ", " . $row['Email'] . " posted:<br />" . $row['Content'] . "<br/>
				</p>
                </div>";
						}
					?>
                <form action="feed_post.php" method="post"><!--TODO: need to set attributes-->
                    <textarea name="content" rows="10" cols = "100" placeholder="Post here..."></textarea><!--TODO: need to write js to size the textbox-->
					<input name="time" type="text" hidden value=<?php echo time() ?>>
                    <input id="postButton"type="submit" value="Post">
                </form>
            </div>
        </div>
        <?php include 'footer.php' ?>
    </body>
</html>
