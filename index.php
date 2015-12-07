<?php session_start(); ?>

<?php
	if (@$_SESSION['LoggedIn']==1) {
		echo "Hi~!	". @$_SESSION['Username'] ."<br/>";
?>
		<a href="logut.php">Logut</a><br/>
		<a href="password.php">Change Password</a>
<?php
	}
	else{
?>
		<a href="register.php">Register</a>
		<a href="login.php">Login</a>
<?php
	}
?>
<h1>留言板</h1>
<div>
	<form action="comment.php" method="post">
		<textarea type="text" name="message" ></textarea><br/>
		<input type="submit" name="comment" value="送出"/>
	</form>
</div>
<hr/>

<div>
<?php
	require_once "config.php";
	$sql = ' SELECT id,message,posted_at,posted_by FROM comments ';
	foreach($db->query($sql) as $row) {
		echo "留言內容:" . $row['message'] . " 時間:" . $row['posted_at'] . " 作者:" . $row['posted_by'];
		if(@$_SESSION['Username']==$row['posted_by']){
?>
		    <form method="get" action="edit.php" style="display:inline;">
		        <input type="hidden" name="comment_id" value="<?php echo $row['id'] ?>" />
		        <input type='submit' value='Edit Comment' />
		    </form>
		    <form method="post" action="destroy.php" style="display:inline;">
		        <input type="hidden" name="comment_id" value="<?php echo $row['id'] ?>" />
		        <input type='submit' name="delete" value='Delete Comment' />
		    </form>
<?php
		}
		else if(@$_SESSION['LoggedIn']==1 && $row['posted_by']=="guest"){
?>
		    <form method="post" action="destroy.php" style="display:inline;">
		        <input type="hidden" name="comment_id" value="<?php echo $row['id'] ?>" />
		        <input type='submit' name="delete" value='Delete Comment' />
		    </form>
<?php
		}
		echo "<br/>";
		$reply_sql = ' SELECT id,reply,reply_at,reply_by,comment_id FROM replies WHERE comment_id = '.$row['id'].' ';
		foreach($db->query($reply_sql) as $reply_row) {
			echo "Reply:" . $reply_row['reply'] . " 時間:" . $reply_row['reply_at'] . " 作者:" . $reply_row['reply_by'];
			if (@$_SESSION['Username']==$reply_row['reply_by'] || $reply_row['reply_by']=="guest") {

?>
			    <form method="post" action="reply_destroy.php" style="display:inline;">
			        <input type="hidden" name="reply_id" value="<?php echo $reply_row['id'] ?>" />
			        <input type='submit' name="reply_delete" value='Delete Reply' />
			    </form>
<?php
			}
?>
			    <br/>
<?php
		}
?>
		<form action="reply.php" method="post">
			<input type="hidden" name="comment_id" value="<?php echo $row['id'] ?>" />
			<input type="text" name="reply" />
			<input type="submit" value="Reply"/>
		</form>
		<hr/>
<?php
	}
?>

</div>