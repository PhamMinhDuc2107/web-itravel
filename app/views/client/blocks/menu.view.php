<!-- menu -->
<nav class="menu">
   <ul class="menu__list">
      <li class="menu__item">
         <a href="<?php echo _WEB_ROOT; ?>" class="menu__item--link"> Trang chủ </a>
      </li>
      <li class="menu__item dropdown">
         <a href="<?php echo _WEB_ROOT?>/du-lich" class="menu__item--link"> Tất cả tour </a>
         <i class="fa fa-caret-down"></i>
         <ul class="submenu-1">
         <?php if (isset($data['categories'])) : ?>
   <?php foreach ($data['categories'] as $category) : ?>
      <?php if ($category['parent_id'] == 0) : ?>
         <li class="dropdown">
            <a href="<?php echo _WEB_ROOT . '/' . $category['slug']; ?>">
               <?php echo $category['name']; ?>
            </a>

            <?php
            $hasChildrenCategory = false;
            $hasDeparture = ($category['slug'] === "tour-trong-nuoc" || $category['slug'] === 'tour-nuoc-ngoai');
            foreach ($data['categories'] as $subCategory) {
               if ($subCategory['parent_id'] == $category['id']) {
                  $hasChildrenCategory = true;
                  break;
               }
            }
            ?>

            <?php if ($hasChildrenCategory) : ?>
               <i class="fa fa-caret-down"></i>
               <ul class="submenu-2">
                  <?php foreach ($data['categories'] as $subCategory) : ?>
                     <?php if ($subCategory['parent_id'] == $category['id']) : ?>
                        <li>
                           <a href="<?php echo _WEB_ROOT . '/' . $subCategory['slug']; ?>">
                              <?php echo $subCategory['name']; ?>
                           </a>
                        </li>
                     <?php endif; ?>
                  <?php endforeach; ?>
               </ul>
            <?php endif; ?>
         </li>
      <?php endif; ?>
   <?php endforeach; ?>
<?php endif; ?>

         </ul>
      </li>
      <li class="menu__item">
         <a href="<?php echo _WEB_ROOT; ?>/gioi-thieu" class="menu__item--link">Giới thiệu</a>
      </li>
      <li class="menu__item">
         <a href="<?php echo _WEB_ROOT; ?>/tin-tuc" class="menu__item--link">Tin tức</a>
      </li>
      <li class="menu__item">
         <a href="<?php echo _WEB_ROOT; ?>/lien-he" class="menu__item--link">Liên hệ</a>
      </li>
   </ul>
</nav>
<!-- menu -->
