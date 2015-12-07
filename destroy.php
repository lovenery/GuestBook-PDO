<?php
	if(isset($_POST['delete'])){
    	$commentid = $_POST['comment_id'];
    	require_once "config.php";
    	$sql = ' DELETE FROM comments WHERE id = ' .$commentid . '';
    	$db->query($sql);
?>
		<meta http-equiv="refresh" content="0;URL='index.php'"/> 
<?php
	}
?>