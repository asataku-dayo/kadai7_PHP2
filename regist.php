<?php

/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

$text1 = $_POST['uname1'];
$text2 = $_POST['uname2'];
$text;
$place;
if(empty($text1) && empty($text2)){
  header("Location: index.php");
  exit;
}else if(empty($text2)){
    $text = $text1;
    $place ="left";
}else if(empty($text1)){
    $text = $text2;
    $place = "right";
}


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
$stmt = $pdo->prepare("INSERT
                            INTO
                        gs_an_tables(id, text, place)
                        VALUES(NULL, :text, :place)"
                    );

$stmt->bindValue(':text', $text, PDO::PARAM_STR);
$stmt->bindValue(':place', $place, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
}
?>
