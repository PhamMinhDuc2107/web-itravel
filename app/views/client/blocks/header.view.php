<!-- topbar -->
<section class="topbar">
    <div class="container">
        <div class="topbar__container">
            <div class="topbar__menu--icon">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="topbar__logo">
                <img src="<?php echo ASSET?>/client/images/itravel.png" alt="Hình ảnh thương hiệu của itravel" />
            </div>
            <form class="topbar__search">
                <input
                        type="text"
                        name="search"
                        placeholder="Tìm kiếm tour, tin tức..."
                />
                <button class="btn topbar__search--btn ">
                    <i class="fa fa-search"></i>
                </button>
            </form>
            <div class="topbar__right">
                <div class="topbar__search--icon">
                    <i class="fa fa-search"></i>
                </div>
            </div>
            <div class="form-search">
                <input type="text" placeholder="Tìm kiếm tour, tin tức..." />
                <button><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</section>
<!-- /topbar -->
<!-- header -->
<header class="header">
    <div class="container">
        <div class="header__container">
            <!-- nav -->
            <ul class="nav">
                <li class="nav__item">
                    <a href="<?php echo _WEB_ROOT?>" class="nav__item--link">
                        Trang chủ
                    </a>
                </li>
                <li class="nav__item">
                    <a href="<?php echo _WEB_ROOT?>/gioi-thieu" class="nav__item--link"
                    >Giới thiệu
                    </a>
                </li>
                <li class="nav__item">
                    <a href="<?php echo _WEB_ROOT?>" class="nav__item--link">
                        <img src="<?php echo ASSET?>/client/images/itravel.png" alt="Thương hiệu hình ảnh của itravel" />
                    </a>
                </li>
                <li class="nav__item">
                    <a href="<?php echo _WEB_ROOT?>/tin-tuc" class="nav__item--link">
                        Tin tức
                    </a>
                </li>
                <li class="nav__item">
                    <a href="<?php echo _WEB_ROOT?>/lien-he" class="nav__item--link">
                        Liên Hệ
                    </a>
                </li>

            </ul>
            <!-- nav -->
            <!--header__menu -->
            <ul class="header__menu">
                <li class="header__menu--item">
                    <a href="<?php echo _WEB_ROOT.'/du-lich'?>" class="header__menu--link"
                        >Tất cả tour</a
                    >
                </li>
               <?php if (isset($data['categories'])) : ?>
                  <?php foreach ($data['categories'] as $category) : ?>
                     <?php if ($category['parent_id'] == 0) : ?>
                           <li class="header__menu--item">
                               <a href="<?php echo _WEB_ROOT.'/'.$category['slug'] ?>" class="header__menu--link">
                                  <?php echo $category['name'] ?>
                               </a>
                              <?php
                              $hasChildren = false;
                              foreach ($data['categories'] as $subCategory) {
                                 if ($subCategory['parent_id'] == $category['id']) {
                                    $hasChildren = true;
                                    break;
                                 }
                              }
                              ?>
                              <?php if ($hasChildren) : ?>
                                  <i class="fa fa-caret-down"></i>
                                  <ul class="dropdown__menu dropdown__lv1">
                                     <?php foreach ($data['categories'] as $subCategory) : ?>
                                        <?php if ($subCategory['parent_id'] == $category['id']) :?>
                                             <li class="dropdown__menu--item">
                                                 <a href="<?php echo _WEB_ROOT.'/'.$category['slug']."?departure=".$subCategory['slug']  ?>">
                                                    <?php echo $subCategory['name'] ?>
                                                 </a>
                                                 <?php $hasLocation = false;
                                                    foreach ($data['locations'] as $location) {
                                                        if ($location['category'] == $category['id']) {
                                                            $hasLocation = true;
                                                        }
                                                    }
                                                 ?>
                                                 <?php if ($hasLocation) : ?>
                                                     <i class="fa fa-caret-right dropdown__lv1--icon"></i>
                                                     <ul class="dropdown__menu dropdown__lv2">
                                                         <li class="dropdown__lv2--item">
                                                             <span>Tuyến điểm</span>
                                                             <?php foreach ($data['locations'] as $location):?>
                                                                <?php if($category['id'] === $location['category']):?>
                                                                     <a href="<?php echo _WEB_ROOT.'/'.$category['slug'].'/'.$location['slug']."?departure=".$subCategory['slug'] ?>" class="w-50"><?php echo $location['name']?></a>
                                                                <?php endif;?>
                                                             <?php endforeach;?>
                                                         </li>
                                                     </ul>
                                                 <?php endif?>
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
            <!--header__menu -->
        </div>
    </div>
</header>
<!-- /header -->