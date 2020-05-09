<!-- ヘッダーファイル -->
<!-- サイト上の全てのヘッダーはこのファイルを読み込むことで表示させる。 -->


<!-- ユーザーのログイン状態により、登録ボタンかユーザー写真を表示するか決めるためセッション情報を取得する。 -->
<?php session_start(); ?>
<body>
  <div id="header">
		<div class="inner">
		<!-- ロゴ -->
    <div class="logo">
      <div class="titleWrapper">
			<a class="title" href="index.html">Company Name</a>
			<form class="" action="index.html" method="post">
				<input type="text" name="" value="">
				<input type="submit" name="" value="検索">
			</form>
      </div>
      <div class="titleWrapper">
        <!-- セッション有無の確認
          あればユーザー画像を、無ければ新規登録とログインボタンを表示
       -->
      <?php if ($_SESSION['id'] != ''):?>
        <img src="../member_picture/<?php echo $_SESSION['image']; ?>" alt="">
      <?php else : ?>
        <a class="register" href="register.php">新規登録</a><br>
  			<a class="register" href="login.php">ログイン</a>
      <?php endif; ?>
      </div>
		</div>
		<!-- / ロゴ -->

	  <!-- トップナビゲーション -->
		<ul id="topnav">
			<li class="active"><a href="index.php">トップページ<br><span>Top</span></a></li>
			<li><a href="category.php">カテゴリー<br><span>Categories</span></a></li>
      <li><a href="logout.php">ログアウト</a></li>
			<li><a href=
        <?php
      if (isset($_SESSION['id'])) {
        echo 'input.php';
      } else {
        echo 'login.php';
      }
       ?>>質問する<br><span>Ask</span></a></li>
		</ul>
		<!-- トップナビゲーション -->
  </div>
<!-- / ヘッダー -->
  </div>
</body>
<style>

@charset "utf-8";


/* =Reset default browser CSS.
Based on work by Eric Meyer: http://meyerweb.com/eric/tools/css/reset/index.html
-------------------------------------------------------------- */
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {border: 0;font-family: inherit;font-size: 100%;font-style: inherit;font-weight: inherit;margin: 0;outline: 0;padding: 0;vertical-align: baseline;}
:focus {outline: 0;}

ol, ul {list-style: none;}
table {border-collapse: separate;border-spacing: 0;}
caption, th, td {font-weight: normal;text-align: left;}
blockquote:before, blockquote:after,q:before, q:after {content: "";}
blockquote, q {quotes: "" "";}
a img{border: 0;}
figure{margin:0}
article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {display: block;}
/* -------------------------------------------------------------- */



body{
color:#333;
font:12px verdana,"ヒラギノ丸ゴ ProN W4","Hiragino Maru Gothic ProN","メイリオ","Meiryo","ＭＳ Ｐゴシック","MS PGothic",Sans-Serif;
line-height:1.5;
-webkit-text-size-adjust: none;
}


/* リンク設定
------------------------------------------------------------*/
a{color:#3f4360;text-decoration:none;}
a:hover{color:#292d48;}
a:active, a:focus{outline:0;}


/* 全体
------------------------------------------------------------*/
#wrapper{
margin:0 auto;
padding:0 1%;
width:98%;
position:relative;
}

.inner{
margin:0 auto;
width:100%;
}

/*************
/* ヘッダー
*************/
#header{
padding:10px 0 15px;
overflow:hidden;
background:#3f4360;
border-bottom:1px solid #292d48;
}

* html #header{height:1%;}

#header h1{
font-size:12px;
font-weight:normal;
color:#fff;
}


/*************
/* ロゴ
*************/
#header .logo{
float:left;
padding:20px 0 0;
}

.logo .title {
font-size:20px;
font-weight:bold;
line-height:1;
color:#fff;
}

.logo .titleWrapper {
  float:left;
}

.logo .titleWrapper img {
  width:50px;
  height:60px;
  margin-left: 20px;
}

.logo .titleWrapper .register {
  color:white;
  margin-left: 30px;
  margin-top: 30px;
  font-size:15px;
}
/**************************
/* トップナビゲーション
**************************/
ul#topnav{
float:right;
overflow:hidden;
}

* html ul#topnav{height:1%;}

ul#topnav li{
float:left;
margin:0 5px;
text-align:center;
}

ul#topnav a{
font-size:13px;
display:block;
padding:20px 10px;
color:#fff;
}

ul#topnav span{
color:#cdcdcd;
font-size:10px;
}

ul#topnav li.active a,ul#topnav a:hover{
background:#292d48;
border-radius:5px;
}

@media only screen and (min-width:960px){
	#wrapper,.inner{
	width:940px;
	padding:0;
	}


</style>
