<?php
    require_once __DIR__."/../components/alert.view.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo $data['title'] ?? "Tour du lịch trong nước và quốc tế | ITravel - Đặt tour giá tốt nhất" ?>
		</title>
		<meta name="robots" content="index, follow" />
		<meta name="description"
			content="<?php echo $data['seo_desc'] ?? "Itravel cung cấp các tour du lịch trong nước và quốc tế với giá tốt nhất. Đặt tour ngay hôm nay để nhận ưu đãi đặc biệt và trải nghiệm dịch vụ chuyên nghiệp." ?>" />
		<meta name=" keywords"
			content="<?php echo $data['seo_kw'] ?? "tour du lịch, tour du lịch trong nước, tour du lịch quốc tế, tour du lịch giá rẻ, đặt tour du lịch, đặt tour du lịch trong nước, đặt tour du lịch quốc tế, giá tour du lịch" ?>" />
		<meta name="author" content="ITravel" />
		<!-- Tags  -->
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php echo _WEB_ROOT . $_SERVER['REQUEST_URI']; ?>" />
		<meta property="og:title"
			content="<?php echo $data['seo_og_title'] ?? $data['title'] ?? "Tour du lịch trong nước và quốc tế | ITravel"; ?>" />
		<meta property="og:description"
			content="<?php echo $data['seo_og_desc'] ?? $data['desc'] ?? "Itravel cung cấp các tour du lịch trong nước và quốc tế với giá tốt nhất. Đặt tour ngay hôm nay để nhận ưu đãi đặc biệt."; ?>" />
		<meta property="og:image" content="<?php echo $data['seo_og_image'] ?? ASSET . "/client/images/itravel.png"; ?>" />
		<meta property="og:locale" content="vi_VN" />
		<meta property="og:site_name" content="<?= _WEB_ROOT ?> - Tour du lịch" />

		<!-- Twitter Tags -->
		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:title"
			content="<?php echo $data['seo_og_title'] ?? "Tour du lịch trong nước và quốc tế | ITravel"; ?>" />
		<meta name="twitter:description"
			content="<?php echo $data['seo_og_desc'] ?? "Itravel cung cấp các tour du lịch trong nước và quốc tế với giá tốt nhất."; ?>" />
		<meta name="twitter:image" content="<?php echo $data['og_image'] ?? ASSET . "/client/images/itravel.png"; ?>" />

		<link id="metaCanonical" rel='canonical' href="
			<?php echo _WEB_ROOT . $_SERVER['REQUEST_URI']; ?>" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link rel="icon" type="image/png" href="<?php echo ASSET ?>/client/images/itravel_resize-1.png">
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "Organization",
				"name": "Itravel",
				"url": "https://itravel.io.vn/",
				"logo": "<?php echo ASSET ?>/client/images/itravel.png",
				"contactPoint": {
					"@type": "ContactPoint",
					"telephone": "0989150732",
					"contactType": "customer service"
				}
			}
		</script>
		<link
			href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,700&display=swap"
			rel="stylesheet" />
		<!-- font awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
		<!-- swiper -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.js">
		</script>
		<!-- Flatpickr -->
		<link rel="stylesheet" href="<?php echo ASSET ?>/utils/flatpickr.min.css">
		<script type="text/javascript" src="<?php echo ASSET ?>/utils/flatpickr.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/l10n/vn.min.js">
		</script>
		<!-- jquery -->
		<script type="text/javascript" src="<?php echo ASSET ?>/utils/jquery-3.6.0.min.js"></script>
		<!-- toast -->
		<script  src="<?php echo ASSET ?>/client/js/toast.js"></script>
		<link rel="stylesheet" href="<?= ASSET?>/utils/alert/app.css">
    	<script src="<?= ASSET?>/utils/alert/app.js"></script>
		<!-- css -->
		<link rel="stylesheet" href="<?php echo ASSET ?>/client/css/reset.css">
		<link rel="stylesheet" href="<?php echo ASSET ?>/client/css/app.css" />
	</head>
</head>

<body>
<?php render_flash_alerts(); ?>

	<div class="wrapper">
		<?php require_once _DIR_ROOT . "/app/views/client/blocks/header.view.php" ?>
		<?php
		if (isset($data['breadcrumbs'])) {
			require_once _DIR_ROOT . "/app/views/client/blocks/breadcrumb.view.php";
		}
		?>
		<?php
		if (isset($data['page'])) {
			require_once _DIR_ROOT . "/app/views/client/pages/" . $data['page'] . ".view.php";
		}
		?>
		<?php require_once _DIR_ROOT . "/app/views/client/blocks/footer.view.php" ?>
		<?php require_once _DIR_ROOT . "/app/views/client/blocks/menu.view.php" ?>
		<?php require_once _DIR_ROOT . "/app/views/client/blocks/hotline.view.php" ?>
		<?php require_once _DIR_ROOT . "/app/views/client/blocks/social.view.php" ?>
		<div id="toast"></div>
	</div>

</body>
<script src="<?php echo ASSET ?>/client/js/app.js"> </script>

<?php
if (isset($data['js'])) {
	echo "<script src=" . ASSET . "/client/js/" . $data['js'] . ".js" . "></script>";
}
?>

</html>