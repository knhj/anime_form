<?php
$num1 = $argv[1];
$file = fopen($num1, 'r');
flock($file, LOCK_EX);			
    if($file){


     
        while ($line = fgets($file)) {//1行ずつ取得         
               $splitedline = explode(",",$line);
               echo $splitedline[3].",".$splitedline[4].",".$splitedline[7];
            // echo $splitedline[3];
               echo "\n";  

    // break;
        }
    }
    
flock($file, LOCK_UN);			// ファイルロック解除
fclose($file);

?>
