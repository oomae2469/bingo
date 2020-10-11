<?php
//初期化
$S = 0; //カードサイズ(S * S)
$N = 0; //選ぶ単語数
$A = []; //カードの単語
$w = []; //選ばれた単語

// 選ばれた単語情報をカードにあるかチェックあれば/代入
function wordCheck() {
    global $S, $N, $A, $w;
    for($n = 0; $n < $N; $n++) { 

        for ($i = 0; $i < $S; $i++) { 
            for ($j=0; $j < $S; $j++) { 

              //単語がある場合印をつける
              if ($A[$i][$j] == $w[$n]) {
                $A[$i][$j] = "/";
              }
            }
        }
    }
}

//ビンゴシートに印が入っているかチェック
function bingoCheck() {
  global $S, $N, $A, $w;
  //縦のライン
  for ($j = 0; $j < $S; $j++) { 
      $a = [];
      $line = [];
      for ($i=0; $i < $S; $i++) { 
          $a[] = $A[$i][$j];
      }
      $line = array_count_values($a);
      if($line["/"] == $S) {
        return 1;
      }
  }

  //横のライン
  for ($i = 0; $i < $S; $i++) { 
      $a = [];
      $line = [];
      for ($j = 0; $j < $S; $j++) { 
        $a[] = $A[$i][$j];       
      }

      $line = array_count_values($a);
      if($line["/"] == $S){
          return 1;
      }
  }

  //左上からのライン
  $a = [];
  $line = [];
  for($i=0; $i<$S; $i++){
      $a[] = $A[$i][$i];
  }
  $line = array_count_values($a);

  if($line["/"] == $S){
      return 1;
  }

  //右上からのライン
  $a = [];
    $line = [];
    for($i=0; $i<$S; $i++){
        $max = $S-1;
        $a[] = $A[$i][$max-$i];
    }
    $line = array_count_values($a);

    if($line["/"] == $S){
        return 1;
    }
}

//ビンゴカードの情報入力
$S = trim(fgets(STDIN));
for ($i = 0; $i < $S; $i++) { 
    $A[] = explode(" ", trim(fgets(STDIN)));
}


// 選ばれた単語情報取得
$N = trim(fgets(STDIN));
for ($i = 0; $i < $N; $i++) { 
    $w[] = trim(fgets(STDIN));
}

//単語のチェック
wordCheck();

//ビンゴの判定
if(bingoCheck()){
    print("yes");
} else {
    print("no");
}
?>