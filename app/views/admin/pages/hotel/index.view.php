<div class="container-fluid py-4">
   <div class="row">
      <div class="col-12">
         <form action="<?php echo _WEB_ROOT . "/dashboard/hotel-delete" ?>" method="post" class="">
            <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
            <div class="card mb-4">
               <div class="d-flex justify-content-between align-items-center card-header pb-0">
                  <div class="d-flex justify-content-between align-items-center col-2 col-md-2 col-sm-6 gap-2">
                     <div class="d-flex gap-1 flex-column col-6">
                        <span>Sắp xếp:</span>
                        <div class="dropdown col-12 border-radius-md border border-1 py-1">
                           <span class="d-block text-center sortBy" data-bs-toggle="dropdown" aria-expanded="true">
                              <?php echo Request::input('sortBy') ?? "asc" ?>
                           </span>
                           <ul class="dropdown-menu w-100 sort-options">
                              <li><a class="dropdown-item" data-value="asc"
                                    href="<?php echo Util::buildOrderByUrl() ?>">Tăng dần</a></li>
                              <li><a class="dropdown-item" data-value="desc"
                                    href="<?php echo Util::buildOrderByUrl("desc") ?>">Giảm dần</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="d-flex gap-1 flex-column col-6">
                        <span>Cột:</span>
                        <div class="dropdown col-12 border-radius-md border border-1 py-1">
                           <span class="d-block text-center sortCol" data-bs-toggle="dropdown" aria-expanded="true">
                              <?php echo Request::input('sortCol') ?? "id" ?>
                           </span>
                           <ul class="dropdown-menu w-100 column-options">
                              <li><a class="dropdown-item" data-value="id"
                                    href="<?php echo Util::buildOrderColByUrl() ?>">Sắp xếp theo ID</a></li>
                              <li><a class="dropdown-item" data-value="title"
                                    href="<?php echo Util::buildOrderColByUrl("name") ?>">Sắp xếp tên</a>
                              </li>
                              <li><a class="dropdown-item" data-value="slug"
                                    href="<?php echo Util::buildOrderColByUrl("status_hot") ?>">Trạng thái hot</a></li>
                              <li><a class="dropdown-item" data-value="created_at"
                                    href="<?php echo Util::buildOrderColByUrl("created_at") ?>">Sắp xếp theo Thời
                                    gian</a></li>

                           </ul>
                        </div>
                     </div>
                  </div>
                  <button type="button" class=" btn btn-primary  text-white font-weight-bold text-xs "
                     style="margin-bottom: 0;" data-bs-toggle="modal" data-bs-target="#modalCreated">
                     Thêm mới
                  </button>
               </div>
               <?php if (Request::input("msg") !== null) : ?>
                  <span
                     class="<?php echo Request::input('type') === "error" ? "text-warning" : "text-success" ?> card-header"
                     style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg')) ?></span>
               <?php endif; ?>
               <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                     <table class="table align-items-center mb-0 min-vh-50 ">
                        <thead>
                           <tr>
                              <th class="">
                              </th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-2"
                                 style="min-width: 150px;">
                                 Tên
                              </th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-2"
                                 style="min-width: 150px;">
                                 Slug
                              </th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                 Mô tả
                              </th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                 Địa chỉ
                              </th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                 Điện thoại
                              </th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                 Email
                              </th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                 Giá
                              </th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                 Sao
                              </th>

                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                 Danh mục khách sạn
                              </th>
                              <th class="text-secondary opacity-7"></th>
                           </tr>
                        </thead>
                        <tbody class="table-body">
                           <?php
                           $hotels = $data['hotels'] ?? [];
                           ?>
                           <?php if (!empty($hotels)) : ?>
                              <?php foreach ($hotels as $item): ?>
                                 <tr>
                                    <td class="text-center" style="width: 10px;">
                                       <input type="checkbox" name="id[]" class="mx-auto input-checkbox"
                                          value="<?php echo $item['id'] ?>" style="width: 15px; height:15px">
                                    </td>
                                    <td class='col-2'>
                                       <div class="d-flex px-2 py-1">
                                          <h6 class="mb-0 text-sm hiddenText"><?php echo $item["name"] ?></h6>
                                       </div>
                                    </td>
                                    <td class='col-2'>
                                       <div class="d-flex px-2 py-1">
                                          <h6 class="mb-0 text-sm hiddenText"><?php echo $item["slug"] ?></h6>
                                       </div>
                                    </td>
                                    <td class='col-3 '>
                                       <div class="d-flex px-2 py-1 overflow-hidden">
                                          <div class="mb-0 text-sm hiddenText"><?php echo $item["description"] ?></div>
                                       </div>
                                    </td>
                                    <td class=''>
                                       <div class="px-2 py-1 text-center">
                                          <div class="mb-0 text-sm">
                                             <?php echo $item["address"] . ", " . $item['city'] . ", " . $item['country'] ?>
                                          </div>
                                       </div>
                                    </td>

                                    <td class=''>
                                       <div class="px-2 py-1 text-center">
                                          <div class="mb-0 text-sm">
                                             <?php echo $item["phone_number"] ?></div>
                                       </div>
                                    </td>
                                    <td class=''>
                                       <div class="px-2 py-1 text-center">
                                          <div class="mb-0 text-sm">
                                             <?php echo $item["email"] ?></div>
                                       </div>
                                    </td>
                                    <td class=''>
                                       <div class="px-2 py-1 text-center">
                                          <div class="mb-0 text-sm">
                                             <?php echo $item["price_range"] ?></div>
                                       </div>
                                    </td>
                                    <td class=''>
                                       <div class="px-2 py-1 text-center">
                                          <div class="mb-0 text-sm">
                                             <?php echo $item["rating"] ?></div>
                                       </div>
                                    </td>
                                    <td class=''>
                                       <div class="px-2 py-1 text-center">
                                          <div class="mb-0 text-sm">
                                             <?php echo $item["hotel_type_id"] ?></div>
                                       </div>
                                    </td>

                                    <td class="align-middle text-center">
                                       <a href="<?php echo _WEB_ROOT . "/dashboard/hotel-update/" . $item['id'] ?>"
                                          class="text-secondary font-weight-bold text-xs " style="margin-bottom: 0;"
                                          id="btnEdit">
                                          Edit
                                       </a>

                                    </td>
                                 </tr>
                                 </tr>
                              <?php endforeach; ?>
                           <?php endif; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <?php $page = Request::input("page") ?? 1;
            $totalPages = $data['totalPages'] ?? 1;
            ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end" style="border-radius: 10px">
               <span>Items per page:</span>
               <div class="dropdown" style="
                         height: 30px;
                         line-height: 30px;
                         padding: 0 15px;
                         border-radius: 10px;
                         border: 1px solid #dee2e6;
                         margin-right: 10px;
                    ">
                  <span class="d-block text-center dropdown-toggle limit" id="dropdownMenuButton1"
                     data-bs-toggle="dropdown" aria-expanded="true">
                     <?php echo Request::input('limit') ?? 10 ?>
                  </span>
                  <ul class="dropdown-menu w-100 limit-options" aria-labelledby="dropdownMenuButton1"
                     style="margin-top: 10px!important;">
                     <li><a class="dropdown-item limit-option" href="<?php echo Util::buildLimitUrl(10) ?>">10</a></li>
                     <li><a class="dropdown-item limit-option" href="<?php echo Util::buildLimitUrl(25) ?>">25</a></li>
                     <li><a class="dropdown-item limit-option" href="<?php echo Util::buildLimitUrl(50) ?>">50</a></li>
                  </ul>
               </div>
               <ul class="pagination">
                  <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                     <a class="page-link" href="<?php echo Util::buildPageUrl(max(1, $page - 1)) ?>"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                     </a>
                  </li>
                  <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                     <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="<?php echo Util::buildPageUrl($i); ?>"><?php echo $i; ?></a>
                     </li>
                  <?php endfor; ?>
                  <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                     <a class="page-link" href="<?php echo Util::buildPageUrl(min($totalPages, $page + 1)); ?>"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                     </a>
                  </li>
               </ul>
            </nav>
            <div class="footer-function gap-2 mt-2 p-2 position-sticky z-index-3 bottom-1 bg-white d-none">
               <div class="d-flex justify-content-between align-items-center w-100">
                  <div class="footer-text w-25 d-flex gap-2 align-items-center">
                     <span class="footer-text-content"></span> selected
                     <span class="footer-btn d-flex justify-content-center align-items-center rounded-circle"
                        style="width: 20px; height: 20px">
                        <i class="fa fa-close " style="width: 100%; height: 100%;"></i>
                     </span>
                  </div>
                  <div>
                     <button type="submit" class=" btn btn-danger text-white font-weight-bold text-xs "
                        style="margin-bottom: 0;" data-toggle="tooltip" data-original-title="Edit user"
                        onclick="alert('Bạn có muốn xóa không?')">
                        Delete
                     </button>
                  </div>
               </div>
            </div>

         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="modalCreated" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
   style="z-index:10000">
   <form method="post" action="<?php echo _WEB_ROOT . "/dashboard/hotel-create" ?>" class="modal-dialog modal-xl" style="
    height: 850px; overflow-y: scroll;" enctype="multipart/form-data">
      <div class="modal-content">
         <div class="modal-header ">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm khách sạn</h1>
            <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="mb-3">
               <label for="name" class="form-label">Tên khách sạn</label>
               <input type="text" class="form-control" id="name" name="name" value="">
            </div>
            <div class="mb-3">
               <label for="desc" class="form-label">Mô tả</label>
               <input type="text" class="form-control" id="desc" name="desc" value="">
            </div>

            <div class="mb-3">
               <label for="images" class="form-label d-block">Hình ảnh</label>
               <input type="file" class="form-control" id="imageCreate" name="image[]" value="" style="display: none"
                  multiple>
               <label for="imageCreate" style=" width: 200px;height: 200px;"
                  class=" d-flex justify-content-center align-items-center flex-column circle text-primary border border-2 rounded-2 position-relative">
                  <img src="<?php echo ASSET ?>/admin/img/upload-6699084_640.webp" id="previewImageBlog" alt=""
                     style="height: 100px; object-fit: cover;">
               </label>
               <div id="imagePreview" class="d-flex  gap-1 flex-wrap"></div>
               <script>
                  const imageInput = document.getElementById('imageCreate');
                  const imagePreview = document.getElementById('imagePreview');
                  imageInput.addEventListener('change', function() {
                     imagePreview.innerHTML = '';
                     const files = this.files;
                     if (files.length > 0) {
                        for (let i = 0; i < files.length; i++) {
                           const file = files[i];
                           const reader = new FileReader();
                           reader.onload = function(e) {
                              const img = document.createElement('img');
                              img.src = e.target.result;
                              img.style.maxWidth = '150px';
                              imagePreview.appendChild(img);
                           };
                           reader.readAsDataURL(file);
                        }
                     }
                  });
               </script>
            </div>
            <?php

            $hotelTypes = $data["hotelTypes"] ?? [];
            ?>
            <div class="mb-3">
               <label for="parent" class="form-label">Danh mục của khách sạn</label>
               <div class="dropdown">
                  <input class="form-control" type="text" value="" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                     aria-expanded="true" placeholder="Chọn danh mục" readonly />
                  <input type="hidden" name="category" class="parentId" value="">
                  <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1"
                     style="max-height: 250px;overflow-y:scroll">
                     <?php if (!empty($hotelTypes)) : ?>
                        <?php foreach ($hotelTypes as $item): ?>
                           <li><a class="dropdown-item" href="#"
                                 data-value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></li>
                        <?php endforeach; ?>
                     <?php endif; ?>
                  </ul>
               </div>
            </div>
            <?php

            $amenityCategories = $data["amenityCategories"] ?? [];
            ?>
            <div class="mb-3">
               <label for="parent" class="form-label">Danh mục của tiện ích</label>
               <div class="dropdown">
                  <input class="form-control" type="text" value="" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                     aria-expanded="true" placeholder="Chọn danh mục" readonly data-fetch-ajax="true" />
                  <input type="hidden" name="category" class="parentId  amenityCategory" value="">
                  <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1"
                     style="max-height: 250px;overflow-y:scroll">
                     <?php if (!empty($amenityCategories)) : ?>
                        <?php foreach ($amenityCategories as $item): ?>
                           <li><a class="dropdown-item" href="#"
                                 data-value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></li>
                        <?php endforeach; ?>
                     <?php endif; ?>
                  </ul>
               </div>
            </div>
            <div class="mb-3">
               <label for="price_range" class="form-label">Tiện ích của khách sạn</label>
               <input type="hidden" name="selected_amenities" id="selected_amenities" value="">
               <div class="amenity">
                  Vui lòng chọn Danh mục tiện ích trước
               </div>
               <div id="selected-amenities-list" style="margin-top: 10px;"></div>
               <style>
                  #selected-amenities-list {
                     display: flex;
                     align-items: center;
                     gap: 1rem;
                     flex-wrap: wrap;

                     div {
                        padding: 5px 10px;
                        border-radius: 20px;
                        border: 0.1rem solid rgb(45, 217, 223);
                        color: rgb(45, 217, 223);
                     }
                  }

                  .amenity-checkbox {
                     position: relative;
                     display: inline-flex;
                     align-items: center;
                     background: #f8f9fa;
                     border: 1px solid #dee2e6;
                     border-radius: 20px;
                     cursor: pointer;
                     user-select: none;
                     transition: background 0.2s, border-color 0.2s;
                     font-size: 14px;
                  }

                  .amenity-checkbox input[type="checkbox"] {
                     display: none;
                  }

                  .amenity-checkbox span {
                     padding: 5px 10px;
                     width: 100%;
                     height: 100%;
                     border-radius: 20px;
                     border: 0.1rem solid transparent;
                     transition: all 0.3s linear;
                  }

                  .amenity-checkbox input[type="checkbox"]:checked+span {
                     color: #fff;
                     background: rgb(45, 217, 223);
                     border-color: rgb(45, 217, 223);
                  }
               </style>
            </div>
            <div class="mb-3">
               <label for="price_range" class="form-label">Giá</label>
               <input type="text" class="form-control" id="price_range" name="price_range" value="">
            </div>
            <div class="mb-3">
               <label for="address" class="form-label">Địa chỉ</label>
               <input type="text" class="form-control" id="address" name="address" value="">
            </div>
            <div class="mb-3">
               <label for="city" class="form-label">Thành phố</label>
               <input type="text" class="form-control" id="city" name="city" placeholder="">
            </div>
            <div class="mb-3">
               <label for="country" class="form-label">Quốc gia</label>
               <input type="text" class="form-control" id="country" name="country" placeholder="">
            </div>
            <div class="mb-3">
               <label for="phone_number" class="form-label">Điện thoại</label>
               <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="">
            </div>
            <div class="mb-3">
               <label for="email" class="form-label">Email</label>
               <input type="text" class="form-control" id="email" name="email" placeholder="">
            </div>
            <div class="mb-3">
               <label for="rating" class="form-label">Số sao</label>
               <input type="text" class="form-control" id="rating" name="rating" placeholder="">
            </div>

            <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
               </button>
               <button type="submit" class="btn btn-primary">Tạo</button>
            </div>
         </div>
   </form>
</div>


<script>
   let selectedAmenities = [];
   document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll(".dropdown").forEach((dropdown) => {
         let input = dropdown.querySelector('input');
         let dropdownMenu = dropdown.querySelector(".dropdown-menu");
         let inputParent = dropdown.querySelector('.parentId');
         if (dropdownMenu) {
            dropdownMenu.addEventListener('click', (e) => {
               if (e.target.classList.contains('dropdown-item')) {
                  inputParent.value = e.target.dataset.value;
                  input.value = e.target.textContent;
                  if (input.dataset.fetchAjax === "true") {
                     fetchChildAmenities(inputParent.value);
                  }
               }
            });
         }
      });
   });

   function fetchChildAmenities(categoryId) {
      if (!categoryId) return;

      $.ajax({
         url: '<?php echo _WEB_ROOT ?>/dashboard/hotelAmenity/get-amenity-ajax',
         method: 'POST',
         dataType: 'json',
         data: {
            amenityCategoryId: categoryId,
            csrf_token: "<?php echo Session::get('csrf_token'); ?>"
         },
         success: function(res) {
            const data = res.data;
            if (res.type === 'success') {
               renderAmenities(data); // Không reset selectedAmenities nữa!
            }
         },
         error: function(xhr, status, error) {
            console.error('Có lỗi xảy ra:', error);
         }
      });
   }


   function renderAmenities(amenities) {
      const amenity = document.querySelector('.amenity');
      if (!amenity) return;

      amenity.innerHTML = '';

      if (amenities.length > 0) {
         amenities.forEach(item => {
            const label = document.createElement('label');
            label.classList.add('amenity-checkbox');

            const input = document.createElement('input');
            input.type = 'checkbox';
            input.value = item.id;
            input.dataset.name = item.name;

            const alreadySelected = selectedAmenities.find(a => a.id === item.id.toString());
            if (alreadySelected) {
               input.checked = true;
            }

            input.addEventListener('change', function() {
               if (this.checked) {
                  if (!selectedAmenities.some(a => a.id === this.value)) {
                     selectedAmenities.push({
                        id: this.value,
                        name: this.dataset.name
                     });
                  }
               } else {
                  selectedAmenities = selectedAmenities.filter(a => a.id !== this.value);
               }
               updateSelectedAmenities();
            });

            const span = document.createElement('span');
            span.textContent = item.name;

            label.appendChild(input);
            label.appendChild(span);

            amenity.appendChild(label);
         });
      } else {
         amenity.innerHTML = "Không có tiện ích con của danh mục này";
      }

      updateSelectedAmenities();
   }


   function updateSelectedAmenities() {
      const inputHidden = document.getElementById('selected_amenities');
      inputHidden.value = selectedAmenities.map(a => a.id).join(',');

      const list = document.getElementById('selected-amenities-list');
      list.innerHTML = '';

      selectedAmenities.forEach(a => {
         const div = document.createElement('div');
         div.classList.add('selected-amenity-item');
         div.textContent = a.name;
         list.appendChild(div);
      });
   }
</script>