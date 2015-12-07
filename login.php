<?php session_start(); ?>
<?php
if(!empty($_POST['username']) && !empty($_POST['password'])) //表單的帳密沒空白
{
    $username = $_POST['username'];
    $password = $_POST['password'];  
    //$password = md5($_POST['password']);  

    require_once "config.php";
    $sql = ' SELECT * FROM users WHERE username = :username AND password = :password ';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result) // 如果成功登入
    {
        require_once "config.php";
        $row = $stmt->fetch();
        $email = $row['email'];

        $_SESSION['Username'] = $username;  
        $_SESSION['Email'] = $email;
        $_SESSION['LoggedIn'] = true;
    ?>

      <meta http-equiv="refresh" content="0;URL='index.php'">  

<?php
    }
    else
    {
?>
      <div>
          <p>Your account has not been found. Please try again.</p>
      </div>
<?php
    }
}
?>


<div>
    <h1>Sign In.</h1>
    <form method ="post" action="">
      <input type="text" name="username" placeholder="Username" /><br />
      <input type="password" name="password" placeholder="Password" /><br />
      <input type="submit" name="login" value="Sign In!" />
    </form>
</div>
<a href="register.php">Register now.</a>
<br/>
<a href="index.php">Back to index.</a>