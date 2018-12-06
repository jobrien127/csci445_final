<html>
<head>
<!--TODO: metadata-->
<title>Login</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
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
	<?php include 'footer.php';?>
</body>
</html>