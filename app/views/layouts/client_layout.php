<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php $data['title'] ?? "Trang chủ" ?></title>
   <link rel="stylesheet" href="<?php echo _WEB_ROOT."/public/assets/client/css/app.css"?>">
</head>
<body>
   <?php require_once _DIR_ROOT . "/app/views/client/blocks/header.php" ?>

   <?php
        if(isset($data['page'])) {
           require_once _DIR_ROOT."/app/views/client/pages".$data['page'].".php";
        }
   ?>

   <?php require_once _DIR_ROOT . "/app/views/client/blocks/footer.php" ?>
</body>
</html>

