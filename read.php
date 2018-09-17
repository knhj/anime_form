<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ランキング表示</title>
        <style>

        body{
	        font-family: Roboto, "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
	        line-height: 1.75;
        	font-size: 16px;
        }

        table {
          border-collapse:  collapse; /* セルの線を重ねる */
        }
 
        tr:nth-child(odd) {
           background-color:  #ddd;    /* 背景色指定 */
        }
 
        th,td {
            padding: 5px 10px;          /* 余白指定 */
        }
        h1 {
            text-align:center;
            color:#fff;
            background-color:blue;
          
        }
        .sou{
            font-size:20px;
        }
        .flex{
            display:flex;
            justify-content:center;
        }
        #top{
            color:#fff;
            background-color:blue;
        }
        .center{
         text-align:center;
        }
        </style>
    </head>
    <body>


<h1>アニメ人気ランキング</h1>
<div class="sou">総投稿数:<?php echo $count;?></div>

<table class="flex">
    <tbody>
        <tr id="top">
            <th></th>
            <td class="center" >男</td>
            <td class="center">投票数</td>
            <td class="center">女</td>
            <td class="center">投票数</td>
        </tr>
<?php  

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_f01_db06;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbError:'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("select * from selectedanime ");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
	// $view .= "<p>".$result["animeID"]."-".$result["title"]."-".$result["year"]."</p>";
	$title = $result["title"];
	$year = $result["year"];
	$animeID = $result["animeID"];

	 $view .='<li class="anititle year';
	 $view .=$year;
	 $view .='">';
	 $view .='<input type="checkbox" name="anime[]" value="';
	 $view .=$animeID;
	 $view .='">'; 
	 $view .=$title;
	 $view .='</li>';
  }
}

$nameArray = array();
$mailArray = array();
$sexArray = array();
$animeArray = array();
$count = 0;

$totalAnime= array();
$manAnime=array();
$womanAnime=array();

for($i=0;$i<count($nameArray);$i++){
    $animeline = explode("/", $animeArray[$i]);
        foreach($animeline as $value){
            if($sexArray[$i] =="man"){$manAnime[] = $array[$value];}
            if($sexArray[$i] =="woman"){$womanAnime[] = $array[$value];}
        // $Aname[] = $array[$value];
        $totalAnime[] =$array[$value];
        }
// echo $nameArray[$i].",".$mailArray[$i].",".$sexArray[$i].",".implode("/",$Aname)."<br>";  
}
    // var_dump($totalAnime);
$totaldata = array_count_values($totalAnime);
arsort($totaldata);
$mandata = array_count_values($manAnime);
arsort($mandata);
$womandata = array_count_values($womanAnime);
arsort($womandata);

$MWrank = array();
$i=0;
foreach($mandata as $key=>$value){
    // echo "$key は $value 回出てきました<br>";
    $MWrank[$i][0] = $key;
    $MWrank[$i][1] = $value;
    $i++;
    if($i == 10){break;}
}

$i=0;
foreach($womandata as $key=>$value){
        // echo "$key は $value 回出てきました<br>";
    $MWrank[$i][2] = $key;
    $MWrank[$i][3] = $value;
    $i++;
    if($i == 10){break;}
}
//ここまでで[男アニメタイトル、票数、女アニメタイトル、票数]が要素の要素数が順位の配列ができる
// var_dump($MWrank);
$i=0;
foreach($MWrank as $value){
    $num = $i + 1;
    // echo "$key は $value 回出てきました<br>";
  echo  "<tr>";
  echo      "<th>".$num."位</th>";
  echo      "<td>".$MWrank[$i][0]."</td>";
  echo      "<td class='center'>".$MWrank[$i][1]."</td>";
  echo      "<td>".$MWrank[$i][2]."</td>";
  echo      "<td class='center'>".$MWrank[$i][3]."</td>";
  echo  "</tr>";

$i++;

}


?>
     </tbody>
</table>
    </body>
</html>