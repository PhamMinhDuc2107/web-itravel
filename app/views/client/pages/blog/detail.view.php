<div class="blogDetail">
    <div class="container">
        <h3 class="blogDetail__title">
           <?php echo $data['title'] ?? "" ?>
        </h3>
        <div class="blogDetail__info">
            <div class="blogDetail__info--date">
                <i class="fa-regular fa-clock"></i>
                <span><?php echo Util::formatDate($data['blog']['created_at']) ?></span>
            </div>
            <div class="blogDetail__info--author">
                <i class="fa-solid fa-user-tie"></i>
                <span><?php echo $data['blog']['admin_username'] ?></span>
            </div>
        </div>
        <div class="content">
           <?php echo $data['blog']['content'] ?>
        </div>
        <div class="relatedNew swiper">
           <h3 class="text-center relatedNew__title">
              Tin tức liên quan
           </h3>
           <div class="swiper-wrapper">
              <?php if(isset($data['relatedNews'])):?>
              <?php foreach ($data['relatedNews'] as $item):?>
               <div class="blog__item swiper-slide">
                 <div class="detail">
                    <img src="<?php echo _WEB_ROOT.$item['thumbnail']?>" alt="<?php echo $item['title']?>">
                    <div class="info">
                       <a href="<?php echo _WEB_ROOT.'/tin-tuc/'.$item['slug']?>"><?php echo $item['title']?></a>
                       <span><?php echo Util::printArr($item['created_at'])?></span>
                    </div>
                 </div>
              </div>
              <?php endforeach;?>
              <?php endif; ?>
           </div>
           <div class="swiper-button-prev"></div>
           <div class="swiper-button-next"></div>
        </div>
    </div>
</div>
<script>
   const tourSwiper = new Swiper('.relatedNew', {
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
      spaceBetween: 10,
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
</script>