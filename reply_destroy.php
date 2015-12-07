<?php
	if(isset($_POST['reply_delete'])){
    	$reply_id = $_POST['reply_id'];
    	require_once "config.php";
    	$sql = ' DELETE FROM replies WHERE id = ' .$reply_id . '';
    	$db->query($sql);
?>
		<meta http-equiv="refresh" content="0;URL='index.php'"/> 
<?php
	}
?>