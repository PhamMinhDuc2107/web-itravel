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
               <?php $banner = $data['banner'] ?? [];
               ?>
                <div class="card-body">
                    <form method="post" class="form-update"
                          action="<?php echo _WEB_ROOT . "/dashboard/banner-update-post" ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề ảnh</label>
                            <input type="text" class="form-control" id="title" name="title"
                            aria-describedby="usernameHelp" value="<?php echo $banner['title'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Số thứ tự</label>
                            <input type="text" class="form-control" id="sort_order" name="sort_order"
                                   aria-describedby="usernameHelp" value="<?php echo $banner['sort_order'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label d-block">Hình ảnh</label>
                            <input type="file" class="form-control" id="imageCreateBlog" name="image"
                                   aria-describedby="usernameHelp" value="" style="display: none">
                            <label for="imageCreateBlog" style=" width: 250px;height: 250px;"
                                   class="d-flex justify-content-center align-items-center flex-column circle text-primary border border-2 rounded-2 position-relative">
                                <img src="<?php echo _WEB_ROOT . $banner['image'] ?>" id="previewImageBlog" alt=""
                                     style="height: 100%; width:100%; object-fit: cover;">
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Chọn</label>
                            <input type="radio" name="status"
                                   id="is_departure" <?php echo $banner['status'] === 0 ? "checked" : ""; ?> value="0">
                            <label for="is_departure" id="status" name="status"
                                   class="form-label badge badge-sm bg-gradient-secondary">
                                Inactive
                            </label>
                            <input type="radio" name="status"
                                   id="is_destination" <?php echo $banner['status'] === 1 ? "checked" : ""; ?> value="1">
                            <label for="is_destination" id="status" name="status"
                                   class="form-label badge badge-sm  bg-gradient-success">
                                Active
                            </label>
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                        <input type="hidden" value="<?php echo $banner['id'] ?>" name="id">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

