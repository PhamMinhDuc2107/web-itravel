<div class="container-fluid py-4">
   <div class="row">
      <div class="col-12">
         <div class="card mb-4">
            <div class="card-header">
               <h3><?php echo $data["title"] ?? "" ?></h3>
               <?php if (Request::input("msg") !== null) : ?>
                  <span
                     class="<?php echo Request::input('type') === "error" ? "text-warning" : "text-success" ?> card-header"><?php echo htmlspecialchars(Request::input('msg')) ?></span>
               <?php endif; ?>
            </div>
            <?php $hotel = $data['hotel'] ?? [] ?>
            <div class="card-body">
               <form method="post" action="<?php echo _WEB_ROOT . "/dashboard/hotel-update-post" ?>" class=""
                  enctype="multipart/form-data">
                  <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                  <input type="hidden" name="id" value="<?php echo $hotel['id']; ?>">
                  <div class="mb-3">
                     <label for="name" class="form-label">Tên khách sạn</label>
                     <input type="text" class="form-control" id="name" name="name" value="<?php echo $hotel['name'] ?>">
                  </div>
                  <div class="mb-3">
                     <label for="description" class="form-label">Mô tả</label>
                     <input type="text" class="form-control" id="description" name="description"
                        value="<?php echo $hotel['description'] ?>">
                  </div>
                  <div class="mb-3">
                     <label for="phone_number" class="form-label">Điện thoại</label>
                     <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="<?php echo $hotel['phone_number'] ?>">
                  </div>
                  <div class="mb-3">
                     <label for="email" class="form-label">Email</label>
                     <input type="text" class="form-control" id="email" name="email"
                        value="<?php echo $hotel['email'] ?>">
                  </div>
                  <?php
                  $hotelTypes = $data["hotelTypes"] ?? [];
                  ?>
                  <div class="mb-3">
                     <label for="parent" class="form-label">Danh mục của tour</label>
                     <div class="dropdown">
                        <input class="form-control" type="text" value="<?php
                                                                        foreach ($data['hotelTypes'] as $item) {
                                                                           if ($item['id'] === $hotel['hotel_type_id']) {
                                                                              echo $item['name'];
                                                                           }
                                                                        }
                                                                        ?>" id="dropdownMenuButton1"
                           data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn danh mục" readonly />
                        <input type="hidden" name="category" class="parentId"
                           value="<?php echo $hotel['hotel_type_id'] ?>">
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1"
                           style="max-height: 250px;overflow-y:scroll">
                           <?php if (!empty($hotelTypes)) : ?>
                              <?php foreach ($hotelTypes as $item): ?>
                                 <li><a class="dropdown-item"
                                       data-value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></li>
                              <?php endforeach; ?>
                           <?php endif; ?>
                        </ul>
                     </div>
                  </div>
                  <div class="mb-3">
                     <label for="images" class="form-label d-block">Hình ảnh</label>
                     <input type="file" class="form-control" id="imageCreate" name="image[]" value=""
                        style="display: none" multiple>
                     <label for="imageCreate" style=" width: 200px;height: 200px;"
                        class=" d-flex justify-content-center align-items-center flex-column circle text-primary border border-2 rounded-2 position-relative">
                        <img src="<?php echo ASSET ?>/admin/img/upload-6699084_640.webp" id="previewImageBlog" alt=""
                           style="height: 100px; object-fit: cover;">
                     </label>
                     <div id="imagePreview" class="d-flex gap-1 flex-wrap">
                        <?php if ($data['imgs']): ?>
                           <?php foreach ($data['imgs'] as $img): ?>
                              <img src="<?php echo _WEB_ROOT . $img['image'] ?>" alt="<?php echo $tour['slug'] ?>"
                                 style="width:150px;">
                           <?php endforeach; ?>
                        <?php endif; ?>
                     </div>
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
                  $amenityCategories = $data['amenityCategories'] ?? [];
                  ?>
                  <div class="mb-3">
                     <label for="parent" class="form-label">Danh mục của tiện ích</label>
                     <div class="dropdown">
                        <input class="form-control" type="text" value="" id="dropdownMenuButton1"
                           data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn danh mục" readonly
                           data-fetch-ajax="true" />
                        <input type="hidden" name="category" class="parentId  amenityCategory" value="">
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1"
                           style="max-height: 250px;overflow-y:scroll">
                           <?php if (!empty($amenityCategories)) : ?>
                              <?php foreach ($amenityCategories as $item): ?>
                                 <li><a class="dropdown-item"
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
                     <label for="address" class="form-label">Địa chỉ</label>
                     <input type="text" class="form-control" id="address" name="address"
                        value="<?php echo $hotel['address'] ?>">
                  </div>
                  <div class="mb-3">
                     <label for="city" class="form-label">Thành phố</label>
                     <input type="text" class="form-control" id="city" name="city" placeholder=""
                        value="<?php echo $hotel['city'] ?>">
                  </div>
                  <div class="mb-3">
                     <label for="city" class="form-label">Quốc gia</label>
                     <input type="text" class="form-control" id="city" name="city" placeholder=""
                        value="<?php echo $hotel['city'] ?>">
                  </div>
                  <div class="mb-3">
                     <label for="rating" class="form-label">Số sao</label>
                     <input type="text" class="form-control" id="rating" name="rating" placeholder=""
                        value="<?php echo $hotel['rating'] ?>">
                  </div>


                  <div class="">
                     <button type="submit" class="btn btn-primary">Tạo</button>
                  </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>

<script>
   let selectedAmenities = <?php echo json_encode($data['hotelAmenities']); ?>;
   const container = document.getElementById("selected-amenities-list");
   if (Array.isArray(selectedAmenities) && selectedAmenities.length > 0) {
      updateSelectedAmenities()
   } else {
      container.innerHTML = "<em>Chưa có tiện ích nào được chọn.</em>";
   }
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
               renderAmenities(data);
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

            const alreadySelected = selectedAmenities.find(a => parseInt(a.id) === parseInt(item.id));
            if (alreadySelected) {
               input.checked = true;
            }

            input.addEventListener('change', function() {
               if (this.checked) {
                  if (!selectedAmenities.some(a => parseInt(a.id) === parseInt(this.value))) {
                     selectedAmenities.push({
                        id: this.value,
                        name: this.dataset.name
                     });
                  }
               } else {
                  selectedAmenities = selectedAmenities.filter(a => parseInt(a.id) !== parseInt(this.value));
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