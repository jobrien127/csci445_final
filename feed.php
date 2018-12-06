<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="feed.css">
        <title>Test Page</title>
        <script>
        </script>
    </head>
    <body>
        <?php
			$currPage = "php_form";

			include '../templateHeader.php';

			$servername = "localhost";
			$username = "nfuller";
			$password = "UGCIQIMA";

			// Create connection
			$conn = new mysqli($servername, $username, $password);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
        ?>
        <div id="wrapper">
            <header>
                <h1>The Feed</h1>
                <p id="displayUsername">Username:</p> 
            </header>
            <nav> 
                <button id="navButton">profile</button> <!--NOTE: may be a better idea to use link here?-->
                <button id="navButton">logout</button>
            </nav>
            <div id="content">
                <div id="post">
                  <a href="" id="userlink" >username</a><!--TODO: make this a link insead-->
                   <p id="timestamp">Posted on mm//dd//yyyy at 00:00:00</p>
                   <p id="postP"> This is an example post</p>
                </div>
                <form action="feed_post.php" method="post"><!--TODO: need to set attributes-->
                    <textarea rows="10" cols = "100" placeholder="Post here..."></textarea><!--TODO: need to write js to size the textbox-->
                    <input id="postButton"type="submit" value="Post">
                </form>
            </div>
        </div>
    </body>
</html>
