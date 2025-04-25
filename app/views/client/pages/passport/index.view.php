<div class="visa">
   <div class="container">
      <div class="visa__container">
         <h3 class="block-title title-center"><?php echo $data['heading'] ?? "Visa" ?></h3>
         <div class="visa__info">
            <h4 class="visa__info--title">
               Thông tin bao gồm
            </h4>
            <ul style="list-style-type: style;" class="visa__info--list">
               <li>
                  <span>Hồ sơ cá nhân</span>
                  <ul style="list-style-type:square">
                     <li>Hộ chiếu gốc còn hạn trên 6 tháng</li>
                     <li>Chứng minh nhân dân sao y công chứng</li>
                     <li>Sổ hộ khẩu sao y công chứng nguyên cuốn</li>
                     <li>Tình trạng hôn nhân: kết hôn – độc thân – ly hôn – chứng tử</li>
                  </ul>
               </li>
               <li>
                  <span>Hồ sơ xin việc</span>
                  <ul style="list-style-type:square">

                     <li>Đăng ký kinh doanh nếu là chủ doanh nghiệp hoặc cổ đồng - sao y công chứng</li>
                     <li>Báo cáo thuế 3 tháng gần nhất có chữ ký giám đốc và mộc đỏ - bản gốc</li>
                     <li>Giấy nộp tiền vào ngân sách nhà nước ( theo quý hoặc tháng) – bản sao y</li>
                     <li>Hóa đơn, hợp đồng, giấy hải quan mua bán giữa 2 bên </li>
                  </ul>
               </li>
               <li>
                  <span>Hồ sơ về tài chính</span>
                  <ul style="list-style-type:square">
                     <li>Sao y công chứng cà vẹt xe ôtô công ty nếu có</li>
                     <li>Sao kê tài khoản công ty giao dich trong 2 tháng gần nhất</li>
                  </ul>
               </li>

            </ul>
         </div>
         <div style="display:flex; align-items: center; justify-content: center;margin-top:1rem">
            <a href="<?php echo _WEB_ROOT . '/lien-he-tu-van-ho-chieu' ?>" class="btn btn-submit-contact"
               style="display: inline-block">Liên hệ</a>
         </div>
      </div>
   </div>
</div>