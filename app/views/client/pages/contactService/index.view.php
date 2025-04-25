<section class="contactService">
   <div class="container">
      <h1 class="block-title title-center title"><?php echo $data['title'] ?></h3>
         <div class="contactService__container">
            <form class="contactService__left" method="POST" action="
            <?php echo _WEB_ROOT ?>/gui-thong-tin-lien-he">
               <input type="hidden" name="csrf_token" value="<?php echo Session::get("csrf_token") ?>">
               <input type="hidden" name="reference" value="<?php echo $data['title'] ?>" />
               <div class="row-50">
                  <input type="text" name="name" placeholder="Tên của bạn">
               </div>
               <div class="row-50">
                  <input type="text" name="email" placeholder="Địa chỉ email">
               </div>
               <div class="row-50">
                  <input type="text" name="phone" placeholder="Số điện thoại">
               </div>

               <?php if ($data['formField'] === "visa"): ?>
                  <div class="row-50">
                     <input type="text" name="address" placeholder="Địa chỉ">
                  </div>
                  <div class="dropdown row-50">
                     <input type="text" name="reference" class="dropdown_input" placeholder="Chọn vấn đề cần tư vấn"
                        readonly value="">
                     <ul class="dropdown_list">
                        <li class="dropdown_item">Visa Châu Á</li>
                        <li class="dropdown_item">Visa Châu Phi</li>
                        <li class="dropdown_item">Visa Châu Mỹ</li>
                        <li class="dropdown_item">Visa Châu Âu</li>
                        <li class="dropdown_item">Visa Châu Úc</li>
                     </ul>
                  </div>
                  <div class="row-50">
                     <input type="number" name="quantity" placeholder="" min="1" value="1" max='99'>
                  </div>

               <?php elseif ($data['formField'] === "ho-chieu"): ?>
                  <div class="row-50">
                     <input type="text" name="address" placeholder="Địa chỉ">
                  </div>
                  <div class="row-50">
                     <input type="number" name="quantity" placeholder="Số lượng" min="1" max='99'>
                  </div>
               <?php elseif ($data['formField'] === "thue-xe-du-lich"): ?>
                  <div class="dropdown row-50">
                     <input type="text" name="reference" class="dropdown_input" placeholder="Chọn vấn đề cần tư vấn"
                        readonly value="">
                     <ul class="dropdown_list">
                        <li class="dropdown_item">Thuê xe du lịch 4 chỗ</li>
                        <li class="dropdown_item">Thuê xe du lịch 7 chỗ</li>
                        <li class="dropdown_item">Thuê xe du lịch 16 chỗ</li>
                        <li class="dropdown_item">Thuê xe du lịch 24 chỗ</li>
                        <li class="dropdown_item">Thuê xe du lịch 29 chỗ</li>
                        <li class="dropdown_item">Thuê xe du lịch 35 chỗ</li>
                        <li class="dropdown_item">Thuê xe du lịch 39 chỗ</li>
                        <li class="dropdown_item">Thuê xe du lịch 45 chỗ</li>
                     </ul>
                  </div>
                  <div class="row-50">
                     <input type="text" name="departure" placeholder="Địa điểm đi">
                  </div>
                  <div class="row-50">
                     <input type="text" name="destination" placeholder="Địa điểm đến">
                  </div>
                  <div class="row-50">
                     <input type="text" id="departureDate" name="departureDate" placeholder="Ngày đi">
                  </div>
                  <script>
                     flatpickr("#departureDate", {
                        dateFormat: "d-m-Y",
                        defaultDate: null,
                        minDate: "today",
                        locale: "vn",
                     });
                  </script>
                  <div class="row-50">
                     <input type="text" id="returnDate" name="returnDate" placeholder="Ngày về">
                  </div>
                  <script>
                     flatpickr("#returnDate", {
                        dateFormat: "d-m-Y",
                        defaultDate: null,
                        minDate: "today",
                        locale: "vn",
                     });
                  </script>
               <?php elseif ($data['formField'] === "to-chuc-su-kien"): ?>
                  <div class="row-50">
                     <input type="text" name="destination" placeholder="Địa điểm đến">
                  </div>
                  <div class="dropdown row-50">
                     <input type="text" name="participants" class="dropdown_input" placeholder="Số người tham gia sự kiện"
                        readonly value="">
                     <ul class="dropdown_list">
                        <li class="dropdown_item">0 - 50 người</li>
                        <li class="dropdown_item">50 - 100 người</li>
                        <li class="dropdown_item">100 - 200 người</li>
                        <li class="dropdown_item">Lớn hơn 200 người</li>
                     </ul>
                  </div>
               <?php elseif ($data['formField'] === "can-cuoc-cong-dan"): ?>
                  <div class="row-50">
                     <input type="text" name="address" placeholder="Địa chỉ">
                  </div>
               <?php endif; ?>

               <div class="row-100 note">
                  <textarea placeholder="Nội dung cần chú ý" name="content"></textarea>
               </div>
               <button class="btn btn-submit-contactService" type="submit">
                  <i class="fa-solid fa-paper-plane"></i>
               </button>
            </form>
            <div class="contactService__right">
               <h3 class="block-title title-center title">Tư vấn miễn phí</h3>
               <div>
                  <img src="<?php echo ASSET ?>/client/images/customer_service_female.png" alt="Dịch vụ">
                  <p>
                     <span>Ms.Quỳnh</span>
                     <span>0982321612</span>
                  </p>
               </div>
               <div>
                  <img src="<?php echo ASSET ?>/client/images/customer_service_male.png" alt="Dịch vụ">
                  <p>
                     <span>Mr.Hà</span>
                     <span>0976938339</span>
                  </p>
               </div>
               <div>
                  <span><i class="fa fa-location-dot"></i></span>
                  <span>Số 21-23 Nguyễn Công Hoan, phường Ngọc Khánh, quận Ba Đình, Hà Nội</span>
               </div>
               <div>
                  <span><i class="fa-solid fa-envelope"></i></span>
                  <span>info@dulichitravel.com.vn</span>
               </div>
               <div>
                  <span><i class="fa fa-phone"></i></span>
                  <span>0978953543</span>
               </div>
            </div>
         </div>
   </div>
</section>