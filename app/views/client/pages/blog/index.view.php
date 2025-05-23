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
                  <a class="blog__item--category" href="<?php echo _WEB_ROOT.'/tin-tuc'."/".$blog['category_slug']?>"><?php echo $blog['category_name']?></a>
                  <a href="<?php echo _WEB_ROOT.'/tin-tuc/'.$blog['slug']?>"><?php echo $blog['title']?></a>
                  <div>
                     <i class="fa-solid fa-calendar-days"></i>
                     <span><?php echo Util::formatDate($blog['created_at'])?></span>
                  </div>
               </div>
               <script type="application/ld+json">
                  {
                  "@context": "https://schema.org",
                  "@type": "BlogPosting",
                  "mainEntityOfPage": {
                     "@type": "WebPage",
                     "@id": "<?php echo _WEB_ROOT . '/tin-tuc/' . $blog['slug']; ?>"
                  },
                  "headline": "<?php echo htmlspecialchars($blog['title']); ?>",
                  "image": [
                     "<?php echo _WEB_ROOT . htmlspecialchars($blog['thumbnail']); ?>"
                  ],
                  "datePublished": "<?php echo date('c', strtotime($blog['created_at'])); ?>",
                  "dateModified": "<?php echo date('c', strtotime($blog['updated_at'])); ?>",
                  "author": {
                     "@type": "Person",
                     "name": "<?php echo htmlspecialchars($blog['author_name'] ?? 'Itravel Team'); ?>"
                  },
                  "publisher": {
                     "@type": "Organization",
                     "name": "Itravel",
                     "logo": {
                        "@type": "ImageObject",
                        "url": "<?php echo ASSET ?>/client/images/itravel.png"
                     }
                  },
                  "description": "<?php echo htmlspecialchars($blog['description'] ?? $blog['title']); ?>",
                  "articleBody": "<?php echo htmlspecialchars(strip_tags(substr($blog['content'], 0, 500))); ?>"
                  }
                  </script>

            <?php endforeach;?>
            <?php endif;?>
         </div>
         <div class="pagi">
            <ul class="pagi__list">
               <?php $totalPages = $data['totalPages'] ?? 1;
               $page = (int)htmlspecialchars(Request::input('page') ?? 1);
               ?>
               
               <?php for($i = 1; $i <= $totalPages; $i++):?>
                  <li class="pagi__item"><a href="<?php echo Util::buildPageUrl($i)?>" class="pagi__item--link 
                  <?php echo $page === $i ? "active" :""?>"><?php echo  $i?></a></li>
               <?php endfor?>
            </ul>
         </div>
      </div>
   </div>
</div>