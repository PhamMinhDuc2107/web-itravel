<section class="hotel">
   <div class="container">
      <div class="hotel__container">
         <div class="hotel__sidebar">
            <h3 class="hotel__sidebar--title">Bộ lọc</h3>
            <div class="hotel__sidebar--list">
               <div class="hotel__sidebar--item">
                  <h5 class="item__title">
                     Giá mỗi đêm
                  </h5>
                  <div class="filter__list">
                     <div class="filter__item">
                        <input type="checkbox" id="price1">
                        <label for="price1">Dưới 5 triệu</label>
                     </div>
                     <div class="filter__item">
                        <input type="checkbox" id="price2">
                        <label for="price2">Từ 5 - 10 triệu </label>
                     </div>
                     <div class="filter__item">
                        <input type="checkbox" id="price3">
                        <label for="price3">Từ 10 - 20 triệu </label>
                     </div>
                     <div class="filter__item">
                        <input type="checkbox" id="price4">
                        <label for="price4">Trên 20 triệu </label>
                     </div>
                  </div>
               </div>
               <div class="hotel__sidebar--item">
                  <h5 class="item__title">
                     Loại khách sạn
                  </h5>
                  <div class="filter__list">
                     <div class="filter__item">
                        <input type="checkbox" id="1">
                        <label for="1">Khách sạn</label>
                     </div>
                     <div class="filter__item">
                        <input type="checkbox" id="2">
                        <label for="2">Khách sạn căn hộ </label>
                     </div>
                     <div class="filter__item">
                        <input type="checkbox" id="3">
                        <label for="3">Khu nghỉ dưỡng </label>
                     </div>
                     <div class="filter__item">
                        <input type="checkbox" id="4">
                        <label for="4">Căn hộ cao cấp</label>
                     </div>
                  </div>
               </div>
               <div class="hotel__sidebar--item">
                  <h5 class="item__title">
                     Đánh giá của khách hàng
                  </h5>
                  <div class="filter__list">
                     <div class="filter__item">
                        <input type="checkbox" id="01">
                        <label for="01">Tuyệt vời(9.0+)</label>
                     </div>
                     <div class="filter__item">
                        <input type="checkbox" id="02">
                        <label for="02">Rất tốt(8.0+)</label>
                     </div>
                     <div class="filter__item">
                        <input type="checkbox" id="03">
                        <label for="03">Tốt(7.0+) </label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="hotel__right">
            <div class="hotel__sortbar">
               <span>Sắp xếp:</span>
               <ul class="hotel__sortbar--list">
                  <li class="hotel__sortbar--item hotel__sortbar--active">
                     Mặc định
                  </li>
                  <li class="hotel__sortbar--item">
                     Rẻ nhất
                  </li>
                  <li class="hotel__sortbar--item">
                     Đắt nhất
                  </li>
                  <li class="hotel__sortbar--item">
                     Hạng sao
                  </li>
                  <li class="hotel__sortbar--item">
                     Đánh giá
                  </li>
               </ul>
            </div>
            <div class="hotel__list">
               <?php $hotels = $data['hotels'] ?? []?>
               <?php if(!empty($hotels)): ?>
                  <?php foreach($hotels as $hotel):?>
                     <div class="hotel__item">
                  <section class="hotel__item--img swiper">
                     <div class="swiper-button-prev"></div>
                     <ul class="hotel__img--list swiper-wrapper">
                        <?php $images = $hotel['images'] ?? []?>
                        <?php if(!empty($images)): ?>
                           <?php foreach($images as $image):?>
                              <li class="hotel__img--item swiper-slide">
                                 <img
                                    src="<?php echo _WEB_ROOT.$image['image'] ?>"
                                    alt="">
                              </li>
                           <?php endforeach;?>
                        <?php endif; ?>
                     </ul>
                     <div class="swiper-pagination"></div>
                     <div class="swiper-button-next"></div>
                  </section>
                  <div class="hotel__item--info">
                     <div class="info__name">
                        <a href="<?php echo _WEB_ROOT.'/khach-san/'.$hotel['slug']?>"><?php echo $hotel['name']?></a>
                        <div class="info__rating">
                           <?php for($i = 0; $i < $hotel['rating']; $i++):?>
                              <i class="fa fa-star"></i>
                           <?php endfor;?>
                        </div>
                     </div>
                     <div class="info__category">
                        <i class="fa-solid fa-hotel"></i>
                        <span><?php echo $hotel['hotel_type_name']?></span>
                     </div>
                     <div class="info__review">
                        <span class="info__review--number">8.9</span>
                        <span class="info__review--text">Rất tốt</span>
                        <span class="info__review--quantity">(50 đánh giá)</span>
                     </div>
                     <div class="info__location">
                        <svg fill="#333" height="20px" width="20px" version="1.1" id="Capa_1"
                           xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                           viewBox="0 0 297 297" xml:space="preserve" stroke="#333">
                           <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                           <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                           <g id="SVGRepo_iconCarrier">
                              <g>
                                 <path
                                    d="M148.5,0C87.43,0,37.747,49.703,37.747,110.797c0,91.026,99.729,179.905,103.976,183.645 c1.936,1.705,4.356,2.559,6.777,2.559c2.421,0,4.841-0.853,6.778-2.559c4.245-3.739,103.975-92.618,103.975-183.645 C259.253,49.703,209.57,0,148.5,0z M148.5,272.689c-22.049-21.366-90.243-93.029-90.243-161.892 c0-49.784,40.483-90.287,90.243-90.287s90.243,40.503,90.243,90.287C238.743,179.659,170.549,251.322,148.5,272.689z">
                                 </path>
                                 <path
                                    d="M148.5,59.183c-28.273,0-51.274,23.154-51.274,51.614c0,28.461,23.001,51.614,51.274,51.614 c28.273,0,51.274-23.153,51.274-51.614C199.774,82.337,176.773,59.183,148.5,59.183z M148.5,141.901 c-16.964,0-30.765-13.953-30.765-31.104c0-17.15,13.801-31.104,30.765-31.104c16.964,0,30.765,13.953,30.765,31.104 C179.265,127.948,165.464,141.901,148.5,141.901z">
                                 </path>
                              </g>
                           </g>
                        </svg>
                        <span><?php echo $hotel['address'].", ".$hotel['city']?></span>
                        <span class="info__location--link dialog__btn" data-type="map" data-id = "<?php echo $hotel['id']?>">Xem bản đồ</span>
                        <?php 
                        $adrress = $hotel["name"].', '.$hotel['address'].", ".$hotel['city'].", ".$hotel["country"];
                        $stringAdress = Util::processSearchStringMap($adrress);
                        ?>
                        <div class="dialog" data-type ="map" data-id = "<?php echo $hotel['id']?>">
                           <div id="map" class="dialog__content">
                              <iframe width="100%" height="100%" style="border-radius:16px" loading="lazy" allowfullscreen
                                 referrerpolicy="no-referrer-when-downgrade"
                                 src="https://www.google.com/maps?q=<?php echo $stringAdress?>&output=embed">
                              </iframe>
                              <i class="fa fa-close dialog__close"></i>

                           </div>
                        </div>
                     </div>
                     <div class="info__service">
                        <ul class="info__service--list">
                           <?php $amenities = $hotel['amenities'] ?? []?>
                           <?php if(!empty($amenities)) :?>
                              <?php foreach($amenities as $key =>$amenity):?>
                                 <?php 
                                 if($key > 2) {
                                       break;
                                    }
                                 ?>
                                 <li class="info__service--item">
                                    <?php echo $amenity['name']?>
                                 </li>
                              <?php endforeach;?>
                           <?php endif;?>
                        </ul>
                        <span class="info__service--item info__service--more">
                           <?php echo (count($amenities) - 3)?>
                           <div class="more__wrap">
                              <h6>Dịch vụ: </h6>
                              <ul class="more__list">
                              <?php if(!empty($amenities)) :?>
                                 <?php foreach($amenities as $key =>$amenity):?>
                                    <li class="more__item">
                                       <i class="fa fa-check"></i>
                                       <?php echo $amenity['name']?>
                                    </li>
                                 <?php endforeach;?>
                              <?php endif;?>
                                 
                              </ul>
                           </div>
                        </span>
                     </div>
                     <div class="info__bottom">
                        <div class="info__policy">
                           <ul class="info__policy--list">
                              <li class="info__policy--item">
                                 <i class="fa fa-check"></i>
                                 Miễn phí huỷ phòng
                              </li>
                              <li class="info__policy--item">
                                 <i class="fa fa-check"></i>
                                 Không thanh toán ngay
                              </li>
                              <li class="info__policy--item">
                                 <i class="fa fa-check"></i>
                                 Giá đã bao gồm bữa sáng
                              </li>
                           </ul>
                        </div>
                        <div class="info__price">
                           <div class="info__price--sale">
                              -8%
                           </div>
                           <div class="info__price--number">
                              <span class="info__price--old">1.000.000đ</span>
                              <span class="info__price--new"><?php echo $hotel["price_range"]?></span>
                           </div>
                           <div class="info__price--tax">
                              Giá chưa bao gồm thuế và phí
                           </div>
                           <a href="<?php echo _WEB_ROOT.'/khach-san/'.$hotel['slug']?>" class="info__btn btn">
                              Xem phòng
                              <i class="fa fa-angle-right"></i>
                           </a>
                        </div>
                     </div>
                     </div>
                  </div>
                  <?php endforeach;?>
               <?php endif;?>
            </div>
         </div>
      </div>
   </div>
</section>

<script type="text/javascript">
   document.addEventListener("DOMContentLoaded", () => {
      const hotelSortBarList = document.querySelector('.hotel__sortbar--list')
      const hotelSortBarItems = document.querySelectorAll(".hotel__sortbar--item")
      hotelSortBarList.addEventListener("click", (e) => {
         if (e.target.classList.contains("hotel__sortbar--item")) {
            hotelSortBarItems.forEach((item) => item.classList.remove("hotel__sortbar--active"))
            e.target.classList.add("hotel__sortbar--active")
         }
      })
   })
</script>

<script type="text/javascript">
   const swiper = new Swiper('.hotel__item--img', {
      loop: true,
      navigation: {
         nextEl: '.swiper-button-next',
         prevEl: '.swiper-button-prev',
      },
      autoplay: {
         delay: 3000,
      },
      pagination: {
         el: '.swiper-pagination',
         clickable: true,
      },
      effect: "slider",
   });
</script>