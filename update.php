<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST['name']) || $_POST['name']=='' ||
  !isset($_POST['email']) || $_POST['email']=='' ||
  !isset($_POST['detail']) || $_POST['detail']==''
){
  exit('ParamError');
}

//1. POSTデータ取得
$id     = ;
$name   = ;
$email  = ;
$detail = ;

//2. DB接続します(エラー処理追加)



//3．データ登録SQL作成
$stmt = $pdo->prepare('**********************');
$stmt->bindValue(':a1', *****, **************);
$stmt->bindValue(':a2', *****, **************);
$stmt->bindValue(':a3', *****, **************);
$stmt->bindValue(':id', *****, **************);
$status = $stmt->execute();

//4．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
  header('***********');
  exit;
}
?>
