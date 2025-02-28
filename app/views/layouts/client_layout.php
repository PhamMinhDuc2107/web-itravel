<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $data['title'] ?? "Tour du lịch trong nước và quốc tế | Itravel - Đặt tour giá tốt nhất"?></title>
        <meta name="description" content="Itravel cung cấp các tour du lịch trong nước và quốc tế với giá tốt nhất. Đặt tour ngay hôm nay để nhận ưu đãi đặc biệt và trải nghiệm dịch vụ chuyên nghiệp." />
        <meta name="keywords" content="tour du lịch, đặt tour, du lịch trong nước, du lịch quốc tế, vé máy bay giá rẻ, khách sạn giá tốt" />
        <meta name="robots" content="index, follow"/>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="icon" type="image/png" href="<?php echo ASSET?>./client/images/itravel_resize-1.png">
        <meta property="og:title" content="Du lịch Hà Nội | Đặt Tour Hà Nội trọn gói giá ưu đãi cùng Vietravel.">
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "name": "Itravel",
                "url": "https://itravel.io.vn/",
                "logo": "<?php echo ASSET?>./client/images/itravel.png",
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "0989150732",
                    "contactType": "customer service"
                },
            }
        </script>
        <link
                href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,700&display=swap"
                rel="stylesheet"
        />
        <!-- font awesome -->
        <link
                rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        />
        <!-- swiper -->
        <link
                rel="stylesheet"
                href="https://unpkg.com/swiper/swiper-bundle.min.css"
        />
        <!-- Flatpickr -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <!-- css -->
        <link rel="stylesheet" href="<?php echo ASSET?>/client/css/reset.css">
        <link rel="stylesheet" href="<?php echo ASSET?>/client/css/app.css" />
    </head>
</head>
<body>
   <div class="wrapper">
      <?php require_once _DIR_ROOT . "/app/views/client/blocks/header.php" ?>

      <?php
      if(isset($data['page'])) {
         require_once _DIR_ROOT."/app/views/client/pages/".$data['page'].".view.php";
      }
      ?>
      <?php require_once _DIR_ROOT . "/app/views/client/blocks/footer.php" ?>
   </div>
</body>
<script src="<?php echo ASSET?>/client/js/app.js"></script>
<script src="<?php echo ASSET?>/client/js/home.js"></script>
</html>

