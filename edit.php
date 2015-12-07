<?php session_start(); ?>
<?php
$id = $_GET["comment_id"];
require_once "config.php";
$sql = 'SELECT * FROM comments where id=' .$id. '';
$stmt = $db->query($sql);
$row = $stmt->fetch();
?>

<div>
	<form action="update.php" method="post">
		<input type="hidden" name="comment_id" value="<?php echo $id ?>" />
		<textarea type="text" name="message" ><?php echo $row['message'] ?></textarea><br />
		<input type="submit" name="comment" value="送出"/>
	</form>
</div>