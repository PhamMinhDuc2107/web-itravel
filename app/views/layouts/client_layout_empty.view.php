<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="<?php echo ASSET?>/client/images/itravel_resize-1.png">
    <title><?php echo  Request::input('type') === "success" ? "Thành công" : "Thất bại" ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: rgba(147, 232, 211, 0.27);
            width: 100vw;
            height: 100vh;
            position: relative;
        }
        .logo {
            padding: 1rem 2rem;
            border-bottom: 1px solid #23bda4;
        }
        .logo img {
            width: 150px;
        }
        .result {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .wrap-alert {
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
        }
        p  {
            margin-top: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: 500;
        }
        .alert {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            flex-direction: column;

        }
        .text {
            text-align: center;
            h2 {
                margin: 10px 0;
            }
        }
        .alert-success {
            border: 1px solid #23bda4;
        }
        .alert-danger {
            border: 1px solid #ec0404;
        }
        .left {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            gap: 20px;

        }
        .right {
            width: 100%;
            background-color: #fff;
            padding: 1rem;
        }
        h3 {
            font-size: 14px;
            font-weight: 600;
        }
        .header {
            padding-bottom: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e1e5e5;
        }
        .content {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e1e5e5;
            .row {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 5px 0;
            }
        }
        .btn {
            display:inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: white;
            margin-top: 10px;
            border-radius: 16px;
            border: 1px solid transparent;
            background-color: #23bda4;
            transition: all 0.3s linear;
        }
        .bottom {
            display: flex;
            gap: 10px;
            align-items: center;
            span {
                color: red;
            }
        }
        .btn:hover {
            background-color: #fff;
            border-color: #23bda4;
            color: #23bda4;
        }
    </style>
</head>

<body>
<?php
    $payload = $_GET ?? [];
    if(!empty($payload) && $payload['type'] === "success") {
        $data = $payload["data"] ?? [];
        $booking = $data["booking"] ?? null;
        $title =htmlspecialchars($data["title"]) ?? null;
        $content = htmlspecialchars($data["content"]) ?? null;
    }
    
    ?>
    <div class="logo">
        <a href="<?php echo _WEB_ROOT?>" class="nav__item--link">
            <img src="<?php echo ASSET?>/client/images/itravel.png" alt="Thương hiệu hình ảnh của itravel" />
        </a>
    </div>
    <div class="result">
        <div class="wrap-alert">
       <?php if(Request::input('type') === "success"):?>
                <div class="left">
                    <div class="alert alert-success">
                        <svg width="40px" height="40px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#23bda4" stroke-width="0.40800000000000003" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
                    <div class="text">
                        <h2><?php echo $title ?? "Cảm ơn bạn!"?></h2>
                        <span><?php echo $content ??"Một email xác nhận đã được gửi tới Bạn. Xin vui lòng kiểm tra email của bạn"?></span>
                    </div>
                </div>
                <?php if($booking !== null):?>
               <div class="right">
                   <div class="header">
                       <h3>Đơn hàng (<?php echo htmlspecialchars($booking['booking_code'])?>)</h3>
                   </div>
                   <div class="content">
                       <div class="row">
                           <h3>Tour: </h3>
                           <span><?php echo htmlspecialchars($booking['tour_name'])?></span>
                       </div>
                       <div class="row">
                           <h3>Tên khách hàng: </h3>
                           <span><?php echo htmlspecialchars($booking['customer_name'])?></span>
                       </div>
                       <div class="row">
                           <h3>Email: </h3>
                           <span><?php echo htmlspecialchars($booking['customer_email'])?></span>
                       </div>
                       <div class="row">
                           <h3>Số điện thoại: </h3>
                           <span><?php echo htmlspecialchars($booking['customer_phone'])?></span>
                       </div><div class="row">
                           <h3>Ngày đi: </h3>
                           <span><?php echo htmlspecialchars($booking['departure_date'])?></span>
                       </div>
                       <div class="row">
                           <h3>Tổng người lớn: </h3>
                           <span><?php echo htmlspecialchars($booking['num_adults'])?></span>
                       </div>
                       <div class="row">
                           <h3>Tổng người trẻ em: </h3>
                           <span><?php echo htmlspecialchars($booking['num_children'])?></span>
                       </div>
                       <div class="row">
                           <h3>Tổng người trẻ nhỏ: </h3>
                           <span><?php echo htmlspecialchars($booking['num_infants'])?></span>
                       </div>
                   </div>
                   <DIV class="bottom">
                       <h3>Tổng giá tiền: </h3>
                       <span><?php echo htmlspecialchars(number_format($booking['total_price'], 0, '.', ','))?></span>
                   </DIV>
               </div>
                <?php endif;?>
       <?php else:?>
       <div class="alert alert-danger">
           <svg  width="60px" height="60px" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 21.32L21 3.32001" stroke="#ec0404" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M3 3.32001L21 21.32" stroke="#ec0404" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
       </div>
           <p>Trang thanh toán không tồn tại</p>
           <p>URL bạn nhập có thể đã hết hạn, bị xóa hoặc không hợp lệ. Quay trở lại trang chủ để tiếp tục mua hàng.</p>
       <?php endif;?>
        </div>
        <a class="btn" href="<?php echo _WEB_ROOT?>">Quay lại trang chủ</a>

    </div>
</body>
</html>