<div class="booking">
   <div class="container">
      <h3 class="block-title title-center">
         <?php echo $data['heading'] ?? ""?>
      </h3>
      <form class="booking__container" method="post" action="<?php echo _WEB_ROOT.'/checkout'?>">

         <div class="booking__left">
            <div class="booking__content--item">
               <h3 class="booking__title">
               Thông tin liên lạc
               </h3>
               <div class="row">
               <div class="column border-r">
                  <label for="fullName">
                     Họ và tên <span>*</span>
                  </label>
                  <input type="text" id="fullName" name="name" placeholder="Họ và tên">
                   <div class="name-err" style="color: red;font-size: 12px"></div>
               </div>

               <div class="column">
                  <label for="phone">
                     Điện thoại <span>*</span>
                  </label>
                  <input type="text" id="phone" name="phone" placeholder="Số điện thoại">
                   <div class="phone-err" style="color: red;font-size: 12px"></div>
               </div>
               </div>
               <div class="row">
               <div class="column border-r">
                  <label for="email">
                     Email <span>*</span>
                  </label>
                  <input type="text" id="email" name="email" placeholder="Email">
                   <div class="email-err" style="color: red;font-size: 12px"></div>
               </div>
               <div class="column">
                  <label for="address">
                     Địa chỉ <span>*</span>
                  </label>
                  <input type="text" id="address" name="address" placeholder="Nhập địa chỉ">
                   <div class="address-err" style="color: red;font-size: 12px"></div>
               </div>
               </div>
            </div>
            <div class="booking__content--item">
               <h3 class="booking__title">
               Hành khách
               </h3>
               <div class="row ">
               <div class="column border-line user-info">
                  <div class="left ">
                     <p>Người lớn</p>
                     <span>Từ 12 tuổi trở lên</span>
                  </div>
                  <div class="right">
                     <i class="fa fa-minus btn-minus"></i>
                     <input type="text" name="adult"  value="1" class="quantity-user adult" data-price="<?php echo isset($data['priceTour']) && is_array($data['priceTour'])  ? $data['priceTour']['adult_price'] : $data['tour']['adult_price']?>" id="adult">
                     <i class="fa fa-plus btn-plus"></i>
                  </div>
               </div>
               <div class="column border-line user-info">
                  <div class="left ">
                     <p>Trẻ em</p>
                     <span>Từ 2 đến 11</span>
                  </div>
                  <div class="right">
                     <i class="fa fa-minus btn-minus"></i>
                     <input type="text" name="children"  value="0" class="quantity-user" data-price="<?php echo isset($data['priceTour']) && is_array($data['priceTour']) ? $data['priceTour']['child_price'] : $data['tour']['child_price']?>" id="children">
                     <i class="fa fa-plus btn-plus"></i>
                  </div>
               </div>
               <div class="column border-line user-info">
                  <div class="left ">
                     <p>Em bé</p>
                     <span>Dưới 2 tuổi</span>
                  </div>
                  <div class="right">
                     <i class="fa fa-minus btn-minus"></i>
                     <input type="text" name="baby" value="0" class="quantity-user" data-price="<?php echo isset($data['priceTour']) && is_array($data['priceTour']) ? $data['priceTour']['infant_price'] : $data['tour']['infant_price']?>" id="baby">
                     <i class="fa fa-plus btn-plus"></i>
                  </div>
               </div>
               </div>   
               <script>
               let userInfo = document.querySelectorAll(".user-info");
               userInfo.forEach(item => {
                  let iconMinus = item.querySelector(".btn-minus")
                  let iconPlus = item.querySelector(".btn-plus")
                  let input = item.querySelector(".quantity-user")
                  iconMinus.addEventListener("click", function(e) {
                      let quantity = +input.value;
                      if (input.classList.contains("adult") && quantity <= 1 ) {
                          input.value = 1;
                          return
                      }
                      if (quantity <= 0) {
                          return;
                      }
                      quantity -= 1;
                      input.value = quantity;
                      input.dispatchEvent(new Event("input"));
                  })
                  iconPlus.addEventListener("click", function(e) {
                     quantity = +input.value
                     quantity += 1;
                     input.value = quantity;

                     input.dispatchEvent(new Event("input"));
                  })

               })
               </script>
            </div>
            <div class="booking__content--item">
               <h3 class="booking__title">Ghi chú</h3>
               <div class="booking__content---note">
               <textarea name="notes" id="" placeholder="Quý khách có ghi chú lưu ý gì, hãy nói với chúng tôi"></textarea>
               </div>
            </div>
         </div>
         <div class="booking__right">
            <h3 class="booking__title">
               Thông tin tour
            </h3>
            <div class="cart__wrap">
               <div class="cart__head">
               <img src="<?php echo _WEB_ROOT.$data['tour']['image']?>" alt="<?php echo htmlspecialchars($data['tour']['name'])?>">
               <h4 class="cart__name"><?php echo htmlspecialchars($data['tour']['name'])?></h4>
               </div>
               <div class="cart__body">
               <div class="row">
                  <div class="col-50">
                  <svg width="20px" height="20px" viewBox="-4 0 32 32" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#615c5c">
                                               <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                               <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                  stroke-linejoin="round"></g>
                                               <g id="SVGRepo_iconCarrier"><title>location</title>
                                                   <desc>Created with Sketch Beta.</desc>
                                                   <defs></defs>
                                                   <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                      fill-rule="evenodd" sketch:type="MSPage">
                                                       <g id="Icon-Set" sketch:type="MSLayerGroup"
                                                          transform="translate(-104.000000, -411.000000)"
                                                          fill="#000000">
                                                           <path d="M116,426 C114.343,426 113,424.657 113,423 C113,421.343 114.343,420 116,420 C117.657,420 119,421.343 119,423 C119,424.657 117.657,426 116,426 L116,426 Z M116,418 C113.239,418 111,420.238 111,423 C111,425.762 113.239,428 116,428 C118.761,428 121,425.762 121,423 C121,420.238 118.761,418 116,418 L116,418 Z M116,440 C114.337,440.009 106,427.181 106,423 C106,417.478 110.477,413 116,413 C121.523,413 126,417.478 126,423 C126,427.125 117.637,440.009 116,440 L116,440 Z M116,411 C109.373,411 104,416.373 104,423 C104,428.018 114.005,443.011 116,443 C117.964,443.011 128,427.95 128,423 C128,416.373 122.627,411 116,411 L116,411 Z"
                                                                 id="location" sketch:type="MSShapeGroup"></path>
                                                       </g>
                                                   </g>
                                               </g>
                                           </svg>
                     <p>Khởi hành: <span><?php echo htmlspecialchars($data['tour']['departure_name'])?></span></p>
                  </div>
                  <div class="col-50">
                  <svg width="20px" height="20px" viewBox="0 0 32 32" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="#615c5c">
                                               <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                               <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                  stroke-linejoin="round"></g>
                                               <g id="SVGRepo_iconCarrier">
                                                   <g id="icomoon-ignore"></g>
                                                   <path d="M3.205 3.205v25.59h25.59v-25.59h-25.59zM27.729 4.271v4.798h-23.457v-4.798h23.457zM4.271 27.729v-17.593h23.457v17.593h-23.457z"
                                                         fill="#000000"></path>
                                                   <path d="M11.201 5.871h1.6v1.599h-1.6v-1.599z" fill="#000000"></path>
                                                   <path d="M19.199 5.871h1.599v1.599h-1.599v-1.599z"
                                                         fill="#000000"></path>
                                                   <path d="M12.348 13.929c-0.191 1.297-0.808 1.32-2.050 1.365l-0.193 0.007v0.904h2.104v5.914h1.116v-8.361h-0.953l-0.025 0.171z"
                                                         fill="#000000"></path>
                                                   <path d="M18.642 16.442c-0.496 0-1.005 0.162-1.408 0.433l0.38-1.955h3.515v-1.060h-4.347l-0.848 4.528h0.965l0.059-0.092c0.337-0.525 0.952-0.852 1.606-0.852 1.064 0 1.836 0.787 1.836 1.87 0 0.98-0.615 1.972-1.79 1.972-1.004 0-1.726-0.678-1.756-1.649l-0.006-0.194h-1.115l0.005 0.205c0.036 1.58 1.167 2.641 2.816 2.641 1.662 0 2.963-1.272 2.963-2.895-0-1.766-1.154-2.953-2.872-2.953z"
                                                         fill="#000000"></path>
                                               </g>
                                           </svg>
                     <p>Thời gian: <span><?php echo htmlspecialchars(Util::formatDate(Request::input("date",$data['tour']['date'])))?></span></p>
                  </div>
               </div>
               <div class="price__list">
                  <div class="row">
                     <div class="left">
                         <svg height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 489.6 489.6" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path id="XMLID_2038_" style="fill:#94A4A4;" d="M244.72,99.2c0.1,0,0.2,0,0.2,0l0,0c40.4-0.4,34.5-54.4,34.5-54.4 c-1.6-36.1-31.7-35.8-34.7-35.7c-3-0.1-33.1-0.4-34.8,35.6c0,0-5.9,54,34.6,54.4l0,0C244.52,99.2,244.62,99.2,244.72,99.2z"></path> <path id="XMLID_2039_" style="fill:#94A4A4;" d="M244.72,166.3l26.1-36c0,0,18.4,7.4,33.4,18.5c3.9,2.9,5.7,4.6,9.2,8.1 c8.3,8.3,4.8,56.4,0,74s-18.9,42.9-18.9,42.9c-2.8,6.4-4.6,13.3-5.3,20.2l-18,176.5c-0.6,5.6-5.3,9.9-10.9,9.9h-15.6h-15.6 c-5.6,0-10.4-4.3-10.9-9.9l-18-176.5c-0.7-7-2.5-13.8-5.3-20.2c0,0-14.1-25.2-18.9-42.9c-4.8-17.6-8.3-65.7,0-74 c3.5-3.5,5.3-5.2,9.2-8.1c15-11,33.4-18.5,33.4-18.5L244.72,166.3z"></path> <path style="fill:#696969;" d="M41.72,248.8c4.5,16.4,16.5,38.5,18.3,41.9c2.2,5.1,3.6,10.4,4.1,15.9l16.9,165.6 c1,9.9,9.3,17.4,19.3,17.4h29.2c10,0,18.3-7.5,19.3-17.4l16.9-165.6c0.6-5.6,2-11.1,4.3-16.2c2-4.6-0.1-9.9-4.6-11.9 c-4.6-2-9.9,0.1-11.9,4.6c-3,6.9-5,14.2-5.7,21.7l-16.9,165.6c-0.1,0.6-0.6,1.1-1.2,1.1h-29.2c-0.6,0-1.2-0.5-1.2-1.1l-17.1-165.7 c-0.8-7.5-2.7-14.8-5.7-21.7c-0.1-0.3-0.2-0.5-0.4-0.8c-0.1-0.2-12.7-22.9-16.9-38.2c-4.6-17.1-5.9-54.3-2.1-60.9 c3-3,4.3-4.2,7.4-6.5c7.9-5.8,17-10.5,22.9-13.3l20.2,27.8c1.7,2.3,4.4,3.7,7.3,3.7s5.6-1.4,7.3-3.7l24.5-33.7c2.9-4,2-9.7-2-12.7 c-4-2.9-9.7-2-12.7,2l-17.2,23.6l-17-23.5c-2.4-3.4-6.9-4.6-10.7-3.1c-0.7,0.3-18.5,7.5-33.3,18.4c-4.2,3.1-6.2,5-9.7,8.5 C31.32,183.4,38.42,236.6,41.72,248.8z"></path> <path style="fill:#696969;" d="M114.12,131.9c0.2,0,0.4,0,0.6,0c0.1,0,0.3,0,0.4,0c0.2,0,0.4,0,0.7,0c11.6-0.3,21.4-4.5,28.4-12.4 c14.9-16.8,12.8-44.8,12.4-48.3c-1.5-30.9-23-41.8-40.9-41.8c-0.3,0-0.6,0-0.8,0c-0.2,0-0.5,0-0.8,0c-17.9,0-39.3,11-40.9,41.8 c-0.3,3.5-2.5,31.5,12.4,48.3C92.72,127.4,102.52,131.7,114.12,131.9z M91.32,72.8c0-0.2,0-0.4,0-0.6c1-21.6,14.7-24.8,22.8-24.8 h0.4c0.2,0,0.5,0,0.7,0h0.4c8.1,0,21.8,3.2,22.8,24.8c0,0.2,0,0.4,0,0.5c0.7,6.4,0.5,25.1-8,34.7c-3.7,4.2-8.8,6.3-15.5,6.3 c-0.1,0-0.1,0-0.2,0l0,0c-6.7-0.1-11.8-2.1-15.5-6.3C90.82,97.9,90.72,79.2,91.32,72.8z"></path> <path style="fill:#696969;" d="M324.12,278.4c-4.6,2-6.7,7.4-4.6,11.9c2.3,5.2,3.7,10.6,4.3,16.2l16.9,165.6 c1,9.9,9.3,17.4,19.3,17.4h29.2c10,0,18.3-7.5,19.3-17.4l16.9-165.6c0.6-5.5,1.9-10.8,4.1-15.9c1.8-3.3,13.9-25.4,18.3-41.9 c3.3-12.2,10.5-65.4-2.3-78.2c-3.5-3.5-5.5-5.4-9.7-8.5c-14.8-10.9-32.5-18.1-33.3-18.4c-3.9-1.6-8.3-0.3-10.7,3.1l-17.2,23.6 l-17.3-23.5c-2.9-4.1-8.6-4.9-12.7-2c-4,2.9-4.9,8.6-2,12.7l24.5,33.7c1.7,2.3,4.4,3.7,7.3,3.7s5.6-1.4,7.3-3.7l20.2-27.8 c5.9,2.8,15,7.5,22.9,13.3c3,2.2,4.3,3.5,7.4,6.5c3.8,6.6,2.5,43.8-2.1,60.9c-4.2,15.3-16.8,38-16.9,38.2s-0.3,0.5-0.4,0.8 c-3,6.9-5,14.2-5.7,21.7l-16.9,165.6c-0.1,0.6-0.6,1.1-1.2,1.1h-29.2c-0.6,0-1.2-0.5-1.2-1.1l-16.9-165.6 c-0.8-7.5-2.7-14.8-5.7-21.7C334.02,278.4,328.72,276.4,324.12,278.4z"></path> <path style="fill:#696969;" d="M373.62,131.9c0.2,0,0.4,0,0.7,0c0.1,0,0.3,0,0.4,0c0.2,0,0.4,0,0.6,0c11.6-0.2,21.4-4.5,28.5-12.4 c14.9-16.8,12.8-44.8,12.4-48.3c-1.5-30.9-22.9-41.8-40.9-41.8c-0.3,0-0.6,0-0.8,0c-0.2,0-0.5,0-0.8,0c-17.9,0-39.3,11-40.9,41.8 c-0.3,3.5-2.5,31.5,12.4,48.3C352.22,127.4,362.02,131.6,373.62,131.9z M350.82,72.8c0-0.2,0-0.4,0-0.6 c1-21.6,14.7-24.8,22.8-24.8h0.4c0.2,0,0.5,0,0.7,0h0.4c8.1,0,21.8,3.2,22.8,24.8c0,0.2,0,0.4,0,0.5c0.7,6.4,0.5,25.1-8,34.7 c-3.7,4.2-8.8,6.2-15.5,6.3l0,0c-0.1,0-0.1,0-0.2,0c-6.7-0.1-11.8-2.1-15.5-6.3C350.32,97.9,350.22,79.2,350.82,72.8z"></path> <path style="fill:#696969;" d="M169.62,150.5c-13.5,13.5-5.9,69.8-2.3,82.8c4.8,17.5,17.6,41.1,19.5,44.5 c2.4,5.5,3.9,11.2,4.5,17.1l18,176.5c1,10.3,9.6,18,20,18h31.1c10.3,0,18.9-7.8,20-18l18-176.5c0.6-5.9,2.1-11.7,4.5-17.1 c1.9-3.5,14.7-27,19.5-44.5c3.5-13,11.2-69.3-2.3-82.8c-3.7-3.7-5.8-5.7-10.2-9c-15.7-11.6-34.6-19.2-35.4-19.6 c-3.9-1.6-8.3-0.3-10.7,3.1l-19.1,25.9l-18.8-25.9c-2.4-3.4-6.9-4.6-10.7-3.1c-0.8,0.3-19.6,8-35.4,19.6 C175.42,144.8,173.22,146.8,169.62,150.5z M182.62,163.1c3.3-3.3,4.7-4.6,8-7c8.6-6.4,18.6-11.5,25-14.5l21.8,30 c1.7,2.3,4.4,3.7,7.3,3.7c2.9,0,5.6-1.4,7.3-3.7l21.8-30c6.3,3,16.3,8.1,25,14.5c3.3,2.4,4.7,3.7,8,7c4.2,6.8,2.9,46.9-2.2,65.4 c-4.5,16.4-17.9,40.6-18.1,40.8c-0.1,0.2-0.3,0.5-0.4,0.8c-3.2,7.3-5.3,15-6.1,23l-18,176.5c-0.1,1-0.9,1.7-1.9,1.7h-31.1 c-1,0-1.8-0.7-1.9-1.7l-18-176.5c-0.8-7.9-2.8-15.7-6.1-23c-0.1-0.3-0.2-0.5-0.4-0.8c-0.1-0.2-13.6-24.5-18.1-40.9 C179.72,210,178.42,169.9,182.62,163.1z"></path> <path style="fill:#696969;" d="M243.82,108.2c0.2,0,0.5,0,0.7,0c0.1,0,0.4,0,0.5,0c0.2,0,0.4,0,0.6,0c12.4-0.2,22.4-4.6,29.9-13.1 c15.8-17.7,13.4-47.5,13.1-51.1c-1.6-32.5-24.1-44-43-44c-0.3,0-0.6,0-0.9,0c-0.2,0-0.5,0-0.9,0c-18.8,0-41.4,11.5-43,44 c-0.3,3.6-2.7,33.3,13.1,51C221.42,103.5,231.52,107.9,243.82,108.2z M218.92,45.7c0-0.2,0-0.4,0-0.6c1.1-24.4,17.8-27,24.9-27 h0.5c0.2,0,0.5,0,0.7,0h0.5c7.1,0,23.8,2.6,24.9,27c0,0.2,0,0.4,0,0.5c0.7,6.9,0.6,27.1-8.6,37.4c-4.1,4.6-9.7,6.9-17,6.9 c-0.1,0-0.2,0-0.3,0c-7.3-0.1-12.9-2.3-17-6.9C218.32,72.8,218.22,52.6,218.92,45.7z"></path> </g> </g> </g></svg>
                     <h4 class="cart__title">Khách hàng + Phụ thu</h4> 
                     </div>
                     <div class="right">
                     <div class="amount"><span>8.590.000</span>₫</div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="left">
                     <h4>Người lớn</h4> 
                     </div>
                     <div class="right">
                     <div ><span class="quantity-adult">1</span> x <span class="price-adult">8.590.000</span>₫</div>
                     </div>
                  </div>
                  <div class="row">
                  <div class="left">
                     <h4>Trẻ em</h4> 
                  </div>
                  <div class="right">
                     <div ><span class="quantity-children">0</span> x <span class="price-children">0</span>₫</div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="left">
                     <h4>Em bé</h4> 
                  </div>
                  <div class="right">
                     <div ><span class="quantity-baby">0</span> x <span class="price-baby">0</span>₫</div>
                  </div>
                  </div>
                  <div class="row">
                     <div class="left">
                     <h4 >Phụ thu phòng đơn</h4> 
                     </div>
                     <div class="right">
                     <div><span>0₫</span></div>
                     </div>
                  </div>
               </div>
               </div>
               <div class="cart__footer">
               <div class="row cart__footer--price">
                  <div class="left">
                     Tổng tiền
                  </div>
                  <div class="right">
                     <span class="total-cart">8.590.000</span> ₫
                      <input type="hidden" name="totalPrice" id="totalPrice" value="0">
                  </div>
               </div>
               <input type="hidden" name="csrf_token" value="<?php echo Session::get("csrf_token") ?>">
               <input type="hidden" name="tour_id" value="<?php echo $data['tour']['id']?>">
                   <input type="hidden" name="departure_date" value="<?php echo Request::input("date","")?>">
               <button type="submit" class="btn filter-btn ">Đặt tour</button>
               </div>
               <script>
               document.addEventListener("DOMContentLoaded", function () {
                  let adult = document.getElementById("adult");
                  let priceAdult = Number(adult.dataset.price) || 0;
                  

                  let children = document.getElementById("children");
                  let priceChildren = Number(children.dataset.price) || 0;
                  
               
                  let baby = document.getElementById("baby");
                  let priceBaby = Number(baby.dataset.price) || 0;

                  document.querySelector(".price-adult").textContent = priceAdult.toLocaleString("vi-VN");
                  document.querySelector(".price-children").textContent = priceChildren.toLocaleString("vi-VN");
                  document.querySelector(".price-baby").textContent = priceBaby.toLocaleString("vi-VN");
                  function updateTotal() {
                     let quantityChildren = Number(children.value) || 0;
                     let quantityAdult = Number(adult.value) || 0;
                     let quantityBaby = Number(baby.value) || 0;
                        let totalAdult = priceAdult * quantityAdult;
                        let totalChildren = priceChildren * quantityChildren;
                        let totalBaby = priceBaby * quantityBaby;
                        let total = totalAdult + totalChildren + totalBaby;
                        document.querySelector(".quantity-adult").textContent = quantityAdult;
                        document.querySelector(".quantity-children").textContent = quantityChildren;
                        document.querySelector(".quantity-baby").textContent = quantityBaby;
                        document.querySelector(".amount span").textContent = total.toLocaleString("vi-VN");
                      document.querySelector(".total-cart").textContent = total.toLocaleString("vi-VN");
                      document.querySelector("#totalPrice").value = total;
                  }
               
                  adult.addEventListener("input", updateTotal);
                  children.addEventListener("input", updateTotal);
                  baby.addEventListener("input", updateTotal);
                  updateTotal();
               });
               </script>
            </div>
         </div>
      </form>
   </div>
   </div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.booking__container');

        form.addEventListener('submit', function(event) {
            let isValid = true;

            document.querySelectorAll('.name-err, .phone-err, .email-err, .address-err').forEach(el => {
                el.textContent = '';
            });

            const fullName = document.getElementById('fullName').value.trim();
            if (fullName === '') {
                document.querySelector('.name-err').textContent = 'Vui lòng nhập họ và tên';
                isValid = false;
            }

            const phone = document.getElementById('phone').value.trim();
            if (phone === '') {
                document.querySelector('.phone-err').textContent = 'Vui lòng nhập số điện thoại';
                isValid = false;
            }
            if (!/^(0|\+84)[3|5|7|8|9][0-9]{8}$/.test(phone)) {
                document.querySelector('.phone-err').textContent = 'Số điện thoại không hợp lệ';
                isValid = false;
            }

            const email = document.getElementById('email').value.trim();
            if (email === '') {
                document.querySelector('.email-err').textContent = 'Vui lòng nhập email';
                isValid = false;
            }
            if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
                document.querySelector('.email-err').textContent = 'Email không hợp lệ';
                isValid = false;
            }

            const address = document.getElementById('address').value.trim();
            if (address === '') {
                document.querySelector('.address-err').textContent = 'Vui lòng nhập địa chỉ';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>