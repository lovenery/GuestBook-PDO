<?php session_start(); ?>
<?php
if(!empty($_POST['message'])) 
{
    $message = $_POST['message'];
    date_default_timezone_set("Asia/Taipei"); //設為台灣時間
    $posted_at = date("Y-m-d H:i:s");

    if (!empty($_SESSION['Username'])) {
        $posted_by = $_SESSION['Username'];
    }
    else{
        $posted_by = "guest";
    }

    require_once "config.php"; // use database
    $sql = ' INSERT INTO comments (id,message,posted_at,posted_by) VALUES (NULL,:message,:posted_at,:posted_by) ';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':posted_at', $posted_at);
    $stmt->bindParam(':posted_by', $posted_by);
    $stmt->execute();
?>
    <meta http-equiv="refresh" content="0;URL='index.php'"/>
<?php
}
else
{
    echo "<div class='error'>Please fill in all!</div>";
?>
    <meta http-equiv="refresh" content="2;URL='index.php'"/>
<?php
}
?>
