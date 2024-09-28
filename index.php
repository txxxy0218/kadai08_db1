<?php
require_once "dbc.php";
$files = getAllFile();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php" enctype="multipart/form-data">
  <div class="jumbotron">
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

<div>
    <?php foreach($files as $file): ?>
        <img src="<?php echo "{$file['img_path']}"; ?>" alt="">
        <p><?php echo "{$file['title']}"; ?></p>
        <p><?php echo "{$file['name']}"; ?></p>
        <p><?php echo "{$file['date']}"; ?></p>
        <p><?php echo "{$file['memo']}"; ?></p>
    <?php endforeach; ?>
</div>
<!-- Main[End] -->


</body>
</html>
