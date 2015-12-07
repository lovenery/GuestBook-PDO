<?php session_start(); ?>

<?php 
if(empty($_SESSION['LoggedIn']) && empty($_SESSION['Username'])) //如果沒有登入
{
	if(!empty($_POST['username']) && !empty($_POST['password'])) //如果表單帳號跟密碼沒有空白
	{
		$username = $_POST['username'];
		$password = $_POST['password'];  
		//$password = md5($_POST['password']);  
	  	$email = $_POST['email'];

	    require_once "config.php";
		$sql = ' SELECT * FROM users WHERE username = :name ';
	    $stmt = $db->prepare($sql);
	    $stmt->bindParam(':name', $username);
	    $stmt->execute();
	    $result = $stmt->fetch();
		if($result==false) //帳號沒重複 註冊成功
		{
			require_once "config.php"; // use database
			$sql = ' INSERT INTO users (id,username, email, password) VALUES(NULL,:username,:email,:password) ';
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);
	        $stmt->execute();
	        $result = $stmt->fetch();
			echo "<div>Your account has been successfully created.</div>";  
?>
			<meta http-equiv="refresh" content="2;URL='index.php'">	
<?php
		}
		else //帳號重複
		{
			echo "<div>This username is already taken. Please try again.</div>";  
?>
			<meta http-equiv="refresh" content="3;URL='register.php'">
<?php
		}
	}
	else //如果表單帳號跟密碼有空白
	{
?> 
		<div >
			<h1>Register.</h1>
			<form method="post" action="register.php">  
					<input type="text" name="username" placeholder="ID" /><br /> 
					<input type="text" name="email" placeholder="Email" /><br /> 
		      		<input type="password" name="password" placeholder="Password" /><br />
					<input type="submit" name="register" value="Create" />  
		    </form>
		</div>
		<a href="login.php">Sign In now.</a>
		<br/>
		<a href="index.php">Back to index</a>
<?php  
	}
}
else //如果有登入 
{
?>
    <div class="error">You are already logged in!</div>
    <meta http-equiv="refresh" content="2;URL='index.php'"> 
<?php
}
?>