<div class="blog page-blog">
   <div class="container">
      <div class="blog__container">
         <h3 class="block-title title-center">
            <?php echo $data['heading'] ?? ""?>
         </h3>
         <div class="blog__list">
            <?php if(isset($data['blogs'])):?>
            <?php foreach($data['blogs'] as $blog):?>
               <div class="blog__item">
                  <img src="<?php echo _WEB_ROOT.$blog['thumbnail']?>" alt="<?php echo $blog['slug']?>">
                  <a href="<?php echo _WEB_ROOT.'/tin-tuc/'.$blog['slug']?>"><?php echo $blog['title']?></a>
                  <div>
                     <i class="fa-solid fa-calendar-days"></i>
                     <span><?php echo Util::formatDate($blog['created_at'])?></span>
                  </div>
               </div>
            <?php endforeach;?>
            <?php endif;?>
         </div>
         <div class="pagi">
            <ul class="pagi__list">
               <li class="pagi__item"><a href="" class="pagi__item--link active">1</a></li>
               <li class="pagi__item"><a href="" class="pagi__item--link">2</a></li>
               <li class="pagi__item"><a href="" class="pagi__item--link">3</a></li>
               <li class="pagi__item"><a href="" class="pagi__item--link">4</a></li>
               <li class="pagi__item"><a href="" class="pagi__item--link">5</a></li>
               <li class="pagi__item"><a href="" class="pagi__item--link">6</a></li>
            </ul>
         </div>
      </div>
   </div>
</div>