<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $data['title'] ?? "Not Found"?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,700&display=swap"
            rel="stylesheet"
    />
    <style>
        .notfound {
            width: 100%;
            height: 100%;
            position: relative;
            margin:8rem auto 8rem;
            min-width: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            img {
                width: 400px;
                height: 400px;
            }
            h1 {
                font-size: 46px;
                line-height: 70px;
                font-weight: bold;
                margin: 25px auto;
            }
            p {
                color: #52575C;
                line-height: 25px;
                font-weight: 600;
                margin: 10px auto;
            }
            .btn {
                margin-top: 20px;
                padding:10px 20px;
                border-radius: 16px;
                background-image: linear-gradient(310deg, rgb(45, 206, 137) 0%, rgb(45, 206, 204) 100%);
                color: white;
                text-decoration: none;
                &:hover {
                    opacity: 0.8;
                }
            }
        }

    </style>
</head>
<body>
<section class="notfound">
    <img src="<?php echo ASSET.'/admin/img/404.png'?>" alt="">
    <h1>Không tìm thấy nội dung 😓</h1>
    <p>URL của nội dung này đã bị thay đổi hoặc không còn tồn tại.</p>
    <p>Nếu bạn đang lưu URL này, hãy thử truy cập lại từ trang chủ thay vì dùng URL đã lưu.</p>
    <a href="<?php echo _WEB_ROOT?>" class="btn">Về trang chủ</a>
</section>
</body>
</html>
