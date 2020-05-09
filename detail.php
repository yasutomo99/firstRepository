<!-- 投稿の詳細画面 -->
<!-- 投稿の内容を表示。その際、MathJaxライブラリを導入することで、数式の表現にpdfファイル等を用いる手間を省く。 -->


<?php require('../dbconnect/dbconnect.php');
  session_start();
?>

<!--返信画面のPOST送信があった場合、それをreplyTextsに入れた後に画面を再び表示する　-->
<!-- replyTextsテーブルのreply_idと、mathTextsテーブルのidを結びつける -->
<?php
  if (isset($_POST)) {
        $statements = $db->prepare('insert into replyTexts set user_id=?, reply_id=?, text=?');
        $statements->execute(array($_SESSION['id'],$_REQUEST['id'],$_POST['texData']));
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
    <script>
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
    });
    </script>
    <style>
    #input, #result {
      width:50%;
      min-height:5em;
      border:solid 1px grey;
    }

    html {
      background:#f8f4f1;
    }

    main {
      width:75%;
      margin: 0 auto;
    }

    .questionWrapper {
      padding-bottom: 20px;
      border-bottom: 1px solid lightgray;
    }

    .answerWrapper {
      padding:20px 0;
      border-top: 1px solid lightgray;
    }

    article {
      width:70%;
      position: relative;
      margin:2em auto 2em ;
      padding:20px;
      background:#fff;
      border-radius: 30px;
    }

    article:before {
      content:"";
      position: absolute;
      left: -38px;
      width:13px;
      height:12px;
      top:10px;
      background:#fff;
      border-radius: 50%;
    }

    article:after {
      content:"";
      position:absolute;
      left: -24px;
      width:20px;
      height:18px;
      top:13px;
      background:#fff;
      border-radius: 50%;
    }

    .accountWrapper {
      position: absolute;
      left:-125px;
      top:0px;
      text-align: center;
    }

    .accountWrapper img {
      width:80px;
      height:100px;
    }

    article h2 {
      font-size: 30px;
      border-bottom: 1px solid black;
    }

    article p {
      position:absolute;
      right:50px;
    }
    article h3 {
      padding-top: 20px;
      font-size: 13px;
    }
    h4 {
      background-color: lightgray;
    }

    h4 p{
      font-size: 20px;
      padding-left: 10px;
    }

    .textWrapper{
     display: inline-block;
    }
    .text {
      float:left;
      padding:20px;
    }
    .clear {
      clear:both;
    }
    #input, #result {
      width:400px;
      height:400px;
      background-color: white;
    }
    #result {
      border:1px solid black;
    }
    .replyWrapper {
      display: none;
    }
    </style>
      <link rel="stylesheet" href="../css/index.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <!-- ヘッダーの読み込み -->
    <?php require('header.php'); ?>
    <main>
    <?php
    // 質問情報の取得
      $memos = $db->prepare('select * from mathTexts where id=?');
      $memos->execute(array($_REQUEST['id']));
      $memo = $memos->fetch();
     ?>

     <!-- 質問表示 -->
    <div class="questionWrapper">
     <article>
       <div class="accountWrapper">
         <?php
          $users = $db->prepare('select * from members,mathTexts where members.id=mathTexts.user_id and mathTexts.id=?');
          $users->execute(array($_REQUEST['id']));
          $user = $users->fetch();
          ?>
          <!-- 質問アカウントのユーザー写真と名前の表示 -->
         <a href="userpage.php?user=<?php echo $user['user_id']; ?>"><img src="../member_picture/<?php echo $user['picture']; ?>" alt=""></a><br>
         <a href="userpage.php?user=<?php echo $user['user_id']; ?>"><?php echo $user['name']; ?>さん</a>
       </div>
       <!-- 質問のタイトル、投稿日時、本文の表示 -->
       <h2><?php echo $memo['title']; ?></h2>
       <p><?php echo $memo['created_at']; ?></p>
       <h3><?php echo nl2br($memo['mathText']); ?></h3>
     </article>
   </div>


   <h4><p>回答投稿<button>+</button></p></h4>

   <!-- +ボタンを押した際、ログインしていれば回答フォームを開き、していなければログイン画面に飛ばす -->
   <?php if (!empty($_SESSION['id'])): ?>
   <script>
   $('button').click(function(){
     $('.replyWrapper').toggle(500);
   });
   </script>
  <?php else : ?>
    <script>
      $('button').click(function(){
        window.location.href = 'login.php';
      });
    </script>
  <?php endif; ?>

  <!-- 回答投稿フォーム -->
   <div class="replyWrapper">
     <form action="detail.php?id=<?php echo $_REQUEST['id']; ?>" method="post">
     <div class="textWrapper">
     <div class="text">
       <p>texテキスト</p>
       <textarea name="texData" id="input" rows="10"></textarea>
     </div>
     <div class="text">
       <p>Result</p>
       <div id="result"></div>
     </div>
   </div>
     <div class="clear"></div>
     <input type="submit" value="送信">
     </form>
   </div>


   <!-- 回答一覧表示 -->
   <h4><p>回答</p></h4>
     <?php
     $replyTexts = $db->prepare('select * from replyTexts,members where reply_id=? and replyTexts.user_id=members.id');
     $replyTexts->execute(array($_REQUEST['id']));
      ?>
      <?php while($replyText = $replyTexts->fetch()): ?>
        <div class="answerWrapper">
          <article>
            <div class="accountWrapper">
            <a href="userpage.php?user=<?php echo $replyText['user_id']; ?>"><img src="../member_picture/<?php echo $replyText['picture'] ?>" alt=""></a><br>
            <a href="userpage.php?user=<?php echo $replyText['user_id']; ?>"><?php echo $replyText['name'] ?>さん</a>
          </div>
            <p><?php echo $replyText['created_at']; ?></p>
            <h3><?php print($replyText['text']); ?></h3>
          </article>
        </div>
      <?php endwhile; ?>
    </main>
  </body>
</html>
