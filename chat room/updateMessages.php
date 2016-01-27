<?php

    $currID = $_COOKIE["userID"];

    $msgId = $_GET["msgID"];
		
    $conn=mysqli_connect('sophia.cs.hku.hk','jchen','PNeufFgv') or die ('Failed to Connect '.mysqli_error($conn));
    
    mysqli_select_db($conn,'jchen') or die ('Failed to Access DB'.mysqli_error($conn));
	
    $query1 = 'SELECT COUNT(*) AS count FROM messages';
    
    $count_res = mysqli_query($conn, $query1) or die ('Failed to query '.mysqli_error($conn));
	
    while($row=mysqli_fetch_array($count_res)) {
        $coun = $row["count"];
    }
	
    if($coun > 5){
        $start = $coun - 5;
        $query2 = 'SELECT m.*, u.icon FROM messages m, users u WHERE m.userID = u.userID ORDER BY m.msgID ASC LIMIT '.$start.', 5';
    }else{
        $query2 = 'SELECT m.*, u.icon FROM messages m, users u WHERE m.userID = u.userID ORDER BY m.msgID ASC LIMIT 5';
    }
	
    
    $result = mysqli_query($conn, $query2) or die ('Failed to query '.mysqli_error($conn));
    
    $json = array(); 
    
    while($row=mysqli_fetch_array($result)) {
        if($row['userID'] === $currID){
            $curr = True;
        }else{
            $curr = False;
        }
        $json[] = array('msgID'=>$row['msgID'],'userID'=>$row['userID'],
            'content'=>$row['content'],'time'=>$row['time'], 'icon' => $row['icon'], 'curr' => $curr);
    }
    
    print json_encode(array('messages'=>$json));