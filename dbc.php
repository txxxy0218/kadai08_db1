<?php 

function dbc(){
    try {
        $db_name = 'ur-special_kg_db';
        $db_host = 'mysql3101.db.sakura.ne.jp';
        $db_id = '*****';
        $db_pw = '*****';

        $server_info = 'mysql;dbname='.$db_name. ';charset=utf8;host='.$db_host;
        $pdo = new PDO($server_info, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB_CONNECT:'.$e->getMessage());
    }
}

dbc();


/*
* ファイルデータを保存
* @param string $img_name ファイル名
* @param string $save_path 保存先のパス
* @param string $title 作品名
* @param string $name 作者名
* @param string $date 制作年
* @param string $memo 備考
* @return bool $result
*/

function fileSave($img_name, $save_path, $title, $name, $date, $memo) {
    $result = False;

    $sql  = "INSERT INTO artwork_table(img_name, img_path, title, name, date, memo)
                    VALUES(:img_name, :save_path, :title, :name, :date, :memo)";

    try{
        $stmt = dbc()->prepare($sql);
        $stmt->bindValue(':img_name',    $img_name,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
        $stmt->bindValue(':save_path',   $save_path,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
        $stmt->bindValue(':title',       $title,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
        $stmt->bindValue(':name',        $name,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
        $stmt->bindValue(':date',        $date,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
        $stmt->bindValue(':memo',        $memo,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
        $result = $stmt->execute(); //true or false
        return $result;
    }catch(\Exception $e){
        echo 'fileSave:'.$e->getMessage();
        return $result;
    }
}


/*
* ファイルデータを取得
* @return array $fireData
*/

function getAllFile(){
    $sql = "SELECT * FROM artwork_table";
    $fileData = dbc()->query($sql);
    return $fileData;
}

?>