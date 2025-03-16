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
            <form action="<?php echo _WEB_ROOT.'/tim-kiem'?>" class="topbar__search  search-bar">
                <input
                        type="text"
                        name="search"
                        placeholder="Tìm kiếm tour, tin tức..."
                        id="searchInput"
                />
                <input type="hidden" name="type" value="tour">
                <div class="search__result">
                    <div class="row ">
                        <h3 class="title">Tour</h3>
                        <div class="row_list tour-res">
                        </div>
                    </div>
                    <div class="row">
                        <h3 class="title">Tin tức</h3>
                        <div class="row_list blog-res">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn topbar__search--btn ">
                    <i class="fa fa-search"></i>
                </button>

            </form>


            <div class="topbar__right">
                <div class="topbar__search--icon">
                    <i class="fa fa-search"></i>
                </div>
            </div>
            <div class="form-search search-bar" action="<?php echo _WEB_ROOT.'/tim-kiem'?>">
                <input
                        type="text"
                        name="search"
                        placeholder="Tìm kiếm tour, tin tức..."
                        id="searchInput"
                />
                <input type="hidden" name="type" value="tour">
                <div class="search__result">
                    <div class="row ">
                        <h3 class="title">Tour</h3>
                        <div class="row_list tour-res">
                        </div>
                    </div>
                    <div class="row">
                        <h3 class="title">Tin tức</h3>
                        <div class="row_list blog-res">
                        </div>
                    </div>
                </div>
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(".search-bar").each(function () {
                        const form = $(this);
                        const searchInput = form.find('#searchInput');
                        let timeoutId;

                        searchInput.on('input', function() {
                            if (searchInput.val() === '') {
                                form.find('.search__result').removeClass("active");
                            } else {
                                timeoutId = setTimeout(function() {
                                    const search = searchInput.val();
                                    performSearch(search, form);
                                }, 1000);
                            }
                        });
                    })


                    function performSearch(search, form) {
                        $.ajax({
                            url: '<?php echo _WEB_ROOT.'/tim-kiem-ajax'?>',
                            method: 'GET',
                            data: { search: search },
                            success: function(response) {
                                form.find('.search__result').addClass("active");
                                const res = JSON.parse(response);
                                const blogs  = res.blogs ?? [];
                                const tours = res.tours  ?? [];
                                const tourRes = form.find(".tour-res");
                                const blogRes = form.find(".blog-res");

                                tourRes.empty();
                                if(tours && tours.length>0) {
                                    let indexTour = 0;
                                    tours.forEach(function(tour) {
                                        if(indexTour >= 2) {
                                            return;
                                        }
                                        tourRes.append(
                                            `<div class="row__item ">
                                                <div class="row__image">
                                                    <img src="<?php echo _WEB_ROOT?>${tour.image}" alt="${tour.name}">
                                                </div>
                                                <div class="info">
                                                    <a href='<?php echo _WEB_ROOT?>/du-lich/${tour.slug}' class="info__title">${tour.name}</a>
                                                    <span class="info__price">
                                                        ${tour.adult_price.toLocaleString('vi-VN', {
                                                style: 'currency',
                                                currency: 'VND',
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            })}
                                                    </span>
                                                </div>
                                            </div>`
                                        )
                                        indexTour+= 1;

                                    })
                                    tourRes.append(
                                        `
                                        <a href="<?php  echo _WEB_ROOT.'/tim-kiem'?>?search=${search}&type=tour" class="row__link">Xem thêm ${tours.length - indexTour} kết quả</a>
                                        `
                                    );
                                }else {
                                    tourRes.append(
                                        `Không tìm thấy kêt quả nào`
                                    )
                                }
                                blogRes.empty();
                                if(blogs && blogs.length>0) {
                                    let indexBlog = 0;
                                    blogs.forEach(function(blog) {
                                        if(indexBlog >= 2) {
                                            return;
                                        }
                                        blogRes.append(
                                            `<div class="row__item ">
                                                <div class="row__image">
                                                    <img src="<?php echo _WEB_ROOT?>${blog.thumbnail}" alt="${blog.title}">
                                                </div>
                                                <div class="info">
                                                    <a href='<?php echo _WEB_ROOT?>/tin-tuc/${blog.slug}' class="info__title">${blog.title}</a>
                                                </div>
                                            </div>`
                                        )
                                        indexBlog+= 1;

                                    })
                                    blogRes.append(
                                        `
                                        <a href="<?php  echo _WEB_ROOT.'/tim-kiem'?>?search=${search}&type=blog" class="row__link">Xem thêm ${blogs.length - indexBlog} kết quả</a>
                                        `
                                    );
                                }else {
                                    blogRes.append(
                                        `Không tìm thấy kêt quả nào`
                                    )
                                }
                            },
                            error: function(error) {
                                console.error('Lỗi tìm kiếm:', error);
                            }
                        });
                    }
                });
            </script>
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