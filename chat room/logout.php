<!DOCTYPE html>
<html>
    <head>
        <title>Log Out</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body id = "logoutBody">
    <?php
        if(isset($_COOKIE["userID"])){
            $currID = $_COOKIE["userID"];

            $conn=mysqli_connect('sophia.cs.hku.hk','jchen','PNeufFgv') or die ('Failed to Connect '.mysqli_error($conn));

            mysqli_select_db($conn,'jchen') or die ('Failed to Access DB'.mysqli_error($conn));

            $query = 'UPDATE users SET status = 0 WHERE userID='.$currID;

            mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

            setcookie("userID", "", time()-3600);
            print "<div id = \"main\">";
            print "<p id = \"first\">You have logged out. </p>";
            print "<p id = \"second\"><a href = \"login.php\" id = \"link\">Log in </a>again.</p>";
            print "</div>";
        }else{
            Header("Location: login.php"); 
        }

        ?>
        </body>
</html>