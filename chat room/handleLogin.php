<!DOCTYPE html>
<html>
<head>
    <title>login page</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>   
<body id = "logHandleBody">
<?php
   
    $loginName = $_POST['loginName'];
    $loginPassword = $_POST['loginPassword'];

    $conn=mysqli_connect('i.cs.hku.hk','jchen','PNeufFgv') or die ('Failed to Connect '.mysqli_error($conn));
    mysqli_select_db($conn,'jchen') or die ('Failed to Access DB'.mysqli_error($conn));
    
    $query = 'SELECT * FROM users';
    $res = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    
    $exist = FALSE;
    
    while($row = $res->fetch_assoc()) {
        if ($loginName == $row['name']){
            $exist = TRUE;
            if ($loginPassword == $row['password']){
                setcookie('userID', $row['userID'], time()+3600);
                
                $query = "UPDATE users SET status = '1' WHERE userID = '{$row['userID']}'";
                mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
                
                Header("Location: chatroom.php"); 
            }else{
                print '<p class = "logFailInfo">The user name and password you entered do not match!</p>';
                print '<form action = "handleLogin.php" method = "post" id = "loginForm">';
                print 'Username: <input type = "text" name = "loginName" id = "loginName"/>';   
                print '<br />';
                print 'Password: <input type = "password" name = "loginPassword" id = "loginPassword"/>';
                print '<br />';
                print '<input type = "submit" id = "loginSubmit">';
                print '</form>';
            }
        }
    }
    if(!$exist){
            print '<p class = "logFailInfo">The user name '.$loginName.' has not been registered!</p>';
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