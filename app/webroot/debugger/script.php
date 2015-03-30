<?php

	date_default_timezone_set('America/Toronto');
		// Change this connection with your credentials (server,db,user,password)
	$conn = new mysqli("localhost","root","","canbii") or die("Error " . mysqli_error($conn)); 
	
	if ($conn->connect_errno) {
		print_r("Connect failed: %s\n", $conn->connect_error);
		exit();
	}

	// Create if doesn't exist
	$tbl_q = "CREATE TABLE IF NOT EXISTS bug_list
(
id int NOT NULL AUTO_INCREMENT,
userID int not null,
url text NOT NULL,
positionX int(10),
positionY int(10),
comment text NOT NULL
windowX int(10),
windowY int(10),
ipAddress varchar(50),
dateCreated DATETIME,
dateModified DATETIME,
PRIMARY KEY (id)
);";

	if($conn->query($tbl_q) == true){
		//print_r("Table successfully created.\n");
	}

    $url="";
    if (isset($_POST['url'])){
        $url=trim(trim($_POST['url'],"#"), "?debug");
    }

	switch($_REQUEST['funct']){
		case "addBug":
			$dateNow = date('Y-m-d H:i:s');
		
			$queryIn = "INSERT INTO bug_list(comment,userID,url,positionX,positionY,windowX,windowY,ipAddress,dateCreated,dateModified) VALUES('".
			$_POST['comment']."','".$_POST['userID']."','". $url ."','".$_POST['positionX']."','".$_POST['positionY'].
			"','". $_POST['winWidth'] ."','". $_POST['winHeight'] ."','". $_SERVER['REMOTE_ADDR'] ."','". $dateNow ."','". $dateNow ."');";
			
			if($result = $conn->query($queryIn)){
				$bugid = $conn->insert_id;
				echo json_encode(array("id"=>$bugid,"dateModified"=>date("m-d-Y @ g:i a",strtotime($dateNow))));
			}
			else{
				echo "false";
			}
			
			
		break;
		case "updateBug":
			$dateNow = date('Y-m-d H:i:s');
			$queryUp = "UPDATE bug_list SET comment='".$_POST['comment']."', url ='" . $url .
			"',windowX=". $_POST['winWidth'] .",windowY=". $_POST['winHeight'] .", positionX = '".$_POST['positionX']
			."', positionY ='".$_POST['positionY']. "', ipAddress = '".$_SERVER['REMOTE_ADDR']."',dateModified='". $dateNow ."' WHERE id=".$_POST['bugID'];
			
			if($conn->query($queryUp) == true){
				echo json_encode(array("id"=>$_POST['bugID'],"dateModified"=>date("m-d-Y @ g:i a",strtotime($dateNow))));
			}
			else{
				echo "false";
			}
			
		break;
		case "getBugsByURL":
			$queryUser = "SELECT username FROM users WHERE id = '". $_POST['userID'] ."'";
			
			$querySel = "SELECT * FROM bug_list WHERE userID = '". $_POST['userID'] ."' AND url = '". $url ."'";
			
			$bugs = array();
			
			$rsUser = $conn->query($queryUser);
			
			if($rsUser !== false){
				$user = $rsUser->fetch_array();
				
			// Check if admin (Change username to admin user name or use user type column)
				if($user['username'] == "admin@trinoweb.com"){
					
					$querySel = "SELECT * FROM bug_list WHERE url = '". $url . "'";
				}
			}
			$rs = $conn->query($querySel);
			
			if($rs !== false){
				$row_cnt = $rs->num_rows;
				if($row_cnt > 0){
					while($row = $rs->fetch_array()){
						$bugs[$row['id']] = $row;
						$bugs[$row['id']]['dateMod'] = date("m-d-Y @ g:i a",strtotime($row['dateModified']));
						
						
						// $bugs[$row['id']]['html'] = "<div data-winWidth='".	$row['windowX'] 
						// ."' class='commentbox draggable' style='top:". $row['positionY'] +"px;left:". $row['positionX'] 
						// ."px'><a class='close' href='#' onclick='javascript:closeMsg(this)'></a><textare class='commenttext'>"
						// .$row['comment'] ."</textarea><button class='savebtn'>Save</button><input type='hidden' class='bugid' value='".$row['id'] ."' /></div>";  
					}
					echo json_encode($bugs);
				}
				else{
					echo "false";				
				}
			}
			else{
				echo "false";
			}
		break;
		default:
			echo "no function called";
			break;
	}
	
?>