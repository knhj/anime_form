<?php
// user data read
$nameArray = array();
$mailArray = array();
$sexArray = array();
$animeArray = array();

$file = fopen('data/data.csv', 'r');
flock($file, LOCK_EX);			// ファイルロック
if($file){
  while ($line = fgets($file)) {//1行ずつ取得
    // echo "<p>".$line."</p>";
        // var_dump($line);
    $line = rtrim($line);  
    // var_dump($line);
    $splitedline = explode(",",$line);
    $nameArray[] = $splitedline[0];
    $mailArray[] = $splitedline[1];
    $sexArray[] = $splitedline[2];
    $animeArray[] = $splitedline[3];
  }
//    var_dump($animeArray);
}
flock($file, LOCK_UN);			// ファイルロック解除
fclose($file);

// animeDB read
$array = array();
$file2 = fopen('data/selectedanimes.csv', 'r');
flock($file2, LOCK_EX);			// ファイルロック
if($file2){
  while ($line2 = fgets($file2)) {//1行ずつ取得
    $splitedline2 = explode(",",$line2);
    $array += array($splitedline2[3]=>$splitedline2[4]);

    // var_dump($array);
    // echo $array[$splitedline2[3]];
    // echo $splitedline2[3]."=>".$array[$splitedline2[3]];
    //  echo "<br>";
  }
}
flock($file2, LOCK_UN);			// ファイルロック解除
fclose($file2);
//   var_dump($array);

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
    <?php  
    // $Aname = array();
    //  $animeline = explode("/", $animeArray[$i]);
    //  var_dump($animeline);
//    foreach($animeline as $value){
//         $Aname[] = $array[$value];
//     // echo $array[$value];
//     // echo $value;
//    }
$totalAnime= array();
   for($i=0;$i<count($nameArray);$i++){
        $Aname = array();
        $animeline = explode("/", $animeArray[$i]);
            foreach($animeline as $value){
            $Aname[] = $array[$value];
            $totalAnime[] =$array[$value];
            }
    // echo $nameArray[$i].",".$mailArray[$i].",".$sexArray[$i].",".implode("/",$Aname)."<br>";  
   }
    // var_dump($totalAnime);
    $data = array_count_values($totalAnime);
arsort($data);
var_dump($data);
foreach($data as $key=>$value){
    echo "$key は $value 回出てきました<br>";

}

    ?>
        <!-- <ul> -->
            <!-- <li><a href="index.php">index.php</a></li> -->
        <!-- </ul> -->
    </body>
</html>