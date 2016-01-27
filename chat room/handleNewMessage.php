<?php
   
    $currID = $_COOKIE["userID"];
    
    $msg = $_GET["msg"];
    
    $conn=mysqli_connect('sophia.cs.hku.hk','jchen','PNeufFgv') or die ('Failed to Connect '.mysqli_error($conn));
    
    mysqli_select_db($conn,'jchen') or die ('Failed to Access DB'.mysqli_error($conn));
    
    $query1 = 'SELECT COUNT(*) AS count FROM messages';
    
    $count_res = mysqli_query($conn, $query1) or die ('Failed to query '.mysqli_error($conn));
    
    while($row=mysqli_fetch_array($count_res)) {
        $coun = $row["count"];
    }
    
    $msgID = $coun+1;
    
    ini_set('date.timezone','Asia/Hong_Kong');
    
    $time = time();
    
    $date = date("g:i A l M j Y",$time);
    
    $query2 = 'INSERT INTO messages VALUES (\''.$msgID.'\',\''.$currID.'\',\''.$msg.'\',\''.$date.'\')';
    
    mysqli_query($conn, $query2) or die ('Failed to query '.mysqli_error($conn));

    