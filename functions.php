<?php

function calcJazz($range){
	if ($range <= 6){
		return $range*10;
	}
	if ($range >= 6 && $range <= 9){
		return $range*15;
	}
	if ($range == 10){
		return 200; 
	}
}

function loadPosts(){
	require 'connect.php';
	$postinfo = $pdo->query('select * from posts');
	foreach ($postinfo as $row){
		bitSystem(); ?>
		<div id="<?php echo $row['postID']?>" class="post_frame">
		    <img class="pic_frame" src="<?php echo $row['imgsrc']; ?>" onclick="gotoPost(<?php echo $row['postID']; ?>)">
		    <div class="post_text_box"> 
		        <div class="post_bar">   
		            <div class="title_frame">
		                <h class="title" id="body" onclick="gotoPost(<?php echo $row['postID']; ?>)">
						<?php echo $row['title']; ?>
						</h>
		                <div class="bit_box">
						<form method="post" style="margin:0;">
		                    <div class="bit_vote">
		                        <i style="height:50%; cursor: pointer;" class="material-icons">
									<input class="submit_bit" value="<?php echo $row['postID']?>" type="submit" name="upbit">keyboard_arrow_up</i>
		                        <i style="height:50%; cursor: pointer;" class="material-icons">
									<input class="submit_bit"value="<?php echo $row['postID']?>" type="submit" name="downbit">keyboard_arrow_down</i>    
							</div>
						</form>
		                    <div class="bit_value"><?php echo $row['bits']; ?>B</div>
		                </div>
		            </div>     
		        </div>
		        <div id="postContent" class="content_frame" onclick="readPost('<?php echo $row['postID']?>')">
		            <h class="comment">
						<?php echo $row['content']; ?>
					</h>
		        </div>
		    </div>   
		</div>
	<?php
	}              
}
function loadCurrentPost($id){
	require 'connect.php';
	$postinfo = $pdo->query('select * from posts where postID ='.$id);
	foreach ($postinfo as $row){?>
        <div class="post_frame">
			<div class="post_bar">   
		        <div class="title_frame">
		            <h class="title" id="body"  onclick="gotoPost(<?php echo $row['postID']; ?>)">
					<?php echo $row['title']; ?>
					</h>
		            <div class="bit_box">
		                <div class="bit_vote">
		                    <i style="height:50%; cursor: pointer;" class="material-icons">
								keyboard_arrow_up
							</i>
		                    <i style="height:50%; cursor: pointer;" class="material-icons">
								keyboard_arrow_down
							</i>    
		                </div>
		                <div class="bit_value"><?php echo $row['bits']; ?>B</div>
		            </div>
		        </div>      
		    </div>
            <div style="display: flex; flex-direction: row; flex-wrap: nowrap;">   
				<a style="text-decoration: none; " href="<?php echo $row['imgsrc']?>">
				<img class="pic_frame" src="<?php echo $row['imgsrc'] ?>">
				</a>
                <div class="content_frame"><?php echo $row['content'] ?></div>
            </div>
		</div>
<?php
	}              
}

function loadComments($id){
	require 'connect.php';
	$comments = $pdo->query('select * from comments where postID ='.$id);
	foreach ($comments as $comment){?>
	    <div class="comment_data"> 
	        <div class="comment_frame" ><?php echo $comment['username']." says: ".$comment['content']?></div>
	        <div class="bit_box">
		        <div class="bit_vote">
		            <i style="height:50%; cursor: pointer;" class="material-icons">keyboard_arrow_up</i>
	                <i style="height:50%; cursor: pointer;" class="material-icons">keyboard_arrow_down</i>    
		        </div>
	            <div class="bit_value"><?php echo $comment['bits']; ?>B</div>
	        </div>
	    </div>
	    <?php
	}
}
?>
<?php
function bitSystem(){
require 'connect.php';
$postinfo = $pdo->query('select * from posts');
	
if(isset($_POST["upbit"])){
	foreach($postinfo as $row){
	if($_POST['upbit'] == $row['postID']){
	$row['bits']++;
	$locationID = $_POST['upbit'];
	$pdo->query("update posts SET bits = ('".$row['bits']."') where postID = ('".$locationID."')");
	header("Location: ./main.php");
}}}
if(isset($_POST["downbit"])){
	foreach($postinfo as $row){
	if($_POST['downbit'] == $row['postID']){
	$row['bits']--;
	$pdo->query("update posts SET bits = ('".$row['bits']."') where postID = ('".$_POST['downbit']."')");
	header("Location: ./main.php");
}}}
else {
	echo "";
}

// var_dump($locationID);
}

?>