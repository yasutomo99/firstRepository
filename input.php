<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>MathJaxを動的に使う</title>
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
	<script>
  $(function() {
    $("#typeset").click(function() {
      $("#result").html($("#input").val());
      MathJax.Hub.Typeset($("#result")[0], function() { console.log("Done"); });
    });
  });
  MathJax.Hub.Config({
    tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
  });
  </script>

  <style>

  main {
    text-align: center;
  }

    section {
      margin:20px auto;
      padding:0 0 10px;
      display:inline-block;
      width:85%;
      border:1px solid black;
      border-radius: 5px;
      background-color: lightgray;
    }
    section h2 {
      font-size: 20px;
      background-color:#3f4360;
      color:white;
      border-radius: 5px 5px 0 0;
      padding:20px 5px;
    }

    section p {
      font-size:15px;
    }
    .title {
      width:350px;
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
    .button {
    }
    #input, #result {
      width:400px;
      height:400px;
      background-color: white;
    }
    #result {
      border:1px solid black;
    }

  </style>
</head>
<body>
  <?php require('header.php'); ?>
  <main>
  <section>
    <h2>質問フォーム</h2>
  <form action="input_do.php" method="post">
    <p>タイトル</p>
    <input class="title" name="title" value=""><br>
    <p>カテゴリー</p>
    <select name="categories">
      <?php
        $categoryArray = array('微積分学','線型代数学','論理学','位相空間論','測度論','ベクトル解析','微分方程式論','力学系論','確率系論','代数学');
        foreach ($categoryArray as $category) :?>
      <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
    <?php endforeach; ?>
    </select>
    <br>
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
      <input type="button" id="typeset" class="button" value="Typeset">
      <br>
      <input type="submit" name=""  class="button" value="投稿する">
  </form>
  </section>
</main>
</body>
</html>
