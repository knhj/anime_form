<?php
$name = $_POST["name"];
$mail = $_POST["mail"];
$sex = $_POST["sex"];
$anime = $_POST['anime'];
$animeToStr = "";
$str = "";

foreach($anime as $value){
$animeToStr .= $value; 
$animeToStr .= '/'; 
}
$animeToStr = rtrim($animeToStr, '/');   

$str = $name.",".$mail.",".$sex.",".$animeToStr;
$file = fopen("data/data.csv","a");	// ファイル読み込み
flock($file, LOCK_EX);			// ファイルロック
fwrite($file, $str."\n");
flock($file, LOCK_UN);			// ファイルロック解除
fclose($file);
?>


<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>file書き込み</title>
    </head>
    <body>
     <p>ご回答ありがとうございます！！</p> 
    <p><?- var_dump($str)  ;?></p>
    </body>
        <ul>
            <li><a href="read.php">集計結果はこちら</a></li>
        </ul>
    </body>
</html>