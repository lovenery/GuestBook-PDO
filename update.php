<?php session_start(); ?>
<?php
if(!empty($_POST['message'])) 
{
	$id = $_POST['comment_id'];
	$message = $_POST['message'];

	require_once "config.php"; // use database
	$sql = ' UPDATE comments set message=:message where id=:id ';
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':message', $message);
	$stmt->execute();
?>
	<meta http-equiv="refresh" content="0;URL='index.php'"/>
<?php
}
else
{
	echo "<div>Please fill in all!</div>";
?>
	<meta http-equiv="refresh" content="2;URL='index.php'"/>
<?php
}
?>