<?php
	date_default_timezone_set('America/Toronto');
	$bugs = array();
	
	$isadmin = true;
	
	if(!empty($_POST['uID'])){
		$conn = new mysqli("localhost","root","root","marijuana") or die("Error " . mysqli_error($conn)); 
		
		$queryUser = "SELECT username FROM users WHERE id = ". $_POST['uID'];
		
		$queryDateGrp = "SELECT COUNT(*) as cnt, DATE(dateModified) as dateMod FROM bug_list WHERE userID = '". $_POST['uID'] ."' GROUP BY DATE(dateModified) DESC";
		
		$rsDateGrp = $conn->query($queryDateGrp);
		
		$querySel = "SELECT bl.*, u.username FROM bug_list bl JOIN users u ON bl.userID = u.ID";
		
		$rsCheck = $conn->query($queryUser);
		
		if($rsCheck != false){
			$item = $rsCheck->fetch_array();
			
			
			
			if($item['username'] !== "admin"){
				$querySel .= " WHERE userID = ". $_POST['uID'];
				$isadmin = false;
			}
			
			$querySel .= " ORDER BY dateCreated DESC";
			
			$rsBugs = $conn->query($querySel);
			
			while($bug = $rsBugs->fetch_array()){
				$bug_date = date("Y-m-d",strtotime($bug['dateModified']));
				
				$bugs[$bug_date][$bug['id']] = $bug;
				$bugs[$bug_date][$bug['id']]['bugDate'] = $bug['dateModified'];	
			}
			//die(var_dump($bugs));
		}
	}

?>
<html>
	<head>
		
		<link rel="stylesheet" type="text/css" href="/marijuana/debugger/debug.css" />
	</head>
	<body>
		<div class="cpanel_container">
			<h1>Bug Control Panel</h1>
			<?php 
				if(!empty($_POST['uID'])){ 
					if($rsDateGrp != false){
						if(count($bugs) == 0){
						?>							
							<h2>There are no bugs listed for this user.</h2>
						<?php
						}
						else{
							while($dt = $rsDateGrp->fetch_array()){?>
							<div class='datebuggroup'>
								<h2><?php echo $dt['dateMod']?>:</h2> <h3><?php echo $dt['cnt']; ?> bugs</h3><br />
								<?php foreach($bugs[$dt['dateMod']] as $b): ?>
								<div class='commentbox' style='position:relative;display:inline-block;height:100px'>
									<div class='commenttext'><?php echo substr($b['comment'], 0, 20).'...'; ?></div>
									<?php if($isadmin): ?>
									<div class='buguserlbl'>
										<?php echo $b['username']; ?>
									</div>
									<?php endif; ?>
									<span class='bugtime'><?php echo date("m-d-Y g:i a",strtotime($b['bugDate'])); ?></span>
									<a class='seebug' target='_blank' href='<?php echo $b['url'] ?>'>(See Bug)</a>
								</div>
								<?php endforeach; ?>
							</div>
							<?
							}
						}
					}
			?>
				
			<?php }else{ ?>
				<h2>You must be logged in to view the Control Panel.</h2>
			<?php } ?>
		</div>
	</body>

</html>