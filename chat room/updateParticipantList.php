<?php

    $currID = $_COOKIE["userID"];

    $conn=mysqli_connect('sophia.cs.hku.hk','jchen','PNeufFgv') or die ('Failed to Connect '.mysqli_error($conn));
    
    mysqli_select_db($conn,'jchen') or die ('Failed to Access DB'.mysqli_error($conn));
	
    $query = 'SELECT * FROM users';
	
    $result1 = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    $result2 = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    $result3 = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    
    $json = array();
    
    while($row=mysqli_fetch_array($result1)) {
        if ($row["userID"] == $currID){
                $json[]=array('userID'=>$row['userID'],'name'=>$row['name'], 
                'icon'=>$row['icon'],'status'=>$row['status']);
        }
    }
    
    while($row=mysqli_fetch_array($result2)) {
        if ($row["userID"] != $currID && $row["status"] == 1){
                $json[]=array('userID'=>$row['userID'],'name'=>$row['name'], 
                'icon'=>$row['icon'],'status'=>$row['status']);
        }
    }
    
    while($row=mysqli_fetch_array($result3)) {
        if ($row["status"] == 0){
                $json[]=array('userID'=>$row['userID'],'name'=>$row['name'], 
                'icon'=>$row['icon'],'status'=>$row['status']);
        }
    }
    
    print json_encode(array('users'=>$json));