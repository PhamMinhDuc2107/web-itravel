<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="<?php echo ASSET ?>/client/images/itravel_resize-1.png">
    <title><?php echo  $data['title'] ?? "Thông tin kết quả" ?></title>
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

        p {
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

        .alert-success,
        .alert-danger {
            width: 150px;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
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
            display: inline-block;
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

    ?>
    <div class="logo">
        <a href="<?php echo _WEB_ROOT ?>" class="nav__item--link">
            <img src="<?php echo ASSET ?>/client/images/itravel.png" alt="Thương hiệu hình ảnh của itravel" />
        </a>
    </div>
    <div class="result">
        <div class="wrap-alert">
            <?php if ($payload['type'] === "success"): ?>
                <div class="left">
                    <div class="alert alert-success">
                        <img src="<?php echo ASSET ?>/client/images/success.gif" alt="Thông báo thành công">
                    </div>
                    <div class="text">
                        <h2><?php echo $data['heading'] ?? "Cảm ơn bạn!" ?></h2>
                        <span><?php echo $data['content'] ?? "Một email xác nhận đã được gửi tới Bạn. Xin vui lòng kiểm tra email của bạn" ?></span>
                    </div>
                </div>
                <?php $booking = $data['booking'] ?? null ?>
                <?php if ($booking !== null): ?>
                    <div class="right">
                        <div class="header">
                            <h3>Đơn hàng (<?php echo htmlspecialchars($booking['booking_code']) ?>)</h3>
                        </div>
                        <div class="content">
                            <div class="row">
                                <h3>Tour: </h3>
                                <span><?php echo htmlspecialchars($booking['tour_name']) ?></span>
                            </div>
                            <div class="row">
                                <h3>Tên khách hàng: </h3>
                                <span><?php echo htmlspecialchars($booking['customer_name']) ?></span>
                            </div>
                            <div class="row">
                                <h3>Email: </h3>
                                <span><?php echo htmlspecialchars($booking['customer_email']) ?></span>
                            </div>
                            <div class="row">
                                <h3>Số điện thoại: </h3>
                                <span><?php echo htmlspecialchars($booking['customer_phone']) ?></span>
                            </div>
                            <div class="row">
                                <h3>Ngày đi: </h3>
                                <span><?php echo htmlspecialchars($booking['departure_date']) ?></span>
                            </div>
                            <div class="row">
                                <h3>Tổng người lớn: </h3>
                                <span><?php echo htmlspecialchars($booking['num_adults']) ?></span>
                            </div>
                            <div class="row">
                                <h3>Tổng người trẻ em: </h3>
                                <span><?php echo htmlspecialchars($booking['num_children']) ?></span>
                            </div>
                            <div class="row">
                                <h3>Tổng người trẻ nhỏ: </h3>
                                <span><?php echo htmlspecialchars($booking['num_infants']) ?></span>
                            </div>
                        </div>
                        <div class="bottom">
                            <h3>Tổng giá tiền: </h3>
                            <span><?php echo htmlspecialchars(number_format($booking['total_price'], 0, '.', ',')) ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-danger">
                    <img src="<?php echo ASSET ?>/client/images/danger.gif" alt="Thông báo thất bại">
                </div>
                <p>Trang thanh toán không tồn tại</p>
                <p>URL bạn nhập có thể đã hết hạn, bị xóa hoặc không hợp lệ. Quay trở lại trang chủ để tiếp tục mua hàng.</p>
            <?php endif; ?>
        </div>
        <a class="btn" href="<?php echo _WEB_ROOT ?>">Quay lại trang chủ</a>

    </div>
</body>

</html>