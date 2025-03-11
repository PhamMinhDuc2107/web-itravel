<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3><?php echo $data["title"] ?? "" ?></h3>
                   <?php if (Request::input("msg") !== null) : ?>
                       <span class="<?php echo Request::input('type') === "error" ? "text-warning" : "text-success" ?> card-header"
                             style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg')) ?></span>
                   <?php endif; ?>
                </div>
               <?php $location = $data['location'] ?? [] ?>
                <div class="card-body">
                    <form method="post" class="form-update"
                          action="<?php echo _WEB_ROOT . "/dashboard/location-update-post" ?>"
                          enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tên địa điểm</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   aria-describedby="usernameHelp" value="<?php echo $location['name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Mô tả</label>
                            <textarea type="text" class="form-control " id="description" name="description"
                                      aria-describedby="usernameHelp"
                                      style="height: 100px;"> <?php echo $location['description'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label d-block">Hình ảnh</label>
                            <input type="file" class="form-control" id="imageCreateBlog" name="image"
                                   aria-describedby="usernameHelp" value="" style="display: none">
                            <label for="imageCreateBlog" style=" width: 250px;height: 250px;"
                                   class="d-flex justify-content-center align-items-center flex-column circle text-primary border border-2 rounded-2 position-relative">
                                <img src="<?php echo _WEB_ROOT . $location['image'] ?>" id="previewImageBlog" alt=""
                                     style="height: 100%; width:100%; object-fit: cover;">
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="parent" class="form-label">Danh mục</label>
                            <div class="dropdown">
                                <input class="form-control" type="text" value="<?php echo  $data['category']['name']  ?>"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn danh mục" readonly/>
                                <input type="hidden" name="category" class="parentId" value="<?php echo  $data['category']['id']  ?>">
                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                                   <?php if(!empty($data['categories'])) : ?>
                                      <?php foreach ($data['categories'] as $item):?>
                                           <li><a class="dropdown-item" data-value="<?php echo$item['id']?>"><?php echo $item['name']?></a></li>
                                      <?php endforeach;?>
                                   <?php endif;?>
                                </ul>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="display_home" class="form-label">Hiển thị ở trang home</label>
                            <input type="text" class="form-control" id="display_home" name="display_home" aria-describedby="usernameHelp" value="<?php echo $item['display_home']?>" placeholder="Chọn số từ 1->">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Chọn</label>

                            <input type="checkbox" name="is_departure"
                                   id="is_departure" <?php echo $location['is_departure'] == 1 ? "checked" : ""; ?>>
                            <label for="is_departure" id="status" name="is_departure"
                                   class="form-label badge badge-sm bg-gradient-success">
                                Là điểm khởi hành
                            </label>
                            <input type="checkbox" name="is_destination"
                                   id="is_destination" <?php echo $location['is_destination'] == 1 ? "checked" : ""; ?>>
                            <label for="is_destination" id="status" name="is_destination"
                                   class="form-label badge badge-sm bg-gradient-secondary">
                                Là điểm đến
                            </label>
                        </div>
                        <div class="mt-3">
                            <label for="hot" class="form-label">Điểm đến hot</label>
                            <input type="checkbox" name="hot" id="hot" <?php echo  $location['hot'] === 1  ? "checked" :""?>>
                            <label for="hot" id="hot" name="hot" class="form-label badge badge-sm bg-gradient-warning">
                                Hot
                            </label>
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                        <input type="hidden" value="<?php echo $location['id'] ?>" name="id">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
