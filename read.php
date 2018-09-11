<?php
$file = fopen('data/data.csv', 'r');
flock($file, LOCK_EX);			// ファイルロック
if($file){
  while ($line = fgets($file)) {//1行ずつ取得
    echo "<p>".$line."</p>";    //出力
  }
}
flock($file, LOCK_UN);			// ファイルロック解除
fclose($file);
?>

<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>file読み込み</title>
    </head>
    <body>
    <!-- <p>ファイルの内容を表示します．</p> -->
    </body>
        <ul>
            <!-- <li><a href="index.php">index.php</a></li> -->
        </ul>
    </body>
</html>