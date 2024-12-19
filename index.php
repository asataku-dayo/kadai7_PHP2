<?php

$db_name = '#';
$db_host = '#';
$db_id = '#';
$db_pw = '#';

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $server_info = 'mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host;
  $pdo = new PDO($server_info, $db_id, $db_pw);
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_tables;");

$status = $stmt->execute();
//３．データ表示
$view="";
if ($status===false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
if($result["place"] == "right"){
    $view .= '<div class="output right">';
    $view .= $result["text"];
    $view .= "</div>";
  }else if($result["place"] == "left") {
    $view .= '<div class="output left">';
    $view .= $result["text"];
    $view .= "</div>";
  }
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録画面</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Line風アプリ</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Edu+AU+VIC+WA+NT+Arrows:wght@400..700&family=Noto+Sans+JP:wght@100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style2.css" />
  </head>
  <body>
    <div class="title">
      <h2>Line風アプリ</h2>
    </div>
    <div class="main">
      <div class="output-a">
        <?= $view ?>
      </div>
    </div>
    <div class="form">
      <div class="text-write">
        <form action="regist.php" method="post">
        <input
          type="text"
          id="uname1"
          name="uname1"
          size="19"
          style="
            border-radius: 10px;
            box-shadow: 0px 2px rgb(173, 130, 70);
            border-color: rgb(173, 130, 70);
          "
          placeholder="テキストP1を入力してね！"
        />
        <input
          type="text"
          id="uname2"
          name="uname2"
          size="19"
          style="
            border-radius: 10px;
            box-shadow: 0px 2px rgb(173, 130, 70);
            border-color: rgb(173, 130, 70);
          "
          placeholder="テキストP2を入力してね！"
        />
      </div>
      <div class="send-btns">
        <input type="submit" id="userA" value="送信P1">
        <input type="submit" id="userB" value="送信P2">
      </div>
      </form>
    </div>
  </body>
</html>

</body>
</html>