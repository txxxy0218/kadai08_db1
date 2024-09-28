<?php

require_once "dbc.php";

// 1.データの受け取り==========================================
$file        = $_FILES['image'];
$img_name    = basename($file['name']);
$img_type    = $file['type'];
$img_content = $file['tmp_name'];
$img_error   = $file['error'];
$img_size    = $file['size'];
$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/kadai08_db1/uploads/'; // サーバーの絶対パスを作成
$web_path = '/kadai08_db1/uploads/';  // これはブラウザからアクセス可能な相対パス
$save_img_name = date('YmdHis').$img_name;
$error_msgs = array();
$save_path = $web_path . $save_img_name; 

$title       = $_POST["title"];
$name        = $_POST["name"];
$date        = $_POST["date"];
$memo        = $_POST["memo"];


// 2.その他入力項目のバリデーション=============================
//作品名のバリデーション
if(empty($title)){
    array_push($error_msgs, '作品名を入力してください。');
}
if(strlen($title) > 256) {
    array_push($error_msgs, '作品名は256文字以内で入力してください。');
}

//作者名のバリデーション
if(empty($name)){
    array_push($error_msgs, '作者名を入力してください。');
}
if(strlen($name) > 64) {
    array_push($error_msgs, '作者名は64文字以内で入力してください。');
}

//制作年のバリデーション
if(empty($date)) {
    array_push($error_msgs, '制作年を入力してください。');
}



// 3.ファイルのバリデーション===================================
//ファイルサイズ
if($img_size > 1048576 || $img_error == 2){
    echo 'ファイルサイズは1MB未満にしてください。';
    echo '<br>';
}
//拡張子
$allow_ext = array('jpg','jpeg','png','svg');
$file_ext  = pathinfo($img_name, PATHINFO_EXTENSION);
if(!in_array(strtolower($file_ext), $allow_ext)){
    echo '画像ファイルを添付してください。';
    echo '<br>';
}

//ファイルがあるかどうか
if(count($error_msgs) === 0){
    if (is_uploaded_file($img_content)) {
        if (move_uploaded_file($img_content, $upload_dir.$save_img_name)) {
            echo $img_name.'をアップしました。';
            echo '<br>';
            
            //DBに保存する（ファイル名、ファイルパス、作品名、作者名、制作年、備考）
            $result = fileSave($img_name, $save_path, $title, $name, $date, $memo);
            if($result) {
                echo 'データベースに保存しました！';
            }else{
                echo 'データベースへの保存が失敗しました。';
            }

        } else {
            if (!is_dir($upload_dir)) {
                echo 'アップロードディレクトリが存在しません。';
                echo '<br>';
            } else {
                echo 'ディレクトリは存在していますが、ファイルを移動できませんでした。';
                echo '<br>';
                echo 'アップロードディレクトリのパス: ' . $upload_dir;
                echo '<br>';
            }
        }
    } else {
        echo 'ファイルが選択されていません';
        echo '<br>';
    }    
} else {
    foreach($error_msgs as $msg){
        echo $msg;
        echo '<br>';
    }
}


//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>
