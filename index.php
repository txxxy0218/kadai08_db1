<?php
require_once "dbc.php";
$files = getAllFile();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

<!-- Head[Start] -->
<header>
    <div class="logo">こども画伯</div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php" enctype="multipart/form-data">
  <div class="register">
    <fieldset>
        <legend>こども画伯の絵画登録</legend>
        <label>画像：
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
            <input type="file" name="image" accept="image/*">
        </label><br>
        <label>作品名：
            <input type="text" name="title">
        </label><br>
        <label>作者名：
            <input type="text" name="name">
        </label><br>
        <label>制作年：
            <input type="date" name="date">
        </label><br>
        <label>備考：
            <textArea name="memo" rows="4" cols="40"></textArea>
        </label><br>
        <input type="submit" value="送信">
    </fieldset>
  </div>
</form>

<div class="list">
    <?php foreach($files as $file): ?>
        <div class="card">
          <img src="<?php echo "{$file['img_path']}"; ?>" alt="" class="image">
          <p><?php echo "{$file['title']}"; ?></p>
          <p><?php echo "{$file['name']}"; ?></p>
          <p><?php echo "{$file['date']}"; ?></p>
          <p><?php echo "{$file['memo']}"; ?></p>
        </div>
    <?php endforeach; ?>
</div>
<!-- Main[End] -->


</body>
</html>
