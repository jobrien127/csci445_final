<html>
<head>
<!--TODO: metadata-->
<title>Login</title>
	<link rel="stylesheet" type="text/css" href="index.css">
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
<div id="wrapper">
        <header>
            <h1>
                S.H.I.T. - Login
            </h1>
        </header>
        <div id="login">
            <form action="feed.php" method="post">
                    Email:<input name="email" type="email"><br>
                    Password:<input name="pass" type="password"><br>
                    <input type="submit">
            </form>
        </div>
	</div>
	<!--<?php include 'footer.php';?>-->
</body>
</html>