<html>
<head>
<!--TODO: metadata-->
<!--TODO: page title-->
    <!--TODO: need to include css script-->
    <!--TODO: need to include scipt-->
    <!--TODO: need to include jQuery-->
</head>
<body>
<!--TODO: Navbar-->
<!-- TODO: feed tags-->
	<?php
		if($_COOKIE["badLogin"]) {
			echo "Incorrect Username or Password";
			setcookie("badLogin", false, time() + 3600);
		}
	?>
	<form action="feed.php" method="post">
			Email:<input name="email" type="email">
			Password:<input name="pass" type="password">
			<input type="submit">
	</form>
</body>
</html>