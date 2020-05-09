<?php require('../dbconnect/dbconnect.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php require('header.php'); ?>
<?php
  session_start();
  $statement = $db->prepare('insert into mathTexts set user_id=?,title=?,category=?,mathText=?');
  $statement->execute(array($_SESSION['id'],$_POST['title'],$_POST['categories'],$_POST['texData']));
  echo "送信しました";
 ?>
 <a href="index.php">戻る</a>
</body>
</html>
