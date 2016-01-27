<!DOCTYPE html>
<?php
    if(!isset($_COOKIE["userID"])){
        Header("Location: login.php"); 
    }
?>
<html>
    <head>
        <title>Chatroom</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script src="JavaScript/jquery-1.11.3.min.js"></script>
        
        <script>
            $(document).ready(function() {
                var msgID = 0; 
                var loadParticipants = function(){
                    $.getJSON("updateParticipantList.php", function(jsonData){
                        
                        var txt = "";
                        var currID = jsonData.users[0]["userID"];
                        
                        $.each(jsonData.users, function(i, user){
                            if(user["userID"] == currID){
                                txt += "<img class = \"user_icon\" src = \""+user["icon"]+"\"/>";
                                txt += "<h2 class = \"userName\">"+user["name"]+"</h2>";
                                txt += "<p class = \"user_classify\">You</p>";
                                txt += "<br />";
                            }else{
                                if(user["status"] == 1){
                                    txt += "<img class = \"user_icon\" src = \""+user["icon"]+"\"/>";
                                    txt += "<h2 class = \"userName\">"+user["name"]+"</h2>";
                                    txt += "<p class = \"user_classify\">Online</p>";
                                    txt += "<br />";
                                }else{
                                    txt += "<img class = \"user_icon\" src = \""+user["icon"]+"\"/>";
                                    txt += "<h2 class = \"userName\">"+user["name"]+"</h2>";
                                    txt += "<p class = \"user_classify\">OffLine</p>";
                                    txt += "<br />";
                                }
                            }
                        });
                       
                        $("#participant_list").html(txt);
                        
                    });
                };
                       
                var loadMessage = function(){
                    $.getJSON("updateMessages.php?msgID="+msgID, function(jsonData){
                        var txt = "";
                        var coun = 0;
                        $.each(jsonData.messages, function(i, message){
                            msgID = message["msgID"];
                            coun++; 
							txt += "<div class = \"chatMsgDiv\">";
                            if(message["curr"]){
                                txt += "<table class = \"yourMsg\">";
								txt += "<tr>";
								txt += "<td>";
								txt += "<p class = \"chatTime\">" + message["time"] + "</p>";
								txt += "<p class = \"chatMsg\">" + message["content"] + "</p>";
								txt += "</td>";
								txt += "<td><img class = \"chatIcon\" src = \"" + message["icon"] + "\"/></td>";
								txt += "</tr>";
								txt += "</table>";
                            }else{
                                txt += "<table class = \"otherMsg\">";
								txt += "<tr>";
								txt += "<td><img class = \"chatIcon\" src = \"" + message["icon"] + "\"/></td>";
								txt += "<td>"
								txt += "<p class = \"chatTime\">" + message["time"] + "</p>";
								txt += "<p class = \"chatMsg\">" + message["content"] + "</p>";
								txt += "</td>";
								txt += "</tr>";
								txt += "</table>";
                            }
							txt += "</div>";
							
                        });
                        $("#mainWin").html(txt);
                    });
                };
                
                setInterval(loadParticipants, 200);
                setInterval(loadMessage, 200);
				
				
                var sendFunction = function(){
                    var xmlhttp;
                    if(window.XMLHttpRequest){
                        xmlhttp = new XMLHttpRequest();
                    }else{
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    
                    xmlhttp.onreadystatechange = function(){
                        if(xmlhttp.readyState === 4 && xmlhttp.status === 200){
                           loadMessage();
                        }
                    };
                    
                    msg = $("#send_msg").val();
                    $("#send_msg").val("");
                    xmlhttp.open("GET", "handleNewMessage.php?msg="+msg, true);
                    xmlhttp.send();
                };
				
                $(document).on("click", "#send_btn", function(){
                    sendFunction();
                });
                
                
            });
            
        </script>
    </head>
    <body>
        <div id = "Header">
            <h1 id = "char_room_title">CHAT &nbsp;&nbsp;&nbsp; ROOM</h1>
            <a id = "logout_button" href = "logout.php">logout</a>
        </div>
        <div id = "Container">
            <div id = "participant_list">
                
            </div>
            <div id = "messages">
                
                <div id = "mainWin">
                    
                </div>
                
                <div id = "send">
                    <input type = "text" id = "send_msg"/>
                    <button type = "button" id = "send_btn">Send</button>
                </div>
            </div>
        </div>
    </body>
</html>
    
   