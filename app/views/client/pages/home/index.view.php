<!-- slider -->
<section class="home__slider swiper">
    <div class="swiper-button-prev"></div>
    <ul class="home__slider--list swiper-wrapper">
        <li class="home__slider--item">
            <img src="<?php echo ASSET?>/client/images/banner.jpg" alt="" />
        </li>
        <li class="home__slider--item swiper-slide">
            <img src="<?php echo ASSET?>/client/images/banner.jpg" alt="" />
        </li>
        <li class="home__slider--item swiper-slide">
            <img src="<?php echo ASSET?>/client/images/banner.jpg" alt="" />
        </li>
    </ul>
    <div class="swiper-button-next"></div>
</section>
<!-- slider -->
<!-- form search -->
<section class="search">
    <div class="container">
        <form class="search__container">
            <div class="search__group">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" class="search__input =" placeholder="Điểm đến?">
            </div>
            <div class="search__group">
                <i class="fa-solid fa-calendar-days"></i>
                <input type="text" id="celendar__input" class="search__input celendar__input" placeholder="Chọn ngày đi">
                <script>
                    flatpickr("#celendar__input", {
                        dateFormat: "d-m-Y",
                        defaultDate: null,
                        minDate:"today",
                    });
                </script>
            </div>
            <div class="search__group budget__wrap">
                <i class="fa-solid fa-hand-holding-dollar"></i>
                <input type="text" class="search__input input__budget" placeholder="Chọn mức giá" readonly >
                <div class="budget__dropdown">
                    <ul class="budget__list">
                        <li class="budget__item">Dưới 5 triệu</li>
                        <li class="budget__item">Từ 5 - 10 triệu</li>
                        <li class="budget__item">Từ 10 - 20 triệu</li>
                        <li class="budget__item">Trên 20 triệu</li>
                    </ul>
                </div>
            </div>
            <button class="btn search__btn">Tìm kiếm</button>
        </form>
    </div>
</section>
<!-- form search -->
<!-- product hot-->
<section class="tour tour-hot">
    <div class="container">
        <div class="tour__container tour-swiper swiper">
            <h3 class="tour__title block-title">
                Tour hot
            </h3>
            <div class="tour__list swiper-wrapper">
                <div class="tour__item swiper-slide">
                    <div class="tour__img">
                        <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                        <div class="tour__info--transport">
                            <i class="fa-solid fa-plane"></i>
                            <i class="fa-solid fa-bus"></i>
                        </div>
                    </div>
                    <div class="tour__item--wrap">
                        <div class="tour__name">
                            <a href="./productDetail.html">CẦN THƠ – SÓC TRĂNG – BẠC LIÊU CÀ MAU – ĐẤT MŨI – TIỀN GIANG – BẾN TRE -TÂY NINH – SÀI GÒN</a>
                        </div>
                        <div class="tour__info">
                            <div class="tour__info--location">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Từ: Hà Nội</span>
                            </div>
                        </div>
                        <div class="tour__detail">
                            <div class="tour__detail--top">
                                <div class="tour__detail--depart">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <div >
                                        <span>27/08/2025</span>
                                        <span class="color-red">(9 ngày 8 đêm)</span>
                                    </div>
                                </div>
                                <span>Giá chỉ</span>
                            </div>
                            <div class="tour__detail--bottom">
                                <div class="tour__detail--quantity">
                                    <i class="fa-solid fa-person"></i>
                                    <span>Còn: <strong>5 chỗ</strong></span>
                                </div>
                                <div class="tour__detail--price">
                                    <span>49,900,000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tour__item swiper-slide">
                    <div class="tour__img">
                        <img src="<?php echo ASSET?>/client/images/Ốc đảo Bahariya_0.jpg" alt="">
                        <div class="tour__info--transport">
                            <i class="fa-solid fa-bus"></i>
                        </div>
                    </div>
                    <div class="tour__item--wrap">
                        <div class="tour__name">
                            <a href="./productDetail.html">CAIRO - BAHARIYA - LUXOR - BIỂN ĐỎ</a>
                        </div>
                        <div class="tour__info">
                            <div class="tour__info--location">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Từ: Hà Nội</span>
                            </div>
                        </div>
                        <div class="tour__detail">
                            <div class="tour__detail--top">
                                <div class="tour__detail--depart">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <div >
                                        <span>27/08/2025</span>
                                        <span class="color-red">(9 ngày 8 đêm)</span>
                                    </div>
                                </div>
                                <span>Giá chỉ</span>
                            </div>
                            <div class="tour__detail--bottom">
                                <div class="tour__detail--quantity">
                                    <i class="fa-solid fa-person"></i>
                                    <span>Còn: <strong>5 chỗ</strong></span>
                                </div>
                                <div class="tour__detail--price">
                                    <span>49,900,000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tour__item swiper-slide">
                    <div class="tour__img">
                        <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                        <div class="tour__info--transport">
                            <i class="fa-solid fa-plane"></i>
                        </div>
                    </div>
                    <div class="tour__item--wrap">
                        <div class="tour__name">
                            <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                        </div>
                        <div class="tour__info">
                            <div class="tour__info--location">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Từ: Hà Nội</span>
                            </div>
                        </div>
                        <div class="tour__detail">
                            <div class="tour__detail--top">
                                <div class="tour__detail--depart">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <div >
                                        <span>27/08/2025</span>
                                        <span class="color-red">(9 ngày 8 đêm)</span>
                                    </div>
                                </div>
                                <span>Giá chỉ</span>
                            </div>
                            <div class="tour__detail--bottom">
                                <div class="tour__detail--quantity">
                                    <i class="fa-solid fa-person"></i>
                                    <span>Còn: <strong>5 chỗ</strong></span>
                                </div>
                                <div class="tour__detail--price">
                                    <span>49,900,000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tour__item swiper-slide">
                    <div class="tour__img">
                        <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                        <div class="tour__info--transport">
                            <i class="fa-solid fa-plane"></i>
                        </div>
                    </div>
                    <div class="tour__item--wrap">
                        <div class="tour__name">
                            <a href="./productDetail.html">CẦN THƠ – SÓC TRĂNG – BẠC LIÊU CÀ MAU – ĐẤT MŨI – TIỀN GIANG – BẾN TRE -TÂY NINH – SÀI GÒN</a>
                        </div>
                        <div class="tour__info">
                            <div class="tour__info--location">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Từ: Hà Nội</span>
                            </div>
                        </div>
                        <div class="tour__detail">
                            <div class="tour__detail--top">
                                <div class="tour__detail--depart">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <div >
                                        <span>27/08/2025</span>
                                        <span class="color-red">(9 ngày 8 đêm)</span>
                                    </div>
                                </div>
                                <span>Giá chỉ</span>
                            </div>
                            <div class="tour__detail--bottom">
                                <div class="tour__detail--quantity">
                                    <i class="fa-solid fa-person"></i>
                                    <span>Còn: <strong>5 chỗ</strong></span>
                                </div>
                                <div class="tour__detail--price">
                                    <span>49,900,000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tour__item swiper-slide">
                    <div class="tour__img">
                        <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                        <div class="tour__info--transport">
                            <i class="fa-solid fa-bus"></i>
                        </div>
                    </div>
                    <div class="tour__item--wrap">
                        <div class="tour__name">
                            <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                        </div>
                        <div class="tour__info">
                            <div class="tour__info--location">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Từ: Hà Nội</span>
                            </div>
                        </div>
                        <div class="tour__detail">
                            <div class="tour__detail--top">
                                <div class="tour__detail--depart">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <div >
                                        <span>27/08/2025</span>
                                        <span class="color-red">(9 ngày 8 đêm)</span>
                                    </div>
                                </div>
                                <span>Giá chỉ</span>
                            </div>
                            <div class="tour__detail--bottom">
                                <div class="tour__detail--quantity">
                                    <i class="fa-solid fa-person"></i>
                                    <span>Còn: <strong>5 chỗ</strong></span>
                                </div>
                                <div class="tour__detail--price">
                                    <span>49,900,000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tour__item swiper-slide">
                    <div class="tour__img">
                        <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                        <div class="tour__info--transport">
                            <i class="fa-solid fa-train-tram"></i>
                        </div>
                    </div>
                    <div class="tour__item--wrap">
                        <div class="tour__name">
                            <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                        </div>
                        <div class="tour__info">
                            <div class="tour__info--location">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Từ: Hà Nội</span>
                            </div>
                        </div>
                        <div class="tour__detail">
                            <div class="tour__detail--top">
                                <div class="tour__detail--depart">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <div >
                                        <span>27/08/2025</span>
                                        <span class="color-red">(9 ngày 8 đêm)</span>
                                    </div>
                                </div>
                                <span>Giá chỉ</span>
                            </div>
                            <div class="tour__detail--bottom">
                                <div class="tour__detail--quantity">
                                    <i class="fa-solid fa-person"></i>
                                    <span>Còn: <strong>5 chỗ</strong></span>
                                </div>
                                <div class="tour__detail--price">
                                    <span>49,900,000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tour__item swiper-slide">
                    <div class="tour__img">
                        <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                        <div class="tour__info--transport">
                            <i class="fa-solid fa-train-tram"></i>
                        </div>
                    </div>
                    <div class="tour__item--wrap">
                        <div class="tour__name">
                            <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                        </div>
                        <div class="tour__info">
                            <div class="tour__info--location">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Từ: Hà Nội</span>
                            </div>
                        </div>
                        <div class="tour__detail">
                            <div class="tour__detail--top">
                                <div class="tour__detail--depart">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <div >
                                        <span>27/08/2025</span>
                                        <span class="color-red">(9 ngày 8 đêm)</span>
                                    </div>
                                </div>
                                <span>Giá chỉ</span>
                            </div>
                            <div class="tour__detail--bottom">
                                <div class="tour__detail--quantity">
                                    <i class="fa-solid fa-person"></i>
                                    <span>Còn: <strong>5 chỗ</strong></span>
                                </div>
                                <div class="tour__detail--price">
                                    <span>49,900,000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>
<!-- product -->
<!-- product hot-->
<section class="tour">
    <div class="container">
        <div class="tour__container tabs">
            <div class="tour__nav">
                <h3 class="tour__title block-title">
                    Tour ngoài nước
                </h3>
                <ul class="tour__nav--list ">
                    <li class="tour__nav--item tab--link tab--active" data-tab ="1">
                        Hà Quốc
                    </li>
                    <li class="tour__nav--item tab--link" data-tab ="2">
                        Trung Quốc
                    </li>
                    <li class="tour__nav--item tab--link" data-tab ="3">
                        Thái Lan
                    </li>
                </ul>
            </div>
            <div class="tour-swiper swiper ">
                <div class="tour__list swiper-wrapper tab--content tab__content--active" data-tab="1">
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CẦN THƠ – SÓC TRĂNG – BẠC LIÊU CÀ MAU – ĐẤT MŨI – TIỀN GIANG – BẾN TRE -TÂY NINH – SÀI GÒN</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Ốc đảo Bahariya_0.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CAIRO - BAHARIYA - LUXOR - BIỂN ĐỎ</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CẦN THƠ – SÓC TRĂNG – BẠC LIÊU CÀ MAU – ĐẤT MŨI – TIỀN GIANG – BẾN TRE -TÂY NINH – SÀI GÒN</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-train-tram"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-train-tram"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="tour-swiper swiper tab--content">
                <div class="tour__list swiper-wrapper tab--content" data-tab="2">
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CẦN THƠ – SÓC TRĂNG – BẠC LIÊU CÀ MAU – ĐẤT MŨI – TIỀN GIANG – BẾN TRE -TÂY NINH – SÀI GÒN</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Ốc đảo Bahariya_0.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CAIRO - BAHARIYA - LUXOR - BIỂN ĐỎ</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="tour-swiper swiper tab--content">
                <div class="tour__list swiper-wrapper tab--content" data-tab="3">
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CẦN THƠ – SÓC TRĂNG – BẠC LIÊU CÀ MAU – ĐẤT MŨI – TIỀN GIANG – BẾN TRE -TÂY NINH – SÀI GÒN</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Ốc đảo Bahariya_0.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CAIRO - BAHARIYA - LUXOR - BIỂN ĐỎ</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <a href="./product.html" class="btn btn-1 btn-more">Xem tất cả</a>
        </div>
    </div>
</section>
<!-- product -->
<!-- product hot-->
<section class="tour">
    <div class="container">
        <div class="tour__container tabs">
            <div class="tour__nav">
                <h3 class="tour__title block-title">
                    Tour trong nước
                </h3>
                <ul class="tour__nav--list">
                    <li class="tour__nav--item tab--link tab--active" data-tab ="4">
                        Hà Nội
                    </li>
                    <li class="tour__nav--item tab--link" data-tab ="5">
                        TP Hồ Chí Minh
                    </li>
                    <li class="tour__nav--item tab--link" data-tab ="6">
                        Đà Nẵng
                    </li>
                </ul>
            </div>
            <div class="tour-swiper swiper">
                <div class="tour__list swiper-wrapper tab--content tab__content--active " data-tab="4">
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CẦN THƠ – SÓC TRĂNG – BẠC LIÊU CÀ MAU – ĐẤT MŨI – TIỀN GIANG – BẾN TRE -TÂY NINH – SÀI GÒN</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Ốc đảo Bahariya_0.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CAIRO - BAHARIYA - LUXOR - BIỂN ĐỎ</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CẦN THƠ – SÓC TRĂNG – BẠC LIÊU CÀ MAU – ĐẤT MŨI – TIỀN GIANG – BẾN TRE -TÂY NINH – SÀI GÒN</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-train-tram"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-train-tram"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="tour-swiper swiper">
                <div class="tour__list swiper-wrapper tab--content" data-tab="5">
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CẦN THƠ – SÓC TRĂNG – BẠC LIÊU CÀ MAU – ĐẤT MŨI – TIỀN GIANG – BẾN TRE -TÂY NINH – SÀI GÒN</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Ốc đảo Bahariya_0.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CAIRO - BAHARIYA - LUXOR - BIỂN ĐỎ</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/1_20.png" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">SAINT PETERSBURG - MOSCOW</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="tour-swiper swiper">
                <div class="tour__list swiper-wrapper tab--content" data-tab="6">
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-plane"></i>
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CẦN THƠ – SÓC TRĂNG – BẠC LIÊU CÀ MAU – ĐẤT MŨI – TIỀN GIANG – BẾN TRE -TÂY NINH – SÀI GÒN</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="tour__item swiper-slide">
                        <div class="tour__img">
                            <img src="<?php echo ASSET?>/client/images/Ốc đảo Bahariya_0.jpg" alt="">
                            <div class="tour__info--transport">
                                <i class="fa-solid fa-bus"></i>
                            </div>
                        </div>
                        <div class="tour__item--wrap">
                            <div class="tour__name">
                                <a href="./productDetail.html">CAIRO - BAHARIYA - LUXOR - BIỂN ĐỎ</a>
                            </div>
                            <div class="tour__info">
                                <div class="tour__info--location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Từ: Hà Nội</span>
                                </div>
                            </div>
                            <div class="tour__detail">
                                <div class="tour__detail--top">
                                    <div class="tour__detail--depart">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <div >
                                            <span>27/08/2025</span>
                                            <span class="color-red">(9 ngày 8 đêm)</span>
                                        </div>
                                    </div>
                                    <span>Giá chỉ</span>
                                </div>
                                <div class="tour__detail--bottom">
                                    <div class="tour__detail--quantity">
                                        <i class="fa-solid fa-person"></i>
                                        <span>Còn: <strong>5 chỗ</strong></span>
                                    </div>
                                    <div class="tour__detail--price">
                                        <span>49,900,000đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <a href="./product.html" class="btn btn-1 btn-more">Xem tất cả</a>
        </div>
    </div>
</section>
<!-- product -->
<!-- favorite -->
<section class="favorite">
    <div class="container">
        <div class="favorite__container">
            <div class="favorite__top">
                <h3 class="block-title">Điểm đến yêu thích</h3>
                <a href="./product.html">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </div>
            <div class="favorite__block">
                <div class="favorite__list row-1">
                    <div class="favorite__item">
                        <div class="favorite__item--text">
                            <a href="#">Combo du lịch Ý</a>
                        </div>
                        <div class="favorite__item--img">
                            <img src="<?php echo ASSET?>/client/images/Monaco.jpg" alt="">
                        </div>
                    </div>
                    <div class="favorite__item">
                        <div class="favorite__item--text">
                            <a href="#">Combo du lịch Ý</a>
                        </div>
                        <div class="favorite__item--img">
                            <img src="<?php echo ASSET?>/client/images/Monaco.jpg" alt="">
                        </div>
                    </div>
                    <div class="favorite__item">
                        <div class="favorite__item--text">
                            <a href="#">Combo du lịch Ý</a>
                        </div>
                        <div class="favorite__item--img">
                            <img src="<?php echo ASSET?>/client/images/Monaco.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="favorite__list row-2">
                    <div class="favorite__item">
                        <div class="favorite__item--text">
                            <a>Hà Nội</a>
                        </div>
                        <div class="favorite__item--img">
                            <img src="<?php echo ASSET?>/client/images/Monaco.jpg" alt="">
                        </div>
                    </div>
                    <div class="favorite__item">
                        <div class="favorite__item--text">
                            <a>Bangkok</a>
                        </div>
                        <div class="favorite__item--img">
                            <img src="<?php echo ASSET?>/client/images/Monaco.jpg" alt="">
                        </div>
                    </div>
                    <div class="favorite__item">
                        <div class="favorite__item--text">
                            <a>Phú Quốc</a>
                        </div>
                        <div class="favorite__item--img">
                            <img src="<?php echo ASSET?>/client/images/Monaco.jpg" alt="">
                        </div>
                    </div>
                    <div class="favorite__item">
                        <div class="favorite__item--text">
                            <a>Nhật Bản</a>
                        </div>
                        <div class="favorite__item--img">
                            <img src="<?php echo ASSET?>/client/images/Monaco.jpg" alt="">
                        </div>
                    </div>
                    <div class="favorite__item">
                        <div class="favorite__item--text">
                            <a>Pháp</a>
                        </div>
                        <div class="favorite__item--img">
                            <img src="<?php echo ASSET?>/client/images/Monaco.jpg" alt="">
                        </div>
                    </div>
                    <div class="favorite__item">
                        <div class="favorite__item--text">
                            <a>Đằ Nẵng</a>
                        </div>
                        <div class="favorite__item--img">
                            <img src="<?php echo ASSET?>/client/images/Monaco.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- favorite -->
<!-- whychose -->
<section class="whychose">
    <div class="container">
        <div class="whychose__container">
            <h3 class="whychose__title block-title">Vì sao chọn Itravel</h3>
            <div class="whychose__content">
                <div class="column">
                    <i class="fa-solid fa-box"></i>
                    <div class="info">
                        <h4>Sản phẩm & Dịch vụ </h4>
                        <span>Đa dạng - Chất lượng - An toàn</span>
                    </div>
                </div>
                <div class="column">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <div class="info">
                        <h4>Giá tour siêu tốt</h4>
                        <span>Tối ưu - tiện lợi - đa dạng</span>
                    </div>
                </div>
                <div class="column">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    <div class="info">
                        <h4>Thanh toán & Hỗ trợ</h4>
                        <span>Linh hoạt - Tận tâm - Chu đáo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- whychose -->
<!-- feedback -->
<section class="feedback">
    <div class="container">
        <div class="feedback__container feedback-swiper">
            <h3 class="block-title">
                Khách hàng nói gì về chúng tôi
            </h3>
            <div class="feedback__list swiper-wrapper">
                <div class="feedback__item swiper-slide">
                    <p>
                        "Dịch vụ rất tuyệt vời. Mình đã có một chuyến đi cực kì đáng nhớ. ND Travel đã hỗ trợ rất nhanh khi gặp vấn đề và mình rất đánh giá cao chăm sóc khách hàng. Rất may mắn khi lựa chọn ND Travel cho chuyến đi lần này."
                    </p>
                    <div class="start">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="info">
                        <img src="<?php echo ASSET?>/client/images/best-product 1.png" alt="">
                        <span>Moon</span>
                    </div>
                </div>
                <div class="feedback__item swiper-slide">
                    <p>
                        "Dịch vụ rất tuyệt vời. Mình đã có một chuyến đi cực kì đáng nhớ. ND Travel đã hỗ trợ rất nhanh khi gặp vấn đề và mình rất đánh giá cao chăm sóc khách hàng. Rất may mắn khi lựa chọn ND Travel cho chuyến đi lần này."
                    </p>
                    <div class="start">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="info">
                        <img src="<?php echo ASSET?>/client/images/404.png" alt="">
                        <span>Moon</span>
                    </div>
                </div>
                <div class="feedback__item swiper-slide">
                    <p>
                        "Dịch vụ rất tuyệt vời. Mình đã có một chuyến đi cực kì đáng nhớ. ND Travel đã hỗ trợ rất nhanh khi gặp vấn đề và mình rất đánh giá cao chăm sóc khách hàng. Rất may mắn khi lựa chọn ND Travel cho chuyến đi lần này."
                    </p>
                    <div class="start">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="info">
                        <img src="<?php echo ASSET?>/client/images/404.png" alt="">
                        <span>Moon</span>
                    </div>
                </div>
                <div class="feedback__item swiper-slide">
                    <p>
                        "Dịch vụ rất tuyệt vời. Mình đã có một chuyến đi cực kì đáng nhớ. ND Travel đã hỗ trợ rất nhanh khi gặp vấn đề và mình rất đánh giá cao chăm sóc khách hàng. Rất may mắn khi lựa chọn ND Travel cho chuyến đi lần này."
                    </p>
                    <div class="start">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="info">
                        <img src="<?php echo ASSET?>/client/images/404.png" alt="">
                        <span>Moon</span>
                    </div>
                </div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>
<!-- feedback -->
<!-- blog -->
<section class="blog home-page">
    <div class="container">
        <div class="blog__container">
            <div class="blog__top">
                <h3 class="block-title">Cẩm nang du lịch</h3>
                <a href="./blog.html">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </div>
            <div class="blog__wrap">
                <div class="blog__list">
                    <div class="blog__item blog__item--full">
                        <div class="detail">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="info">
                                <a href="">Top 5 địa điểm hấp dẫn nhất định phải tới khi đi tour Đài Loan</a>
                                <span>01/20/2025 - 10:01</span>
                            </div>
                        </div>
                    </div>
                    <div class="blog__item">
                        <div class="detail">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="info">
                                <a href="">Top 5 địa điểm hấp dẫn nhất định phải tới khi đi tour Đài Loan</a>
                                <span>01/20/2025 - 10:01</span>
                            </div>
                        </div>
                    </div>
                    <div class="blog__item">
                        <div class="detail">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="info">
                                <a href="">Top 5 địa điểm hấp dẫn nhất định phải tới khi đi tour Đài Loan</a>
                                <span>01/20/2025 - 10:01</span>
                            </div>
                        </div>
                    </div>
                    <div class="blog__item">
                        <div class="detail">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="info">
                                <a href="">Top 5 địa điểm hấp dẫn nhất định phải tới khi đi tour Đài Loan</a>
                                <span>01/20/2025 - 10:01</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog__list blog__list--full">
                    <div class="blog__item ">
                        <div class="detail">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="info">
                                <a href="">Top 5 địa điểm hấp dẫn nhất định phải tới khi đi tour Đài Loan</a>
                                <span>01/20/2025 - 10:01</span>
                            </div>
                        </div>
                    </div>
                    <div class="blog__item ">
                        <div class="detail">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="info">
                                <a href="">Top 5 địa điểm hấp dẫn nhất định phải tới khi đi tour Đài Loan</a>
                                <span>01/20/2025 - 10:01</span>
                            </div>
                        </div>
                    </div>
                    <div class="blog__item ">
                        <div class="detail">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="info">
                                <a href="">Top 5 địa điểm hấp dẫn nhất định phải tới khi đi tour Đài Loan</a>
                                <span>01/20/2025 - 10:01</span>
                            </div>
                        </div>
                    </div>
                    <div class="blog__item ">
                        <div class="detail">
                            <img src="<?php echo ASSET?>/client/images/Du-lịch-Thổ-Nhĩ-Kỳ-mùa-nào-đẹp-nhất-2.jpg" alt="">
                            <div class="info">
                                <a href="">Top 5 địa điểm hấp dẫn nhất định phải tới khi đi tour Đài Loan</a>
                                <span>01/20/2025 - 10:01</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /blog -->
<!-- brand -->
<section class="brand">
    <div class="container">
        <div class="brand__container ">
            <h3 class="block-title">
                Đồng hành cùng ITravel
            </h3>
            <div class="swiper brand-swiper">
                <div class="brand__list swiper-wrapper">
                    <img class="swiper-slide" src="<?php echo ASSET?>/client/images/logo_brand1.webp" alt="">
                    <img class="swiper-slide" src="<?php echo ASSET?>/client/images/logo_brand2.webp" alt="">
                    <img class="swiper-slide" src="<?php echo ASSET?>/client/images/logo_brand1.webp" alt="">
                    <img class="swiper-slide" src="<?php echo ASSET?>/client/images/logo_brand2.webp" alt="">
                    <img class="swiper-slide" src="<?php echo ASSET?>/client/images/logo_brand1.webp" alt="">
                    <img class="swiper-slide" src="<?php echo ASSET?>/client/images/logo_brand2.webp" alt="">
                    <img class="swiper-slide" src="<?php echo ASSET?>/client/images/logo_brand1.webp" alt="">
                    <img class="swiper-slide" src="<?php echo ASSET?>/client/images/logo_brand2.webp" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- brand -->
<script>
    (function() {
        document.addEventListener("DOMContentLoaded", function () {

            let budget = document.querySelector(".input__budget");
            let budgetDropdown = document.querySelector(".budget__dropdown");
            let budgetList = document.querySelectorAll(".budget__item")
            budget.addEventListener("click", function(e) {
                budgetDropdown.classList.toggle("active__dropdown");
            });
            budgetDropdown.addEventListener("click", function(e) {
                if(e.target.classList.contains("budget__item")) {
                    console.log(e.target)
                    budget.setAttribute("value", e.target.textContent);
                    budgetDropdown.classList.remove("active__dropdown");
                    [...budgetList].forEach((item)=> {
                        if(item.classList.contains("active__item")) {
                            item.classList.remove("active__item");
                        }
                    })
                    e.target.classList.add("active__item")
                }
            })
        })
    })()
</script>
<script>
    const tourSwiper = new Swiper('.tour-swiper', {
        slidesPerView: 4,
        spaceBetween: 20,
        rewind: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            990: {
                slidesPerView: 4,
                slidesPerRow: 1,
                slidesPerColumn: 1,
                spaceBetween: 20,
            },
            765: {
                slidesPerView: 3,
                slidesPerRow: 1,
                slidesPerColumn: 1,
                spaceBetween: 10,
            },
            480: {
                slidesPerView: 2,
                slidesPerRow: 1,
                slidesPerColumn: 1,
                spaceBetween: 10,
            },
            300: {
                slidesPerView: 1.5,
                slidesPerRow: 1,
                slidesPerColumn: 1,
            },
        },
    });
    const sliderSwiper = new Swiper(".home__slider", {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        rewind: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
    });
    var feedbackSwiper = new Swiper(".feedback-swiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "3",
        loop:true,
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        autoplay: {
            delay:5000,
            disableOnInteraction:false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            990: {
                slidesPerView: 3,

            },
            765: {
                slidesPerView: 2,

            },
            480: {
                slidesPerView: 1.5,
            },300: {
                slidesPerView: 1,
            },
        },
    });
    const brandSwiper = new Swiper('.brand-swiper', {
        slidesPerView: 6,
        spaceBetween: 20,
        rewind: true,
        autoplay: {
            delay:3000,
            disableOnInteraction:false,
        },
        breakpoints: {
            990: {
                slidesPerView: 6,

            },
            765: {
                slidesPerView: 5,

            },
            480: {
                slidesPerView: 4,
            },
            300: {
                slidesPerView: 3,
            },
        },
    });
</script>