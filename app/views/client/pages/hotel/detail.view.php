<!-- detail hotel -->
 <?php 
         $reviewAvgRating = $data['reviewAverageRatings'][0]??[];
         $avgTotal = 0;
         foreach($reviewAvgRating as $rating) {
            $avgTotal += $rating;
         }
         $avgTotal = round($avgTotal / 5,1);
         
         ?>
<?php $hotel = $data['hotel'] ?? []?>
<section class="hotelDetail">
   <div class="container">
      <div class="hotelDetail__container">
         <div class="hotelDetail__info">
            <div class="hotelDetail__info--right">
               <div class="hotelDetail__title"><?php echo $hotel['name']?></div>
               <div class="hotelDetail__rating">
                  <?php for($i = 0; $i < $hotel['rating'];$i++):?>
                     <i class="fa fa-star"></i>
                  <?php endfor;?>
               </div>
               <div class="hotelDetail__review">
                  <span class="hotelDetail__review--number">
                     <svg fill="#23bda4" width="20px" height="20px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g data-name="37 rating" id="_37_rating"> <path d="M42.83,3.5H21.17a6,6,0,0,0-6,6V28.66a6,6,0,0,0,6,6H23.4l7.84,9.23a1,1,0,0,0,1.1.29.992.992,0,0,0,.66-.94V34.66h9.83a6,6,0,0,0,6-6V9.5A6,6,0,0,0,42.83,3.5Zm4,25.16a4,4,0,0,1-4,4H32a1,1,0,0,0-1,1v6.86l-6.38-7.51a1.011,1.011,0,0,0-.76-.35H21.17a4,4,0,0,1-4-4V9.5a4,4,0,0,1,4-4H42.83a4,4,0,0,1,4,4Z"></path> <path d="M44.66,10.75a1,1,0,0,1-1,1H20.34a1,1,0,0,1,0-2H43.66A1,1,0,0,1,44.66,10.75Z"></path> <path d="M44.66,14.92a1,1,0,0,1-1,1H20.34a1,1,0,0,1,0-2H43.66A.99.99,0,0,1,44.66,14.92Z"></path> <path d="M44.66,19.08a1,1,0,0,1-1,1H20.34a1,1,0,0,1,0-2H43.66A1,1,0,0,1,44.66,19.08Z"></path> <path d="M44.66,23.25a1,1,0,0,1-1,1H28.67a1,1,0,0,1,0-2H43.66A.99.99,0,0,1,44.66,23.25Z"></path> <path d="M44.66,27.41a1,1,0,0,1-1,1H28.67a1,1,0,0,1,0-2H43.66A1,1,0,0,1,44.66,27.41Z"></path> <path d="M18.65,46.55a1.009,1.009,0,0,0-.95-.69H13.57l-1.28-3.93a1,1,0,0,0-1.9,0L9.11,45.86H4.98a1,1,0,0,0-.59,1.81L7.73,50.1,6.46,54.02a1,1,0,0,0,.95,1.31A1.01,1.01,0,0,0,8,55.14l3.34-2.43,3.34,2.43a1,1,0,0,0,1.54-1.11L14.94,50.1l3.35-2.43A1.012,1.012,0,0,0,18.65,46.55Zm-5.83,3.47.55,1.7-1.44-1.05a.99.99,0,0,0-1.18,0L9.31,51.72l.55-1.7a.992.992,0,0,0-.36-1.11L8.06,47.86H9.84a1.009,1.009,0,0,0,.95-.69l.55-1.7.55,1.7a1,1,0,0,0,.95.69h1.78l-1.44,1.05A.977.977,0,0,0,12.82,50.02Z"></path> <path d="M39.31,51.71a1,1,0,0,0-.95-.69H34.23l-1.28-3.93a1,1,0,0,0-1.9,0l-1.28,3.93H25.64a1,1,0,0,0-.59,1.81l3.35,2.43-1.28,3.93a1.012,1.012,0,0,0,.36,1.12,1.022,1.022,0,0,0,1.18,0L32,57.88l3.34,2.43a1.011,1.011,0,0,0,1.18,0,1.012,1.012,0,0,0,.36-1.12L35.6,55.26l3.35-2.43A1,1,0,0,0,39.31,51.71Zm-5.83,3.48.55,1.69-1.44-1.05a1.011,1.011,0,0,0-1.18,0l-1.44,1.05.55-1.69a.992.992,0,0,0-.36-1.12l-1.44-1.05H30.5a1,1,0,0,0,.95-.69L32,50.64l.55,1.69a1,1,0,0,0,.95.69h1.78l-1.44,1.05A.992.992,0,0,0,33.48,55.19Z"></path> <path d="M59.97,46.55a.991.991,0,0,0-.95-.69H54.89l-1.28-3.93a1,1,0,0,0-1.9,0l-1.28,3.93H46.3a1,1,0,0,0-.59,1.81l3.35,2.43-1.28,3.93a1,1,0,0,0,1.54,1.11l3.34-2.43L56,55.14a1.01,1.01,0,0,0,.59.19.967.967,0,0,0,.59-.19.987.987,0,0,0,.36-1.12L56.27,50.1l3.34-2.43A1,1,0,0,0,59.97,46.55Zm-5.83,3.47.55,1.7-1.44-1.05a.988.988,0,0,0-.59-.19,1.01,1.01,0,0,0-.59.19l-1.44,1.05.55-1.7a.977.977,0,0,0-.36-1.11l-1.44-1.05h1.78a1,1,0,0,0,.95-.69l.55-1.7.55,1.7a1.009,1.009,0,0,0,.95.69h1.78L54.5,48.91A.992.992,0,0,0,54.14,50.02Z"></path> </g> </g></svg><?php echo $avgTotal?></span>
                  <span>Tuyệt vời</span>
                  <span class="hotelDetail__review--text"> (123 đánh giá)</span>
                  <span class="hotelDetail--btn dialog__btn" data-type ="review" data-id="1">Xem đánh giá</span>
               </div>
               <?php $address = $hotel["address"].', '.$hotel['city'].', '.$hotel['country']?>
               <div class="hotelDetail__location">
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
                  <span><?php echo $address?>
                  </span>
                  <span class="hotelDetail--btn dialog__btn" data-type ="map" data-id ="1">Xem bản đồ</span>
               </div>
            </div>
            <div class="hotelDetail__info--left">
               <div class="hotelDetail__price">
                  <div class="hotelDetail__price--wrap">
                     <span class="hotelDetail__price--text">Giá/phòng/đêm từ
                     </span>
                     <span class="hotelDetail__price--number"><?= number_format($hotel['price'],0, "",".")?>đ</span>
                  </div>
                  <a href="https:\\m.me/539690369869651" class="hotelDetail__price--btn" target="_blank">Liên hệ đặt phòng</a>
               </div>
            </div>
         </div>
         <div class="hotelDetail__images">
            <?php foreach($hotel['images'] as $index => $image):?>
               <div class="hotelDetail__images--item <?php echo  $index === 0 ? "item-large" :""?> dialog__btn" data-type="image" data-id="1">
                  <img src="<?php echo _WEB_ROOT.$image['image']?>" alt="<?php echo $hotel['name']?>" class="">
                  <?php if($index === count($hotel['images']) - 1):?>
                     <div class="overplay image-overpay">
                        <i class="fa-solid fa-images"></i>
                        <div class="overplay__text ">Xem tất cả ảnh</div>
                     </div>
                  <?php endif?>
               </div>
            <?php endforeach?>
         </div>
         <div class="section__info">
            <div class="section__info--left">
               <h4 class="section__info--title">
                  Mô tả khách sạn
               </h4>
               <div class="section__info--desc">
                  <?= $hotel['description']?>
               </div>
               <button class="btn btn-1 dialog__btn" data-type="content_more" data-id="1">Xem thêm</button>
            </div>
            <div class="section__info--right">
               <div class="section__info--review">
                  <div>
                     <div class="review__number"><?php echo $avgTotal?><span>/10</span></div>   
                     <span class="review__number--text">
                        Rất tốt
                     </span>
                  </div>
                  <div class="swiper review__comment--list">
                     <div class="swiper-wrapper">
                        <?php if(isset($data['reviewData']) && !empty($data['reviewData'])):?>
                           <?php foreach($data['reviewData'] as $review):?>
                              <div class="swiper-slide review__comment--item"><?php echo $review['review_text']?></div>
                           <?php endforeach?>
                        <?php endif?>
                     </div>
                     <div class="swiper-button-next"></div>
                     <div class="swiper-button-prev"></div>
                  </div>
                  <div class="hotelDetail--btn dialog__btn" data-type="review" data-id="1">Xem tất cả đánh giá</div>
                  
               </div>
               <div class="section__info--amenity">
                  <div class="amenity__head">
                     <h4 class="section__info--title">Tiện ích chính</h4>
                     <div class="hotelDetail--btn dialog__btn" data-type="amenity" data-id="1">Xem tất cả</div>
                  </div>
                  <div class="amenity__list">
                     <?php $amenityCategories = $data['amenityCategories'] ?? [];
                     ?>

                     <?php if(!empty($amenityCategories)):?>
                        <?php foreach($amenityCategories as $amenityCategory):?>
                           <div class="amenity__item">
                              <img src="<?php echo _WEB_ROOT.$amenityCategory['image']?>" alt=" <?php echo $amenityCategory['name']?>">
                              <?php echo $amenityCategory['name']?>
                           </div>
                           <?php endforeach?>
                     <?php endif?>
                  </div>
               </div>
            </div>
         </div>
         <div class="review">
            <h4 class="review__title">
               Đánh giá của khách hàng
            </h4>
            
            <div class="review__wrap">
               <div class="review__score">
               <svg width="200" height="200"
               viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                     <circle
                        cx="100"
                        cy="100"
                        r="70"
                        stroke-width="10"
                        fill="transparent"
                        stroke="#e0e0e0" 
                     />
                     <circle
                        class="review__circle_progress"
                        cx="100"
                        cy="100"
                        r="70"
                        stroke-width="10"
                        fill="transparent"
                        stroke="#23bda4" 
                        stroke-linecap="round"
                        stroke-dasharray="439.82" 
                        stroke-dashoffset="<?php echo 439.82 * (1 - $avgTotal / 10) ?>" 
                        style="transform: rotate(-90deg); transform-origin: center;"
                     />

                     <text
                        x="100"
                        y="90"
                        style="font-size: 40px; font-weight: bold;"
                        fill="#23bda4" 
                        text-anchor="middle"
                        dominant-baseline="central"
                     >
                        <?php echo $avgTotal?>
                     </text>

                     <text
                        x="100"
                        y="120"
                        style="font-size:16px;"
                        fill="#333" 
                        text-anchor="middle"
                        dominant-baseline="central"
                     >
                        <?php echo Util::classifyScore($avgTotal)?>
                     </text>
                  </svg>
            </div>
            <section class="review__score--detail">
               <div class="item">
                     <span class="item__label">Vị trí</span>
                     <div class="process">
                        <div class="process__bar" style="width:<?php echo number_format($reviewAvgRating['avg_location_rating'], 1)/10 * 100  ?>%">
                        </div>
                     </div>
                     <span class="item__score"><?php echo number_format($reviewAvgRating['avg_location_rating'], 1)  ?></span>
               </div>
               <div class="item">
                     <span class="item__label">Giá cả</span>
                     <div class="process">
                        <div class="process__bar" style="width:<?php echo number_format($reviewAvgRating['avg_price_rating'], 1)/10 * 100  ?>%">
                        </div>
                     </div>
                     <span class="item__score"><?php echo number_format($reviewAvgRating['avg_price_rating'], 1)  ?></span>
               </div>
               <div class="item">
                     <span class="item__label">Phục vụ</span>
                     <div class="process">
                        <div class="process__bar" style="width:<?php echo number_format($reviewAvgRating['avg_service_rating'], 1)/10 * 100  ?>%">
                        </div>
                     </div>
                     <span class="item__score"><?php echo number_format($reviewAvgRating['avg_service_rating'], 1)?></span>
               </div>
               <div class="item">
                     <span class="item__label">Vệ sinh</span>
                     <div class="process">
                        <div class="process__bar" style="width:<?php echo number_format($reviewAvgRating['avg_cleanliness_rating'], 1)/10 * 100  ?>%">
                        </div>
                     </div>
                     <span class="item__score"><?php echo round($reviewAvgRating['avg_cleanliness_rating'], 1)?></span>
               </div>
               <div class="item">
                     <span class="item__label">Tiện nghi</span>
                     <div class="process">
                        <div class="process__bar" style="width:<?php echo round($reviewAvgRating['avg_amenities_rating'], 1)/10 * 100  ?>%">
                        </div>
                     </div>
                     <span class="item__score"><?php echo round($reviewAvgRating['avg_amenities_rating'], 1)?></span>
               </div>
            </section>
            </div>
            <div class="review__btn dialog__btn" data-id="1" data-type="createdReview">
               <button  class="btn">Đánh giá khách sạn</button>
            </div>
            <div class="review__header">
               <div class="review__tag--list">
                  <div class="review__tag--item review__tag--active" data-type="tag" data-value="default">
                     Tất cả
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Công tác">
                     Công tác
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Gia đình">
                     Gia đình
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Một mình">
                     Một mình
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Vợ chồng">
                     Vợ chồng 
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Bạn bè">
                     Bạn bè 
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Khác">
                     Khác 
                  </div>
               </div>
               <div class="review__search">
                  <span>Phân loại: </span>
                  
                  <div class="review__search--text" > 
                     Mặc định
                  </div>
                  <div class="review__search--list">
                     <div class="review__search--item" data-sortOrder="default" data-sortBy="default">
                        Mặc định
                     </div>
                     <div class="review__search--item" data-sortOrder="desc"  data-sortBy="review_date">
                        Mới nhất
                     </div>
                     <div class="review__search--item" data-sortOrder="asc"  data-sortBy="review_date">
                        Cũ nhất
                     </div>
                     <div class="review__search--item" data-sortOrder="desc"  data-sortBy="overall_rating">
                        Đánh giá cao nhất
                     </div>
                     <div class="review__search--item" data-sortOrder="asc"  data-sortBy="overall_rating">
                        Đánh giá thấp nhất
                     </div>
                  </div>
               </div>
            </div>
            <div class="review__list">
               <?php if(isset($data['reviewData']) && !empty($data['reviewData'])):?>
               <?php foreach($data['reviewData'] as $review):?>
                  <div class="review__item">
                     <div class="review__item--left">
                        <div class="review__item--avatar"><?php echo Util::getNameInitials($review['user_name'])?></div>
                        <div class="review__item--info">
                           <div class="review__item--name"><?php echo $review['user_name']?></div>
                           <div class="review__item--row">
                           <svg width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="icomoon-ignore"> </g> <path d="M3.205 3.205v25.59h25.59v-25.59h-25.59zM27.729 4.271v4.798h-23.457v-4.798h23.457zM4.271 27.729v-17.593h23.457v17.593h-23.457z" fill="#5c5c5c"> </path> <path d="M11.201 5.871h1.6v1.599h-1.6v-1.599z" fill="#5c5c5c"> </path> <path d="M19.199 5.871h1.599v1.599h-1.599v-1.599z" fill="#5c5c5c"> </path> <path d="M12.348 13.929c-0.191 1.297-0.808 1.32-2.050 1.365l-0.193 0.007v0.904h2.104v5.914h1.116v-8.361h-0.953l-0.025 0.171z" fill="#5c5c5c"> </path> <path d="M18.642 16.442c-0.496 0-1.005 0.162-1.408 0.433l0.38-1.955h3.515v-1.060h-4.347l-0.848 4.528h0.965l0.059-0.092c0.337-0.525 0.952-0.852 1.606-0.852 1.064 0 1.836 0.787 1.836 1.87 0 0.98-0.615 1.972-1.79 1.972-1.004 0-1.726-0.678-1.756-1.649l-0.006-0.194h-1.115l0.005 0.205c0.036 1.58 1.167 2.641 2.816 2.641 1.662 0 2.963-1.272 2.963-2.895-0-1.766-1.154-2.953-2.872-2.953z" fill="#5c5c5c"> </path> </g></svg>
                           <span><?php echo $review['nights_stayed'] ."đêm, ". Util::formatDate($review['departure_date'])?></span>
                        </div>
                        <div class="review__item--row">
                           <svg fill="#000000" height="20px" width="20px" viewBox="0 0 100 100" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="backpack"></g> <g id="camping"></g> <g id="transportation"></g> <g id="navigation"></g> <g id="hotel"></g> <g id="money"></g> <g id="signpost"></g> <g id="ticket"></g> <g id="schedule"></g> <g id="beach"></g> <g id="mountain"> <path d="M95.6,31.2L74.3,13.3c-1.2-1-2.7-1.4-4.2-1.2c-1.5,0.2-2.9,1-3.8,2.3l-6.7,9.4l-11.8-10c-1.3-1.1-2.9-1.6-4.5-1.7 c-0.1,0-0.2,0-0.3,0c-1.8,0-3.5,0.6-4.9,1.9L4.3,44.3c0,0,0,0,0,0c0,0-0.1,0.1-0.1,0.1c0,0.1-0.1,0.1-0.1,0.2c0,0,0,0.1,0,0.1 c0,0.1,0,0.2,0,0.2c0,0,0,0,0,0v17v25c0,0.1,0,0.2,0.1,0.3c0,0,0,0.1,0,0.1c0,0.1,0.1,0.2,0.2,0.2c0,0,0,0,0.1,0.1 c0.1,0.1,0.2,0.1,0.3,0.2c0,0,0,0,0,0C4.7,88,4.9,88,5,88h90c0.6,0,1-0.4,1-1V67c0,0,0,0,0,0s0,0,0,0v-5V45V32 C96,31.7,95.9,31.4,95.6,31.2z M45,55c1.6,0,3.1,0.6,4.3,1.8c0.4,0.4,1.1,0.4,1.4,0c1.1-1.2,2.7-1.8,4.3-1.8c1.3,0,2.5,0.4,3.6,1.2 c0.3,0.2,0.6,0.3,1,0.1c0.3-0.1,0.6-0.4,0.6-0.8c0.7-3.8,4-6.6,7.9-6.6c2.5,0,4.9,1.2,6.5,3.3c0.2,0.3,0.5,0.4,0.8,0.4 c0.3,0,0.6-0.2,0.8-0.5c1.3-2,3.5-3.2,5.9-3.2c1.5,0,2.9,0.5,4.1,1.3c0.2,0.2,0.5,0.2,0.8,0.2c0.3,0,0.5-0.2,0.7-0.4 c1.5-2.3,3.9-3.7,6.5-4V61H6V46.1c2.6,0.3,5,1.7,6.5,4c0.1,0.2,0.4,0.4,0.7,0.4c0.3,0,0.5,0,0.8-0.2c1.2-0.9,2.6-1.3,4.1-1.3 c2.4,0,4.6,1.2,5.9,3.2c0.2,0.3,0.5,0.5,0.8,0.5c0.3,0,0.6-0.1,0.8-0.4c1.5-2.1,3.9-3.3,6.5-3.3c3.9,0,7.2,2.8,7.9,6.6 c0.1,0.3,0.3,0.6,0.6,0.8c0.3,0.1,0.7,0.1,1-0.1C42.5,55.4,43.7,55,45,55z M6,63.1c5.1,0.4,26.9,2.5,37.1,8 C21.6,75.7,10,82.4,6,85.1V63.1z M21.8,63H94v3c-19.6,0.1-35.5,1.9-48.2,4.5c-0.1-0.1-0.2-0.2-0.3-0.3C40,66.7,30.3,64.4,21.8,63z M94,32.4v11.6c-2.5,0.2-4.8,1.3-6.6,3l-11.5-9.7c0-0.1,0.1-0.1,0.1-0.2l1-5.9c0.3-3-0.9-5.9-3.3-7.8c-2.2-1.8-3.1-4.5-2.4-7.1 l0.6-2.3c0.5,0.1,0.9,0.4,1.3,0.7L94,32.4z M68,15.5c0.4-0.6,1-1,1.7-1.3l-0.5,1.7c-0.9,3.4,0.3,6.9,3.1,9.1c1.9,1.5,2.8,3.8,2.6,6 l-0.8,4.9L61.2,25L68,15.5z M84.8,47.5C83.9,47.2,83,47,82,47c-2.6,0-5.1,1.1-6.8,3.1c-1.9-2-4.5-3.1-7.2-3.1 c-4.3,0-8.1,2.8-9.5,6.8C57.4,53.3,56.2,53,55,53c-1.8,0-3.6,0.6-5,1.8c-1.2-0.9-2.6-1.5-4-1.7l-2.4-3.2c-2.1-2.8-1.8-6.5,0.7-9 c3.4-3.4,3.6-8.4,0.6-12l-2.2-2.7c-1.7-2.1-2.1-4.7-1.1-7.1l2.2-5c1,0.1,2,0.5,2.8,1.2L84.8,47.5z M39.5,15.4 c0.6-0.5,1.3-0.9,2-1.1l-1.8,3.9c-1.4,3.1-0.8,6.6,1.4,9.2l2.2,2.7c2.3,2.8,2.1,6.7-0.5,9.3c-3.2,3.2-3.6,8-0.9,11.6l1.6,2.1 c-0.7,0.1-1.4,0.4-2,0.7c-1.3-4-5.1-6.8-9.5-6.8c-2.7,0-5.3,1.1-7.2,3.1c-1.7-2-4.1-3.1-6.8-3.1c-1.6,0-3.1,0.4-4.4,1.2 c-1.6-2-3.8-3.4-6.3-3.9L39.5,15.4z M8.3,86c7.9-4.8,34-17.8,85.7-18v18H8.3z"></path> </g> <g id="location"></g> <g id="traveling"></g> <g id="bonfire"></g> <g id="camera"></g> <g id="medicine"></g> <g id="drink"></g> <g id="canned_food"></g> <g id="nature"></g> <g id="map"></g> </g></svg>
                           <span><?php echo $review['trip_type']?></span>
                        </div>
                        </div>
                     </div>
                     <?php $pointer = number_format(
                           ($review['location_rating'] 
                           + $review['price_rating'] 
                           + $review['service_rating'] 
                           + $review['cleanliness_rating'] 
                           + $review['amenities_rating']) / 5,
                           1
                        );
                     ?>
                     <div class="review__item--right">
                        <div class="review__item--header">
                           <div>
                              <div class="review__number"><?php echo $pointer?><span>/10</span></div>   
                              <span class="review__number--text">
                                 <?php echo Util::classifyScore($pointer)?>
                              </span>
                           </div>
                           <div class="review__item--date">
                              <?php echo "Đăng vào ". Util::formatDate($review['review_date'], "H:m, d-m-y")?>
                           </div>
                        </div>
                        <div class="review__item--content">
                           <p><?php echo $review['review_text']?></p>
                        </div>
                        <?php if(!empty($review['images'])):?>
                        <div class="review__item--images">
                           <?php foreach($review['images'] as $image):?>
                              <img src="<?php echo _WEB_ROOT.$image['image']?>" alt="<?php echo $review['user_name']?>">
                           <?php endforeach;?>
                           </div>
                        <?php endif?>
                     </div>
                  </div>
               <?php endforeach?>
               <?php else :?>
               <div class="review__empty">
                  <p>Chưa có đánh giá nào cho khách sạn này</p>
               </div>
               <?php endif?>
            
               </div>
               <div class="pagi review_pagi">
                  <ul class="pagi__list">
                     <?php $totalPages = $data['totalPages'] ?? 1;
                        $page = Request::has("page", "get") ? Request::input("page") : 1;
                        ?>
                     <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                     <li class="pagi__item"><span
                           class="pagi__item--link <?php echo $i === (int)htmlspecialchars($page) ? "active" : "" ?>"
                           data-param="page" data-value="<?php echo $i ?>"><?php echo $i ?></span>
                     </li>
                     <?php endfor; ?>
                  </ul>
               </div>
         </div>
   </div>
   <!-- dialog map -->
   <div class="dialog" data-type ="map" data-id = "1">
      <div id="map" class="dialog__content">
         <iframe width="100%" height="100%" style="border-radius:16px" loading="lazy" allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps?q=<?php echo Util::processSearchStringMap($address)?>&output=embed">
         </iframe>
         <i class="fa fa-close dialog__close"></i>

      </div>
   </div>
   <!-- dialog image -->
   <div class="dialog" data-type="image" data-id="1">
      <div class="dialog__content">
         <h4 class="dialog__title">
            Hình ảnh của khách sạn
         </h4>
         <div class="swiper sliderImage">
            <div class="swiper-wrapper">
               <?php foreach($hotel['images'] as $item):?>
               <div class="swiper-slide">
                  <img src="<?php echo _WEB_ROOT."/".$item['image']?>" alt="<?php echo $hotel['name']?>" />
               </div> 
               <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
         </div>
         <div thumbsSlider="" class="swiper thumbarSilderImage">
            <div class="swiper-wrapper">
               <?php foreach($hotel['images'] as $item):?>
               <div class="swiper-slide">
                  <img src="<?php echo _WEB_ROOT."/".$item['image']?>" alt="<?php echo $hotel['name']?>" />
               </div> 
               <?php endforeach; ?>
            </div>
         </div>
         <i class="fa fa-close dialog__close"></i>
      </div>
   </div>
   <!-- dialog review -->
   <div class="dialog" data-type="image" data-id="1">
      <div class="dialog__content">
         <div class="review">
            <h4 class="review__title">
               Đánh giá của khách hàng
            </h4>
            
            <div class="review__wrap">
               <div class="review__score">
               <svg width="200" height="200"
               viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                     <circle
                        cx="100"
                        cy="100"
                        r="70"
                        stroke-width="10"
                        fill="transparent"
                        stroke="#e0e0e0" 
                     />
                     <circle
                        class="review__circle_progress"
                        cx="100"
                        cy="100"
                        r="70"
                        stroke-width="10"
                        fill="transparent"
                        stroke="#23bda4" 
                        stroke-linecap="round"
                        stroke-dasharray="439.82" 
                        stroke-dashoffset="<?php echo 439.82 * (1 - $avgTotal / 10) ?>" 
                        style="transform: rotate(-90deg); transform-origin: center;"
                     />

                     <text
                        x="100"
                        y="90"
                        style="font-size: 40px; font-weight: bold;"
                        fill="#23bda4" 
                        text-anchor="middle"
                        dominant-baseline="central"
                     >
                        <?php echo $avgTotal?>
                     </text>

                     <text
                        x="100"
                        y="120"
                        style="font-size:16px;"
                        fill="#333" 
                        text-anchor="middle"
                        dominant-baseline="central"
                     >
                        <?php echo Util::classifyScore($avgTotal)?>
                     </text>
                  </svg>
            </div>
            <section class="review__score--detail">
               <div class="item">
                     <span class="item__label">Vị trí</span>
                     <div class="process">
                        <div class="process__bar" style="width:<?php echo number_format($reviewAvgRating['avg_location_rating'], 1)/10 * 100  ?>%">
                        </div>
                     </div>
                     <span class="item__score"><?php echo number_format($reviewAvgRating['avg_location_rating'], 1)  ?></span>
               </div>
               <div class="item">
                     <span class="item__label">Giá cả</span>
                     <div class="process">
                        <div class="process__bar" style="width:<?php echo number_format($reviewAvgRating['avg_price_rating'], 1)/10 * 100  ?>%">
                        </div>
                     </div>
                     <span class="item__score"><?php echo number_format($reviewAvgRating['avg_price_rating'], 1)  ?></span>
               </div>
               <div class="item">
                     <span class="item__label">Phục vụ</span>
                     <div class="process">
                        <div class="process__bar" style="width:<?php echo number_format($reviewAvgRating['avg_service_rating'], 1)/10 * 100  ?>%">
                        </div>
                     </div>
                     <span class="item__score"><?php echo number_format($reviewAvgRating['avg_service_rating'], 1)?></span>
               </div>
               <div class="item">
                     <span class="item__label">Vệ sinh</span>
                     <div class="process">
                        <div class="process__bar" style="width:<?php echo number_format($reviewAvgRating['avg_cleanliness_rating'], 1)/10 * 100  ?>%">
                        </div>
                     </div>
                     <span class="item__score"><?php echo round($reviewAvgRating['avg_cleanliness_rating'], 1)?></span>
               </div>
               <div class="item">
                     <span class="item__label">Tiện nghi</span>
                     <div class="process">
                        <div class="process__bar" style="width:<?php echo round($reviewAvgRating['avg_amenities_rating'], 1)/10 * 100  ?>%">
                        </div>
                     </div>
                     <span class="item__score"><?php echo round($reviewAvgRating['avg_amenities_rating'], 1)?></span>
               </div>
            </section>
            </div>
            <div class="review__btn dialog__btn" data-id="1" data-type="createdReview">
               <button  class="btn">Đánh giá khách sạn</button>
            </div>
            <div class="review__header">
               <div class="review__tag--list">
                  <div class="review__tag--item review__tag--active" data-type="tag" data-value="default">
                     Tất cả
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Công tác">
                     Công tác
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Gia đình">
                     Gia đình
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Một mình">
                     Một mình
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Vợ chồng">
                     Vợ chồng 
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Bạn bè">
                     Bạn bè 
                  </div>
                  <div class="review__tag--item" data-type="tag" data-value="Khác">
                     Khác 
                  </div>
               </div>
               <div class="review__search">
                  <span>Phân loại: </span>
                  
                  <div class="review__search--text" > 
                     Mặc định
                  </div>
                  <div class="review__search--list">
                     <div class="review__search--item" data-sortOrder="default" data-sortBy="default">
                        Mặc định
                     </div>
                     <div class="review__search--item" data-sortOrder="desc"  data-sortBy="review_date">
                        Mới nhất
                     </div>
                     <div class="review__search--item" data-sortOrder="asc"  data-sortBy="review_date">
                        Cũ nhất
                     </div>
                     <div class="review__search--item" data-sortOrder="desc"  data-sortBy="overall_rating">
                        Đánh giá cao nhất
                     </div>
                     <div class="review__search--item" data-sortOrder="asc"  data-sortBy="overall_rating">
                        Đánh giá thấp nhất
                     </div>
                  </div>
               </div>
            </div>
            <div class="review__list">
               <?php if(isset($data['reviewData']) && !empty($data['reviewData'])):?>
               <?php foreach($data['reviewData'] as $review):?>
                  <div class="review__item">
                     <div class="review__item--left">
                        <div class="review__item--avatar"><?php echo Util::getNameInitials($review['user_name'])?></div>
                        <div class="review__item--info">
                           <div class="review__item--name"><?php echo $review['user_name']?></div>
                           <div class="review__item--row">
                           <svg width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="icomoon-ignore"> </g> <path d="M3.205 3.205v25.59h25.59v-25.59h-25.59zM27.729 4.271v4.798h-23.457v-4.798h23.457zM4.271 27.729v-17.593h23.457v17.593h-23.457z" fill="#5c5c5c"> </path> <path d="M11.201 5.871h1.6v1.599h-1.6v-1.599z" fill="#5c5c5c"> </path> <path d="M19.199 5.871h1.599v1.599h-1.599v-1.599z" fill="#5c5c5c"> </path> <path d="M12.348 13.929c-0.191 1.297-0.808 1.32-2.050 1.365l-0.193 0.007v0.904h2.104v5.914h1.116v-8.361h-0.953l-0.025 0.171z" fill="#5c5c5c"> </path> <path d="M18.642 16.442c-0.496 0-1.005 0.162-1.408 0.433l0.38-1.955h3.515v-1.060h-4.347l-0.848 4.528h0.965l0.059-0.092c0.337-0.525 0.952-0.852 1.606-0.852 1.064 0 1.836 0.787 1.836 1.87 0 0.98-0.615 1.972-1.79 1.972-1.004 0-1.726-0.678-1.756-1.649l-0.006-0.194h-1.115l0.005 0.205c0.036 1.58 1.167 2.641 2.816 2.641 1.662 0 2.963-1.272 2.963-2.895-0-1.766-1.154-2.953-2.872-2.953z" fill="#5c5c5c"> </path> </g></svg>
                           <span><?php echo $review['nights_stayed'] ."đêm, ". Util::formatDate($review['departure_date'])?></span>
                        </div>
                        <div class="review__item--row">
                           <svg fill="#000000" height="20px" width="20px" viewBox="0 0 100 100" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="backpack"></g> <g id="camping"></g> <g id="transportation"></g> <g id="navigation"></g> <g id="hotel"></g> <g id="money"></g> <g id="signpost"></g> <g id="ticket"></g> <g id="schedule"></g> <g id="beach"></g> <g id="mountain"> <path d="M95.6,31.2L74.3,13.3c-1.2-1-2.7-1.4-4.2-1.2c-1.5,0.2-2.9,1-3.8,2.3l-6.7,9.4l-11.8-10c-1.3-1.1-2.9-1.6-4.5-1.7 c-0.1,0-0.2,0-0.3,0c-1.8,0-3.5,0.6-4.9,1.9L4.3,44.3c0,0,0,0,0,0c0,0-0.1,0.1-0.1,0.1c0,0.1-0.1,0.1-0.1,0.2c0,0,0,0.1,0,0.1 c0,0.1,0,0.2,0,0.2c0,0,0,0,0,0v17v25c0,0.1,0,0.2,0.1,0.3c0,0,0,0.1,0,0.1c0,0.1,0.1,0.2,0.2,0.2c0,0,0,0,0.1,0.1 c0.1,0.1,0.2,0.1,0.3,0.2c0,0,0,0,0,0C4.7,88,4.9,88,5,88h90c0.6,0,1-0.4,1-1V67c0,0,0,0,0,0s0,0,0,0v-5V45V32 C96,31.7,95.9,31.4,95.6,31.2z M45,55c1.6,0,3.1,0.6,4.3,1.8c0.4,0.4,1.1,0.4,1.4,0c1.1-1.2,2.7-1.8,4.3-1.8c1.3,0,2.5,0.4,3.6,1.2 c0.3,0.2,0.6,0.3,1,0.1c0.3-0.1,0.6-0.4,0.6-0.8c0.7-3.8,4-6.6,7.9-6.6c2.5,0,4.9,1.2,6.5,3.3c0.2,0.3,0.5,0.4,0.8,0.4 c0.3,0,0.6-0.2,0.8-0.5c1.3-2,3.5-3.2,5.9-3.2c1.5,0,2.9,0.5,4.1,1.3c0.2,0.2,0.5,0.2,0.8,0.2c0.3,0,0.5-0.2,0.7-0.4 c1.5-2.3,3.9-3.7,6.5-4V61H6V46.1c2.6,0.3,5,1.7,6.5,4c0.1,0.2,0.4,0.4,0.7,0.4c0.3,0,0.5,0,0.8-0.2c1.2-0.9,2.6-1.3,4.1-1.3 c2.4,0,4.6,1.2,5.9,3.2c0.2,0.3,0.5,0.5,0.8,0.5c0.3,0,0.6-0.1,0.8-0.4c1.5-2.1,3.9-3.3,6.5-3.3c3.9,0,7.2,2.8,7.9,6.6 c0.1,0.3,0.3,0.6,0.6,0.8c0.3,0.1,0.7,0.1,1-0.1C42.5,55.4,43.7,55,45,55z M6,63.1c5.1,0.4,26.9,2.5,37.1,8 C21.6,75.7,10,82.4,6,85.1V63.1z M21.8,63H94v3c-19.6,0.1-35.5,1.9-48.2,4.5c-0.1-0.1-0.2-0.2-0.3-0.3C40,66.7,30.3,64.4,21.8,63z M94,32.4v11.6c-2.5,0.2-4.8,1.3-6.6,3l-11.5-9.7c0-0.1,0.1-0.1,0.1-0.2l1-5.9c0.3-3-0.9-5.9-3.3-7.8c-2.2-1.8-3.1-4.5-2.4-7.1 l0.6-2.3c0.5,0.1,0.9,0.4,1.3,0.7L94,32.4z M68,15.5c0.4-0.6,1-1,1.7-1.3l-0.5,1.7c-0.9,3.4,0.3,6.9,3.1,9.1c1.9,1.5,2.8,3.8,2.6,6 l-0.8,4.9L61.2,25L68,15.5z M84.8,47.5C83.9,47.2,83,47,82,47c-2.6,0-5.1,1.1-6.8,3.1c-1.9-2-4.5-3.1-7.2-3.1 c-4.3,0-8.1,2.8-9.5,6.8C57.4,53.3,56.2,53,55,53c-1.8,0-3.6,0.6-5,1.8c-1.2-0.9-2.6-1.5-4-1.7l-2.4-3.2c-2.1-2.8-1.8-6.5,0.7-9 c3.4-3.4,3.6-8.4,0.6-12l-2.2-2.7c-1.7-2.1-2.1-4.7-1.1-7.1l2.2-5c1,0.1,2,0.5,2.8,1.2L84.8,47.5z M39.5,15.4 c0.6-0.5,1.3-0.9,2-1.1l-1.8,3.9c-1.4,3.1-0.8,6.6,1.4,9.2l2.2,2.7c2.3,2.8,2.1,6.7-0.5,9.3c-3.2,3.2-3.6,8-0.9,11.6l1.6,2.1 c-0.7,0.1-1.4,0.4-2,0.7c-1.3-4-5.1-6.8-9.5-6.8c-2.7,0-5.3,1.1-7.2,3.1c-1.7-2-4.1-3.1-6.8-3.1c-1.6,0-3.1,0.4-4.4,1.2 c-1.6-2-3.8-3.4-6.3-3.9L39.5,15.4z M8.3,86c7.9-4.8,34-17.8,85.7-18v18H8.3z"></path> </g> <g id="location"></g> <g id="traveling"></g> <g id="bonfire"></g> <g id="camera"></g> <g id="medicine"></g> <g id="drink"></g> <g id="canned_food"></g> <g id="nature"></g> <g id="map"></g> </g></svg>
                           <span><?php echo $review['trip_type']?></span>
                        </div>
                        </div>
                     </div>
                     <?php $pointer = number_format(
                           ($review['location_rating'] 
                           + $review['price_rating'] 
                           + $review['service_rating'] 
                           + $review['cleanliness_rating'] 
                           + $review['amenities_rating']) / 5,
                           1
                        );
                     ?>
                     <div class="review__item--right">
                        <div class="review__item--header">
                           <div>
                              <div class="review__number"><?php echo $pointer?><span>/10</span></div>   
                              <span class="review__number--text">
                                 <?php echo Util::classifyScore($pointer)?>
                              </span>
                           </div>
                           <div class="review__item--date">
                              <?php echo "Đăng vào ". Util::formatDate($review['review_date'], "H:m, d-m-y")?>
                           </div>
                        </div>
                        <div class="review__item--content">
                           <p><?php echo $review['review_text']?></p>
                        </div>
                        <?php if(!empty($review['images'])):?>
                        <div class="review__item--images">
                           <?php foreach($review['images'] as $image):?>
                              <img src="<?php echo _WEB_ROOT.$image['image']?>" alt="<?php echo $review['user_name']?>">
                           <?php endforeach;?>
                           </div>
                        <?php endif?>
                     </div>
                  </div>
               <?php endforeach?>
               <?php else :?>
               <div class="review__empty">
                  <p>Chưa có đánh giá nào cho khách sạn này</p>
               </div>
               <?php endif?>
            
               </div>
               <div class="pagi review_pagi">
                  <ul class="pagi__list">
                     <?php $totalPages = $data['totalPages'] ?? 1;
                        $page = Request::has("page", "get") ? Request::input("page") : 1;
                        ?>
                     <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                     <li class="pagi__item"><span
                           class="pagi__item--link <?php echo $i === (int)htmlspecialchars($page) ? "active" : "" ?>"
                           data-param="page" data-value="<?php echo $i ?>"><?php echo $i ?></span>
                     </li>
                     <?php endfor; ?>
                  </ul>
               </div>
         </div>
         <i class="fa fa-close"></i>
      </div>
   </div>
   <?php $hotelAmenities = $data['hotelAmenities'] ?? []?>
   <!-- dialog amenity -->
   <div class="dialog" data-type="amenity" data-id="1">
      <div class="dialog__content">
         <div class="dialog__amenity">
            <h4 class="dialog__title">
               Tiên ích khách sạn
            </h4>
            <?php if( !empty($amenityCategories)):?>
               <?php foreach($amenityCategories as $amenityCategory):?>
                  <div class="dialog__amenity--wrap">
                     <h5 class="dialog__amenity--title">
                        <img src="<?php echo _WEB_ROOT.$amenityCategory['image']?>" alt="icon">
                        <span><?php echo $amenityCategory['name']?></span>
                     </h5>
                     <div class="dialog__amenity--list">
                        <?php if( !empty($hotelAmenities)):?>
                           <?php foreach($hotelAmenities as $hotelAmenity):?>
                              <?php if($amenityCategory['id'] === $hotelAmenity['category_id']):?>
                                 <div class="dialog__amenity--item">
                                    <i class="fa fa-check"></i>
                                    <span><?php echo $hotelAmenity['name']?></span>
                                 </div>
                              <?php endif?>
                           <?php endforeach?>
                        <?php endif?>       
                     </div>
                  </div>
               <?php endforeach?>
            <?php endif?>      
         </div>
         <i class="fa fa-close dialog__close"></i>
      </div>
   </div>
   <!-- dialog createdReview -->
   <div class="dialog" data-type="createdReview" data-id="1">
      <div class="dialog__content">
         <h4 class="dialog__title">Đánh giá khách sạn</h4>
         <form action="" class="review__form"  enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo Session::get("csrf_token")?>">
            <input type="hidden" name="hotelId" value="<?php echo $hotel['id']?>">
            <div class="review__form--field">
               <label for="review__form--text" class="review__form--label">Họ và tên</label>
               <input id="review__form--text" class="review__form--input" name="name"></input>
               <span class="error"></span>
            </div>
            <div class="review__form--field">
               <label for="review__form--text" class="review__form--label">Số điện thoại</label>
               <input id="review__form--text" class="review__form--input" name="phone"></input>
               <span class="error"></span>
            </div>
            <div class="review__form--field">
               <label for="review__form--text" class="review__form--label">Số ngày đi</label>
               <input id="review__form--text" class="review__form--input" name="day"></input>
               <span class="error"></span>
            </div>
            <div class="review__form--field">
               <label for="review__form--text" class="review__form--label">Ngày đi</label>
               <input id="review__form--text" class="review__form--input review__date" name="departure_date" placeholder="Chọn ngày đi"></input>
               <span class="error"></span>
               <script>
                  const datePicker = flatpickr(".review__date", {
                     dateFormat: "d-m-Y",
                     defaultDate: null,
                     minDate: "today",
                     locale: "vn",
                     onChange: function (selectedDates, dateStr, instance) {
                        
                     }
                  });
               </script>
            </div>
            <div class="review__form--field">
               <label for="review__form--text" class="review__form--label">Đi</label>
               <div class="dropdown">
                  <input type="text" name="tripType" class="dropdown_input review__form--input" placeholder="Chọn kiểu du lịch" readonly>
                  <span class="error"></span>

                  <ul class="dropdown_list">
                     <li class="dropdown_item" data-type="tag">Công tác</li>
                     <li class="dropdown_item" data-type="tag">Gia đình</li>
                     <li class="dropdown_item" data-type="tag">Một mình</li>
                     <li class="dropdown_item" data-type="tag">Vợ chồng</li>
                     <li class="dropdown_item" data-type="tag">Bạn bè</li>
                     <li class="dropdown_item" data-type="tag">Khác</li>
                  </ul>
               </div>
            </div>
            <div class="review__form--field review__form__field--full">
               <label for="review__form--text" class="review__form--label">Vị trí</label>
               <div class="progress">
                  <div class="progress__wrap">
                     <div class="progress__track"></div>
                     <div class="progress__bar"></div>
                     <div class="progress__thumb">
                        <input type="text" value="10" class="progress__value" name="location_rating"/>
                     </div>
                  </div>
               </div>
            </div>
            <div class="review__form--field review__form__field--full">
               <label for="review__form--text" class="review__form--label">Giá cả</label>
               <div class="progress">
                  <div class="progress__wrap">
                     <div class="progress__track"></div>
                     <div class="progress__bar"></div>
                     <div class="progress__thumb">
                        <input type="text" value="10" class="progress__value" name="price_rating"/>
                     </div>
                  </div>
               </div>
            </div>
            <div class="review__form--field review__form__field--full">
               <label for="review__form--text" class="review__form--label">Phục vụ</label>
               <div class="progress">
                  <div class="progress__wrap">
                     <div class="progress__track"></div>
                     <div class="progress__bar"></div>
                     <div class="progress__thumb">
                        <input type="text" value="10" class="progress__value" name="service_rating"/>
                     </div>
                  </div>
               </div>
            </div>
            <div class="review__form--field review__form__field--full">
               <label for="review__form--text" class="review__form--label">Vệ sinh</label>
               <div class="progress">
                  <div class="progress__wrap">
                     <div class="progress__track"></div>
                     <div class="progress__bar"></div>
                     <div class="progress__thumb">
                        <input type="text" value="10" class="progress__value" name="cleanliness_rating"/>
                     </div>
                  </div>
               </div>
            </div>
            <div class="review__form--field review__form__field--full">
               <label for="review__form--text" class="review__form--label">Tiện nghi</label>
               <div class="progress">
                  <div class="progress__wrap">
                     <div class="progress__track"></div>
                     <div class="progress__bar"></div>
                     <div class="progress__thumb">
                        <input type="text" value="10" class="progress__value" name="amenity_rating"/>
                     </div>
                  </div>
               </div>
            </div>
            <div class="review__form--field review__form__field--full">
               <label for="review__form--text" class="review__form--label">Nội dung đánh giá</label>
               <textarea id="review__form--text" name="reviewText" class="review__form--input "></textarea>
               <span class="error"></span>
            </div>
            <div class="review__form--field review__form__field--full">
               <label for="review__form--text" class="review__form--label">Thêm ảnh</label>
               <label for="review__image" class="review__form--image">
                  <i class="fa fa-plus"></i>
               </label>
               <input type="file" name="images[]" accept="image/*" id="review__image" multiple hidden>

               <span class="error"></span>
               <div class="review__image--list">
               </div>
            </div>
            <button type="submit" class="btn btn-submit-contact" style="margin:0 auto">Đánh giá</button>
         </form>
         <i class="fa fa-close dialog__close"></i>
      </div>
   </div>
    <!-- dialog amenity -->
   <div class="dialog" data-type="content_more" data-id="1">
      <div class="dialog__content">
         <h4 class="dialog__title">Mô tả khách sạn</h4>
          <?= $hotel['description'] ?>
         <i class="fa fa-close dialog__close"></i>
      </div>
   </div>
</section>

<!-- /detail hotel -->
<!-- slider -->
<script type="text/javascript">
   var thumbSlider = new Swiper(".thumbarSilderImage", {
      spaceBetween: 10,
      slidesPerView: 10,
      freeMode: true,
      loop:true,
      watchSlidesProgress: true,
   });
   var sliderImages = new Swiper(".sliderImage", {
      spaceBetween: 10,
      navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
      },
      pagination: {
         el: ".swiper-pagination",
         type: "fraction",
      },
      thumbs: {
      swiper: thumbSlider,
      },
   });
   const reviewList = new Swiper('.review__comment--list', {
   loop: true,
   autoplay: {
   delay: 3000,
   disableOnInteraction: false
   },
   navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
   },
   speed: 700,
});
</script>
<!-- review -->
<script type="text/javascript">
   let data = {
      hotel_id: <?php echo $hotel['id']?>,
      tag:null,
      sortOrder: null,
      sortBy: null,
      page: null
   }
   
   const getNameInitials = (name) => {
      if (!name) return '';
      const parts = name.split(' ');
      if (parts.length === 0) return '';
      if(parts.length === 1) {
         return parts[0].charAt(0).toUpperCase();
      }
      let fisrt = parts[0].charAt(0).toUpperCase();
      let last = parts[parts.length - 1].charAt(0).toUpperCase();
      return fisrt + last;
   }
   function formatDateToMDY(dateStr) {
      const date = new Date(dateStr);

      const mm = String(date.getMonth() + 1).padStart(2, '0');
      const dd = String(date.getDate()).padStart(2, '0');
      const yyyy = date.getFullYear();

      return `${dd}-${mm}-${yyyy}`;
   }

   function formatDateToFull(dateStr) {
      const date = new Date(dateStr);

      if (isNaN(date.getTime())) {
         console.error("Invalid date string provided for full format:", dateStr);
         return "Invalid Date";
      }

      const hh = String(date.getHours()).padStart(2, '0');
      const min = String(date.getMinutes()).padStart(2, '0');

      const mm = String(date.getMonth() + 1).padStart(2, '0');
      const dd = String(date.getDate()).padStart(2, '0');
      const yyyy = date.getFullYear();

      return `${hh}:${min}, ${dd}-${mm}-${yyyy}`;
   }

   const fetchReview = () => {
   const url = new URL(window.location.href);
      let requestData = data
      // clear data 
      Object.keys(requestData).forEach((key) => {
         let value = requestData[key];
         if (value === "default" || value === "" || value === null || value === undefined) {
            delete requestData[key];
         }
      })
      $(".loader").css("display", "flex");
      $(".review_pagi .pagi__list").html("");
      $(".review__list").html("");

      $.ajax({
         url: '<?php echo _WEB_ROOT?>/khach-san/danh-gia',
         type: 'GET',
         data: requestData,
         success: function (res) {
            let data = JSON.parse(res);
            if(data['data'].length === 0) {
               $(".review__list").html("Không có đánh giá nào")
            }
            $(".loader").css("display", "none");
            let reviews  = data['data'].reviews;
            
            const webRoot = "<?php echo _WEB_ROOT; ?>";
            let pages = data['data'].totalPages;
            reviews && reviews.forEach(review => {
               const images = review?.images;
               $(".review__list").append(`
                  <div class="review__item">
                  <div class="review__item--left">
                     <div class="review__item--avatar">${getNameInitials(review.user_name)}</div>
                     <div class="review__item--info">
                        <div class="review__item--name">${review.user_name}</div>
                        <div class="review__item--row">
                        <svg width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="icomoon-ignore"> </g> <path d="M3.205 3.205v25.59h25.59v-25.59h-25.59zM27.729 4.271v4.798h-23.457v-4.798h23.457zM4.271 27.729v-17.593h23.457v17.593h-23.457z" fill="#5c5c5c"> </path> <path d="M11.201 5.871h1.6v1.599h-1.6v-1.599z" fill="#5c5c5c"> </path> <path d="M19.199 5.871h1.599v1.599h-1.599v-1.599z" fill="#5c5c5c"> </path> <path d="M12.348 13.929c-0.191 1.297-0.808 1.32-2.050 1.365l-0.193 0.007v0.904h2.104v5.914h1.116v-8.361h-0.953l-0.025 0.171z" fill="#5c5c5c"> </path> <path d="M18.642 16.442c-0.496 0-1.005 0.162-1.408 0.433l0.38-1.955h3.515v-1.060h-4.347l-0.848 4.528h0.965l0.059-0.092c0.337-0.525 0.952-0.852 1.606-0.852 1.064 0 1.836 0.787 1.836 1.87 0 0.98-0.615 1.972-1.79 1.972-1.004 0-1.726-0.678-1.756-1.649l-0.006-0.194h-1.115l0.005 0.205c0.036 1.58 1.167 2.641 2.816 2.641 1.662 0 2.963-1.272 2.963-2.895-0-1.766-1.154-2.953-2.872-2.953z" fill="#5c5c5c"> </path> </g></svg>
                        <span>${review.nights_stayed+" đêm, " + formatDateToMDY(review.departure_date)}</span>
                     </div>
                     <div class="review__item--row">
                        <svg fill="#000000" height="20px" width="20px" viewBox="0 0 100 100" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="backpack"></g> <g id="camping"></g> <g id="transportation"></g> <g id="navigation"></g> <g id="hotel"></g> <g id="money"></g> <g id="signpost"></g> <g id="ticket"></g> <g id="schedule"></g> <g id="beach"></g> <g id="mountain"> <path d="M95.6,31.2L74.3,13.3c-1.2-1-2.7-1.4-4.2-1.2c-1.5,0.2-2.9,1-3.8,2.3l-6.7,9.4l-11.8-10c-1.3-1.1-2.9-1.6-4.5-1.7 c-0.1,0-0.2,0-0.3,0c-1.8,0-3.5,0.6-4.9,1.9L4.3,44.3c0,0,0,0,0,0c0,0-0.1,0.1-0.1,0.1c0,0.1-0.1,0.1-0.1,0.2c0,0,0,0.1,0,0.1 c0,0.1,0,0.2,0,0.2c0,0,0,0,0,0v17v25c0,0.1,0,0.2,0.1,0.3c0,0,0,0.1,0,0.1c0,0.1,0.1,0.2,0.2,0.2c0,0,0,0,0.1,0.1 c0.1,0.1,0.2,0.1,0.3,0.2c0,0,0,0,0,0C4.7,88,4.9,88,5,88h90c0.6,0,1-0.4,1-1V67c0,0,0,0,0,0s0,0,0,0v-5V45V32 C96,31.7,95.9,31.4,95.6,31.2z M45,55c1.6,0,3.1,0.6,4.3,1.8c0.4,0.4,1.1,0.4,1.4,0c1.1-1.2,2.7-1.8,4.3-1.8c1.3,0,2.5,0.4,3.6,1.2 c0.3,0.2,0.6,0.3,1,0.1c0.3-0.1,0.6-0.4,0.6-0.8c0.7-3.8,4-6.6,7.9-6.6c2.5,0,4.9,1.2,6.5,3.3c0.2,0.3,0.5,0.4,0.8,0.4 c0.3,0,0.6-0.2,0.8-0.5c1.3-2,3.5-3.2,5.9-3.2c1.5,0,2.9,0.5,4.1,1.3c0.2,0.2,0.5,0.2,0.8,0.2c0.3,0,0.5-0.2,0.7-0.4 c1.5-2.3,3.9-3.7,6.5-4V61H6V46.1c2.6,0.3,5,1.7,6.5,4c0.1,0.2,0.4,0.4,0.7,0.4c0.3,0,0.5,0,0.8-0.2c1.2-0.9,2.6-1.3,4.1-1.3 c2.4,0,4.6,1.2,5.9,3.2c0.2,0.3,0.5,0.5,0.8,0.5c0.3,0,0.6-0.1,0.8-0.4c1.5-2.1,3.9-3.3,6.5-3.3c3.9,0,7.2,2.8,7.9,6.6 c0.1,0.3,0.3,0.6,0.6,0.8c0.3,0.1,0.7,0.1,1-0.1C42.5,55.4,43.7,55,45,55z M6,63.1c5.1,0.4,26.9,2.5,37.1,8 C21.6,75.7,10,82.4,6,85.1V63.1z M21.8,63H94v3c-19.6,0.1-35.5,1.9-48.2,4.5c-0.1-0.1-0.2-0.2-0.3-0.3C40,66.7,30.3,64.4,21.8,63z M94,32.4v11.6c-2.5,0.2-4.8,1.3-6.6,3l-11.5-9.7c0-0.1,0.1-0.1,0.1-0.2l1-5.9c0.3-3-0.9-5.9-3.3-7.8c-2.2-1.8-3.1-4.5-2.4-7.1 l0.6-2.3c0.5,0.1,0.9,0.4,1.3,0.7L94,32.4z M68,15.5c0.4-0.6,1-1,1.7-1.3l-0.5,1.7c-0.9,3.4,0.3,6.9,3.1,9.1c1.9,1.5,2.8,3.8,2.6,6 l-0.8,4.9L61.2,25L68,15.5z M84.8,47.5C83.9,47.2,83,47,82,47c-2.6,0-5.1,1.1-6.8,3.1c-1.9-2-4.5-3.1-7.2-3.1 c-4.3,0-8.1,2.8-9.5,6.8C57.4,53.3,56.2,53,55,53c-1.8,0-3.6,0.6-5,1.8c-1.2-0.9-2.6-1.5-4-1.7l-2.4-3.2c-2.1-2.8-1.8-6.5,0.7-9 c3.4-3.4,3.6-8.4,0.6-12l-2.2-2.7c-1.7-2.1-2.1-4.7-1.1-7.1l2.2-5c1,0.1,2,0.5,2.8,1.2L84.8,47.5z M39.5,15.4 c0.6-0.5,1.3-0.9,2-1.1l-1.8,3.9c-1.4,3.1-0.8,6.6,1.4,9.2l2.2,2.7c2.3,2.8,2.1,6.7-0.5,9.3c-3.2,3.2-3.6,8-0.9,11.6l1.6,2.1 c-0.7,0.1-1.4,0.4-2,0.7c-1.3-4-5.1-6.8-9.5-6.8c-2.7,0-5.3,1.1-7.2,3.1c-1.7-2-4.1-3.1-6.8-3.1c-1.6,0-3.1,0.4-4.4,1.2 c-1.6-2-3.8-3.4-6.3-3.9L39.5,15.4z M8.3,86c7.9-4.8,34-17.8,85.7-18v18H8.3z"></path> </g> <g id="location"></g> <g id="traveling"></g> <g id="bonfire"></g> <g id="camera"></g> <g id="medicine"></g> <g id="drink"></g> <g id="canned_food"></g> <g id="nature"></g> <g id="map"></g> </g></svg>
                        <span>${review.trip_type}</span>
                     </div>
                     </div>
                  </div>
                  <div class="review__item--right">
                     <div class="review__item--header">
                        <div>
                           <div class="review__number">${review.overall_rating}<span>/10</span></div>   
                           <span class="review__number--text">
                              ${review.scoreString}
                           </span>
                        </div>
                        <div class="review__item--date">
                           Đăng vào ${formatDateToFull(review.review_date)}
                        </div>
                     </div>
                     <div class="review__item--content">
                        <p>${review.review_text}</p>
                     </div>
                     <div class="review__item--images">
                        ${images && images.length > 0 ? images.map(image => `
                           <img src="${webRoot}${image.image}" alt="${review.user_name}">
                        `).join('') : ''}
                     </div>
                  </div>
               </div>
               `)
               
            })
            if(pages > 1) {
               for(let i = 1; i <= pages; i++) {
                  console.log(i, requestData.page)
                  $(".pagi__list").append(`
                     <li class="pagi__item"><span
                           class="pagi__item--link ${data.page !== null  && i === parseInt(requestData.page) ? 'active' : ''} ${requestData.page === null && i === 1 ? 'active' : ''}"
                           data-param="page" data-value="${i}">${i}</span>
                     </li>
                  `)
               }
            }
            
         },
         error: function (err) {
            console.error('Lỗi:', err);
         }
      });
   }
 // review search

   const reviewSearch = document.querySelectorAll('.review');
   reviewSearch.forEach((parent) => {
      // review tag name
      const reviewTagItems = parent.querySelectorAll('.review__tag--item');
      reviewTagItems.forEach(item => {
         item.addEventListener("click", (e) => {
            reviewTagItems.forEach(item => {
               item.classList.remove('review__tag--active');
            })
            item.classList.add('review__tag--active');
            let value = e.target.dataset.value.trim();
            let param = e.target.dataset.type;
            data[param] = value;
            data['page'] = 1; 

            fetchReview()
         })
      })
      // review sort 
      const searchInput  = parent.querySelector('.review__search--text');
      const searchList = parent.querySelector('.review__search--list');
      const searchItems = parent.querySelectorAll('.review__search--item');
      if(searchInput) {
         searchInput.addEventListener("click", (e) => {
            searchList.classList.toggle('review__search--active');
         })
      }
      if(searchItems) {
         searchItems.forEach(searchItem => {
            searchItem.addEventListener("click", (e) => {
               searchInput.innerHTML = searchItem.innerHTML;
               searchList.classList.remove('review__search--active');
               let valueSortOrder=  e.target.dataset.sortorder;
               let valueSortBy = e.target.dataset.sortby;
               data['sortBy'] = valueSortBy
               data['sortOrder'] = valueSortOrder;
               data['page'] = 1; 
               fetchReview()
            })
         })
      }
   })
   // pagination
   const pagis = document.querySelectorAll('.review_pagi');
   pagis.forEach(pagi => {
      pagi.addEventListener("click", (e) => {
         if(e.target.classList.contains('pagi__item--link')) {
            const pagiItems = pagi.querySelectorAll('.pagi__item--link');
            pagiItems.forEach(item => {
               item.classList.remove('active');
            })
            e.target.classList.add('active');
            let page = e.target.dataset.value;
            data['page'] = page;
            fetchReview();
         }
      })
      
   })
</script>
<!-- progresss  -->
<script type="text/javascript">
   const progress = document.querySelectorAll('.progress__wrap');
   progress.forEach((item) => {
   const thumb = item.querySelector('.progress__thumb');
   const progress = item.querySelector('.progress__bar');
   const valueLabel = item.querySelector('.progress__value');
   const min = 1;
   const max = 10;

   let dragging = false;

   function updatePosition(pageX) {
      const rect = item.getBoundingClientRect();
      let offsetX = pageX - rect.left;

      if (offsetX < 0) offsetX = 0;
      if (offsetX > rect.width) offsetX = rect.width;

      const percent = (offsetX / rect.width) * 100;
      const value = (min + (percent / 100) * (max - min)).toFixed(1);
      thumb.style.left = percent + '%';
      progress.style.width = percent + '%';

      valueLabel.setAttribute("value", value);

      return value;
   }

   thumb.addEventListener('mousedown', () => {
      dragging = true;
   });

   document.addEventListener('mouseup', () => {
      dragging = false;
   });

   document.addEventListener('mousemove', (e) => {
      if (!dragging) return;
      updatePosition(e.pageX);
   });

   item.addEventListener('click', (e) => {
      updatePosition(e.pageX);
   });

   updatePosition(item.getBoundingClientRect().left + item.offsetWidth / 2);
   })

</script>
<!-- display image -->
<script type="text/javascript">
   const inputImage = document.getElementById("review__image")
   const reviewImageList = document.querySelector(".review__image--list");
   inputImage.addEventListener("change" , (e) => {
      const files = e.target.files;
      reviewImageList.innerHTML = "";
      Array.from(files).forEach(file => {
         if(!file.type.startsWith("image/")) {
            alert("Vui lòng chọn đúng định dạng ảnh!");
            return;
         }
         const reader = new FileReader();
         reader.onload = function (e) {
               const img = document.createElement('img');
               img.src = e.target.result;
               reviewImageList.appendChild(img);
         };
         reader.readAsDataURL(file);
      })
   })
</script>
<!-- submit ajax -->
<script type="text/javascript">
   const reviewForm = document.querySelector(".review__form");
   let valid = true;
   // show err
   const showErr = (name, msg) => {
      const input = reviewForm.querySelector(`[name="${name}"]`);
      const spanErr = input?.parentElement.querySelector(".error");
      if (spanErr) {
         spanErr.textContent = msg;
         input.classList.add("input-error");
         
      }
      valid = false;
   }
   // clear error
   const clearErrors = () => {
      reviewForm.querySelectorAll(".error").forEach(span => (span.textContent = ""));
      reviewForm.querySelectorAll(".input-error").forEach(input => input.classList.remove("input-error"));
   };
   // validate image
   const validateImage = (images) => {
      const allowedTypes = <?php echo $_ENV["ALLOWED_TYPES"]; ?>;
      const maxSize = <?php echo $_ENV['MAX_FILE_SIZE']?>;
      let isValid = true;
      let msgs = [];
      if(images[0]['name'] === '') return {isValid, msg: msgs}
      if (images.length === 0) return {isValid, msg: msgs};
      [...images].forEach((image,index) => {
         if(!allowedTypes.includes(image.type.split("/")?.pop())) {
            msgs.push(`Ảnh thứ ${index + 1} có định dạng không hợp lệ: ${image.type}`);
            isValid = false;
         }

         if(image.size > maxSize) {
            msgs.push(`Ảnh thứ ${index + 1} có size không hợp lệ: max size ${maxSize / 1024 / 1024}MB`);
            isValid = false;
         }
      })
      return {
         isValid, msg: msgs.join(", ")
      }
   }
   reviewForm.addEventListener("submit", (e) => {
      e.preventDefault();
      // clear err
      clearErrors();
      // data form
      const formData = new FormData(reviewForm);

      const user_name = formData.get("name")?.trim();
      const phone = formData.get("phone")?.trim();
      const nights_stayed	= formData.get("day")?.trim();
      const trip_type = formData.get("tripType")?.trim();
      const location_rating = parseFloat(formData.get("location_rating"));
      const price_rating = parseFloat(formData.get("price_rating"));
      const service_rating = parseFloat(formData.get("service_rating"));
      const cleanliness_rating = parseFloat(formData.get("cleanliness_rating"));
      const amenities_rating = parseFloat(formData.get("amenity_rating"));
      const review_text = formData.get("reviewText")?.trim();
      const review_images = formData.getAll("images[]");
      const hotel_id = formData.get("hotelId");
      const csrf_token = formData.get("csrf_token");
      
      const departure_date = datePicker.input.value;
      // validate
      const checkImage = validateImage(review_images);
      if(!checkImage.isValid) showErr("images[]", checkImage.msg)
      if (!user_name) showErr("name", "Vui lòng nhập họ và tên");
      if (!phone || !/^\d{9,11}$/.test(phone)) showErr("phone", "Số điện thoại không hợp lệ");
      if (!nights_stayed || isNaN(nights_stayed) || Number(nights_stayed) <= 0) showErr("day", "Số đêm không hợp lệ");
      if (!trip_type) showErr("tripType", "Vui lòng nhập kiểu chuyến đi");
      if (!review_text || review_text.length < 10) showErr("reviewText", "Đánh giá phải có ít nhất 10 ký tự");
      if(!departure_date) showErr("departure_date", "Bạn chưa chọn ngày đi")
      // scroll first error input
      if (!valid) {
         const firstErrorInput = reviewForm.querySelector(".input-error");
         if (firstErrorInput) {
            firstErrorInput.scrollIntoView({
               behavior: "smooth",
               block: "center",
            });
            firstErrorInput.focus();
         }
         return;
      }
      const overall_rating = Math.round((price_rating + location_rating + service_rating + cleanliness_rating + amenities_rating) / 5);
      // created data send
      const sendData = new FormData();
      sendData.append("user_name", user_name);
      sendData.append("phone", phone);
      sendData.append("nights_stayed", nights_stayed);
      sendData.append("trip_type", trip_type);
      sendData.append("location_rating", location_rating);
      sendData.append("price_rating", price_rating);
      sendData.append("service_rating", service_rating);
      sendData.append("cleanliness_rating", cleanliness_rating);
      sendData.append("amenities_rating", amenities_rating);
      sendData.append("review_text", review_text);
      sendData.append("hotel_id", hotel_id);
      sendData.append("csrf_token", csrf_token);
      sendData.append("departure_date", departure_date);
      sendData.append("overall_rating", overall_rating);
      review_images.forEach((file) => {
         sendData.append("review_images[]", file);
      });
      // call ajax
      submitHotelReview(sendData)
   })
   const submitHotelReview = (data) => {
      $.ajax({
         url:"<?php echo _WEB_ROOT?>/khach-san/gui-danh-gia",
         method:"POST",
         data: data,
         contentType: false, 
         processData: false,
         dataType:"json",
         success: function(res) {
            if(res['type'] !== "success") {
               toast("Warning", `Thêm đánh giá không thành công`, "warn");
            }
            toast("Success", `Thêm đánh giá thành công`, "success");
            reviewForm.reset();
            document.querySelector(".dialog__active").classList.remove("dialog__active");
         },
         error: function(xhr, status, error) {
            toast("Danger", `Lỗi khi xử lý thêm đánh giá`, "danger");
         }
      })
   }

</script>
