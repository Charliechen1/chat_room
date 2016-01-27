<!DOCTYPE html>

<html>
    <head>
        <title>login page</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body id = "loginBody">
    <?php
        if(isset($_COOKIE["userID"])){
            Header("Location: chatroom.php"); 
        }else{
            print '<form action = "handleLogin.php" method = "post" id = "loginForm">';
            print 'Username: <input type = "text" name = "loginName" id = "loginName"/>';   
            print '<br />';
            print 'Password: <input type = "password" name = "loginPassword" id = "loginPassword"/>';
            print '<br />';
            print '<input type = "submit" id = "loginSubmit">';
            print '</form>';
        }
    ?>
    </body>
</html>