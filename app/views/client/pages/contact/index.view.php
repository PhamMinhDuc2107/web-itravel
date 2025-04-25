<div class="contact">
   <div class="container">
      <div class="contact__container"></div>
      <h3 class="block-title title-center">
         <?php echo $data['heading'] ?? "" ?>
      </h3>
      <div class="contact__list">
         <div class="contact__item">
            <i class="fa-solid fa-location-dot"></i>
            <p>Địa chỉ</p>
            <span>Số 21-23 Nguyễn Công Hoan, phường Ngọc Khánh, quận Ba Đình Hà Nội</span>
         </div>
         <div class="contact__item">
            <i class="fa-solid fa-envelope"></i>
            <p>Email</p>
            <span>info@dulichitravel.com.vn</span>
         </div>
         <div class="contact__item">
            <i class="fa-solid fa-phone"></i>
            <p>Hotline</p>
            <span>0978953543</span>
         </div>
      </div>
      <div class="row">
         <iframe class="map-container"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14896.234495186189!2d105.81507806171341!3d21.030340193851536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab8088d28687%3A0x2c41619cb734a241!2zQ8OUTkcgVFkgVE5ISCBUSMavxqBORyBN4bqgSSBWw4AgROG7ikNIIFbhu6QgSVRSQVZFTCBWSeG7hlQgTkFN!5e0!3m2!1svi!2s!4v1738839130004!5m2!1svi!2s"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
         <form action="<?php echo _WEB_ROOT . 'gui-thong-tin-lien-he' ?>" method="post" class="contact__form">
            <input type="hidden" name="csrf_token" value="<?php echo Session::get("csrf_token") ?>">
            <div>
               <input type="text" name="name" placeholder="Họ và tên">
               <p class="name-err"></p>
            </div>
            <div>
               <input type="text" name="email" placeholder="Email">
               <p class="email-err"></p>
            </div>
            <div class="dropdown">
               <input type="text" name="reference" class="dropdown_input" placeholder="Chọn vấn đề cần tư vấn" readonly>
               <p class="reference-err"></p>
               <ul class="dropdown_list">
                  <?php if (isset($data['categories'])) : ?>
                     <?php foreach ($data['categories'] as $item): ?>
                        <?php if ($item['parent_id'] === 0) : ?>
                           <li class="dropdown_item"><?php echo $item['name'] ?></li>
                        <?php endif; ?>
                     <?php endforeach; ?>
                  <?php endif; ?>
               </ul>
            </div>
            <div>
               <input type="text" name="phone" placeholder="Điện thoại">
               <p class="phone-err"></p>
            </div>
            <div>
               <textarea name="content" id="" placeholder="Nội dung"></textarea>
               <p class="content-err"></p>
            </div>
            <button type="submit" class="btn btn-submit-contact">Gửi thông tin</button>
         </form>
      </div>
   </div>
</div>