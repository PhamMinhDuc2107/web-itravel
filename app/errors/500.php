<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $data['title'] ?? "InternalServer"?></title>
    <meta name="description" content="InternalServer">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,700&display=swap"
            rel="stylesheet"
    />
    <style>

      .err-server {
         padding: 0 1rem;
         margin: auto;
         display: flex;
         justify-content: center;
         align-items: center;
      }
    </style>
</head>
<body>
<section class="err-server">
    <img src="<?php echo ASSET.'/client/images/500.png'?>" alt="Error Server">
</section>
</body>
</html>
