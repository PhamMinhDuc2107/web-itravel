<!DOCTYPE html>
<html lang="en">
<?php $data = $this->data?>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $data["title"] ?? "Thông tin đặt hàng"?></title>
</head>
<body>
   <div class="header" style=" text-align: center;">
      <img src="cid:logo_cid" alt="Logo" style="width: 250px;padding:20px 0; display: block; margin: 0 auto;">
   </div>
   <table style="width: 100%;">
      <?php require_once _DIR_ROOT."/app/views/mail/page/". $this->data['page'].'.view.php'?>
      <tr>
         <td style="padding: 30px; text-align: center; color: #888888; font-size: 14px;">
            <p>Mọi thắc mắc xin vui lòng liên hệ: <a href="mailto:hotro@itravel.vn">hotro@itravel.vn</a></p>
            <p>Cảm ơn bạn đã tin tưởng và đồng hành cùng Itravel!</p>
         </td>
      </tr>

      <tr>
         <td style="background-color: #f4f4f4; text-align: center; padding: 15px; color: #999; font-size: 12px;">
            © 2025 Itravel. All rights reserved.
         </td>
      </tr>
   </table>
</body>
</html>