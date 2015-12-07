<?php session_start(); ?>
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])) //如果有登入
{
    if(!empty($_POST['password_new']) && $_POST['password_new'] == $_POST['password_new_repeat']) //如果傳入的表單不為空 
    {
        $username = $_SESSION['Username'];
        $password_old = $_POST['password_old'];  
        $password_new = $_POST['password_new'];  
        $password_new_repeat = $_POST['password_new_repeat'];  
        //$password_old = md5($_POST['password_old']);  
        //$password_new = md5($_POST['password_new']);  
        //$password_new_repeat = md5($_POST['password_new_repeat']);  
        
        require_once "config.php";
        $sql = ' SELECT * FROM users WHERE username = :username AND password = :password_old ';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password_old', $password_old);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result) //檢查是否oldpassword一樣
        {
            require_once "config.php";
            $sql = ' UPDATE users SET password = :password_new WHERE username = :username ';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password_new', $password_new);
            $stmt->execute();
?>
            <div><p>Password successfully changed.</p></div>
            <meta http-equiv="refresh" content="3;URL='index.php'"/>
<?php
        }
        else
        {
?>
            <div>
              <p>Oops, there's something went wrong. Please try again!(Maybe your old password is wrong.)</p>
            </div>
            <meta http-equiv="refresh" content="4;URL='password.php'">  
<?php
        }
    }
    else
    {
?>
        <div>
          <h1>Change Password</h1>
          <form method ="post" action="" >
            <input type="password" name="password_old" placeholder="Old Password" /><br />
            <input type="password" name="password_new" placeholder="New Password" /><br />
            <input type="password" name="password_new_repeat" placeholder="Repeat New Password" /><br />
            <input type="submit" name="pass" value="Change Password" />
          </form>
        </div>
      <br />
      <p class="note">Done? Back to <a href="index.php">home</a>.</p>
<?php
    }
}
else //如果沒登入
{
?>
    <meta http-equiv="refresh" content="0;URL='index.php'">  
<?php
}
?>