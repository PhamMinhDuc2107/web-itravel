<div class="container-fluid py-4">
   <div class="row">
      <div class="col-12">
         <div class="card mb-4">
            <div class="card-header">
               <h3><?php echo $data["title"] ?? ""?></h3>
               <?php if(Request::input("msg") !== null) :?>
                  <span class="<?php echo Request::input('type') === "error"?"text-warning" :"text-success"?> card-header"><?php echo htmlspecialchars(Request::input('msg'))?></span>
               <?php endif;?>
            </div>
            <?php $tour = $data['tour'] ?? []?>
            <div class="card-body">
                <form method="post" action="<?php echo _WEB_ROOT."/dashboard/tour-update-post"?>" class="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên tour</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $tour['name']?>">
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="<?php echo $tour['slug']?>">
                            </div>
                            <div class="mb-3">
                                <label for="code_tour" class="form-label">Mã tour</label>
                                <input type="text" class="form-control" id="code_tour" name="code_tour" value="<?php echo $tour['code_tour']?>">
                            </div>
                            <div class="wrap-price">
                                <div class="mb-3 price-item gap-3 d-flex justify-content-between align-items-center">
                                    <div class="col-11">
                                        <div class="w-100">
                                            <label for="desc" class="form-label">Ngày</label>
                                            <input type="date" class="form-control flatpickr-input" id="desc" name="date[]" value="" placeholder="Không muốn sửa giá thì để trống">
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center ">
                                            <div class="col-3">
                                                <label for="desc" class="form-label">Giá người lớn</label>
                                                <input type="text" class="form-control" id="desc" name="price_adult[]" value="">
                                            </div>
                                            <div class="col-3">
                                                <label for="desc" class="form-label">Giá trẻ em</label>
                                                <input type="text" class="form-control" id="desc" name="price_children[]" value="">
                                            </div>
                                            <div class="col-3">
                                                <label for="desc" class="form-label">Giá trẻ nhỏ </label>
                                                <input type="text" class="form-control" id="desc" name="price_baby[]" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-remove-price top-0 right-0 z-index-1 cursor-pointer" >
                                        <i class="fa fa-close  text-white rounded-circle bg-gradient-danger px-2  py-1 d-flex justify-content-center align-items-center" style="width: 30px;height: 30px;pointer-events: none"></i>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="" class="add-price btn btn-primary">Thêm giá vé</button>

                            <script>
                                const item = `
                    <div class="mb-3 price-item gap-3 d-flex justify-content-between align-items-center">
                        <div class="col-11">
                            <div class="w-100">
                                <label for="desc" class="form-label">Ngày</label>
                                <input type="text" class="form-control flatpickr-input" id="desc" name="date[]" value="" placeholder="Nếu muô sửa thì thêm còn không để trống">
                            </div>
                            <div class="d-flex justify-content-between align-items-center ">
                                <div class="col-3">
                                    <label for="desc" class="form-label">Giá người lớn</label>
                                    <input type="text" class="form-control" id="desc" name="price_adult[]" value="">
                                </div>
                                <div class="col-3">
                                    <label for="desc" class="form-label">Giá trẻ em</label>
                                    <input type="text" class="form-control" id="desc" name="price_children[]" value="">
                                </div>
                                <div class="col-3">
                                    <label for="desc" class="form-label">Giá trẻ nhỏ </label>
                                    <input type="text" class="form-control" id="desc" name="price_baby[]" value="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-remove-price top-0 right-0 z-index-1 cursor-pointer" >
                            <i class="fa fa-close  text-white rounded-circle bg-gradient-danger px-2  py-1 d-flex justify-content-center align-items-center" style="width: 30px;height: 30px;pointer-events: none"></i>
                        </div>
                    </div>
                    `;
                                const wrapPrice = document.querySelector('.wrap-price');
                                const addButton = document.querySelector('.add-price');

                                wrapPrice.addEventListener('click', function(e) {
                                    if (e.target.closest('.btn-remove-price')) {
                                        const priceItem = e.target.closest('.price-item');
                                        if (priceItem) {
                                            wrapPrice.removeChild(priceItem);
                                        }
                                    }
                                });

                                addButton.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    wrapPrice.insertAdjacentHTML("beforeend", item);
                                    initNewFlatpickr();
                                });

                                function initNewFlatpickr() {
                                    const newFlatpickrInput = wrapPrice.lastElementChild.querySelector(".flatpickr-input");
                                    if (newFlatpickrInput) {
                                        flatpickr(".flatpickr-input", {
                                            mode: "multiple",
                                            dateFormat: "Y-m-d",
                                            minDate: new Date(),
                                        });
                                    }
                                }

                                flatpickr(".flatpickr-input", {
                                    mode: "multiple",
                                    dateFormat: "Y-m-d",
                                    minDate: new Date(),
                                });
                            </script>
                            <div class="mb-3">
                                <label for="images" class="form-label d-block">Hình ảnh</label>
                                <input type="file" class="form-control" id="imageCreate" name="image[]"value="" style="display: none" multiple>
                                <label for="imageCreate" style=" width: 200px;height: 200px;"  class=" d-flex justify-content-center align-items-center flex-column circle text-primary border border-2 rounded-2 position-relative">
                                    <img src="<?php echo ASSET?>/admin/img/upload-6699084_640.webp" id="previewImageBlog" alt="" style="height: 100px; object-fit: cover;">
                                </label>
                                <div id="imagePreview" class="d-flex gap-1 flex-wrap">
                                    <?php if($data['imgs']):?>
                                    <?php foreach($data['imgs'] as $img):?>
                                            <img src="<?php echo _WEB_ROOT.$img['image']?>" alt="<?php echo $tour['slug']?>" style="width:150px;">
                                    <?php endforeach;?>
                                    <?php endif;?>
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
                            <div class="mb-3">
                                <label for="duration" class="form-label">Tour trong bao nhiêu ngày</label>
                                <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $tour['duration']?>">
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Điểm tham quan</label>
                                <input type="text" class="form-control" id="destinations" name="destinations" placeholder="Hà Nội, Trung Quốc,..." value="<?php echo $tour['destinations']?>">
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Ẩm thực</label>
                                <input type="text" class="form-control" id="meals" name="meals" placeholder="Buffet sáng, Theo thực đơn, Đặc sản địa phương,..."
                                value="<?php echo $tour['meals']?>">
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Đối tượng thích hợp</label>
                                <input type="text" class="form-control" id="suitable_for" name="suitable_for" placeholder="Người lớn tuổi, Cặp đôi, Gia đình nhiều thế hệ, Thanh niên, Trẻ em,..." value="<?php echo $tour['suitable_for']?>">
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Thời gian lý tưởng</label>
                                <input type="text" class="form-control" id="ideal_time" name="ideal_time" placeholder="Quanh năm, Mùa thu,..." value="<?php echo $tour['ideal_time']?>">
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Phương tiện</label>
                                <input type="text" class="form-control" id="transportation" name="transportation" placeholder="flight,bus,car,train,..." value="<?php echo $tour['transportation']?>">
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Khuyến mãi</label>
                                <input type="text" class="form-control" id="promotion" name="promotion" placeholder="Đã ưu đãi trực tiếp vào giá tour" value="<?php echo $tour['promotion']?>">
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Mô tả ngắn</label>
                                <input type="text" class="form-control" id="desc" name="desc" value="<?php echo $tour['description']?>">
                            </div>
                           <?php
                           $locations = $data["locations"] ?? [];
                           $categories = $data["categories"] ?? [];
                           ?>
                            <div class="mb-3">
                                <label for="parent" class="form-label">Danh mục của tour</label>
                                <div class="dropdown">
                                    <input class="form-control" type="text" value="<?php
                                        foreach ($data['categories'] as $category) {
                                            if($category['id'] === $tour['category_id']){
                                                echo $category['name'];
                                            }
                                        }
                                    ?>"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn danh mục" readonly/>
                                    <input type="hidden" name="category" class="parentId" value="<?php echo $tour['category_id']?>">
                                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                                       <?php if(!empty($categories)) : ?>
                                          <?php foreach ($categories as $item):?>
                                               <li><a class="dropdown-item"  data-value="<?php echo$item['id']?>"><?php echo$item['name']?></a></li>
                                          <?php endforeach;?>
                                       <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="parent" class="form-label">Điểm khởi hành</label>
                                <div class="dropdown">
                                    <input class="form-control" type="text"
                                           value="<?php
                                   foreach ($locations as $location) {
                                      if($location['id'] === $tour['departure_id']){
                                         echo $location['name'];
                                      }
                                   }
                                   ?>"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn điểm khởi hành" readonly/>
                                    <input type="hidden" name="departure" class="parentId" value="<?php echo $tour['departure_id']?>">
                                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                                       <?php if(!empty($locations)) : ?>
                                          <?php foreach ($locations as $item):?>
                                               <?php if($item["is_departure"] === 1):?>
                                                   <li><a class="dropdown-item"  data-value="<?php echo$item['id']?>"><?php echo$item['name']?></a></li>
                                               <?php endif;?>
                                          <?php endforeach;?>
                                       <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="parent" class="form-label">Điểm đến</label>
                                <div class="dropdown">
                                    <input class="form-control" type="text"
                                           value="<?php
                                   foreach ($locations as $location) {
                                      if($location['id'] === $tour['destination_id']){
                                         echo $location['name'];
                                      }
                                   }
                                   ?>"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn điểm đến" readonly/>
                                    <input type="hidden" name="destination" class="parentId" value="<?php echo $tour['destination_id']?>">
                                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                                       <?php if(!empty($locations)) : ?>
                                          <?php foreach ($locations as $item):?>
                                             <?php if($item["is_destination"] === 1):?>
                                                   <li><a class="dropdown-item" data-value="<?php echo$item['id']?>"><?php echo$item['name']?></a></li>
                                             <?php endif;?>
                                          <?php endforeach;?>
                                       <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                            <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                            <input type="hidden" name="id" value="<?php echo $tour['id']; ?>">
                            <div class="mt-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <input type="radio" name="status" id="draft" value="0" <?php echo $tour['status'] === "draft" ? "checked" :""?>>
                                <label for="draft" id="status" name="status" class="form-label badge badge-sm bg-gradient-warning">
                                    Draft
                                </label>
                                <input type="radio" name="status" id="createStatus" value="1" <?php echo $tour['status'] === "inactive" ? "checked" :""?>>
                                <label for="createStatus" id="status" name="status" class="form-label badge badge-sm bg-gradient-secondary">
                                    Inactive
                                </label>
                                <input type="radio" name="status" id="createPublished" value="2" <?php echo  $tour['status'] === "active" ? "checked" :""?>>
                                <label for="createPublished" id="status" name="status" class="form-label badge badge-sm bg-gradient-success">
                                    Active
                                </label>
                            </div>
                            <div class="mt-3">
                                <label for="status_hot" class="form-label">Tour hot</label>
                                <input type="checkbox" name="status_hot" id="status_hot" <?php echo  $tour['status_hot'] === 1  ? "checked" :""?>>
                                <label for="status_hot" id="status_hot" name="status" class="form-label badge badge-sm bg-gradient-warning">
                                    Hot
                                </label>
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
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll(".dropdown").forEach((dropdown) => {
            let input = dropdown.querySelector('input');
            let dropdownMenu = dropdown.querySelector(".dropdown-menu");
            let inputParent = dropdown.querySelector('.parentId');
            if (dropdownMenu) {
                dropdownMenu.addEventListener('click', (e) => {
                    if (e.target.classList.contains('dropdown-item')) {
                        inputParent.value = e.target.dataset.value;
                        input.value = e.target.textContent;
                    }
                });
            }
        });
    })
</script>
