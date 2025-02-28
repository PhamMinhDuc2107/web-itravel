<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo _WEB_ROOT . "/dashboard/banner-delete" ?>" method="post" class="">
                <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between align-items-center card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center gap-1">
                                <span>Sắp xếp:</span>
                                <div class="dropdown"
                                     style="
                                     height: 30px;
                                     line-height: 30px;
                                     padding: 0 10px;
                                     border-radius: 10px;
                                     border: 1px solid #dee2e6;
                                     margin-right: 10px;
                                     border-radius: 10px;

                                ">
                                    <span class="d-block text-center" type="text" value="" id="dropdownMenuButton1"
                                          data-bs-toggle="dropdown" aria-expanded="true">
                                        <?php echo Request::input('sortBy') ?? "asc" ?>
                                    </span>
                                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="
                                        margin-top: 10px!important;">
                                        <li><a class="dropdown-item" href="<?php echo Util::buildOrderByUrl() ?>">Tăng
                                                dần</a></li>
                                        <li><a class="dropdown-item" href="<?php echo Util::buildOrderByUrl("desc") ?>">Giảm
                                                dần</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-1">
                                <span>Cột:</span>
                                <div class="dropdown"
                                     style="
                                     height: 30px;
                                     line-height: 30px;
                                     padding: 0 10px;
                                     border-radius: 10px;
                                     border: 1px solid #dee2e6;
                                     margin-right: 10px;
                                     border-radius: 10px;
                                ">
                                    <span class="d-block text-center" type="text" value="" id="dropdownMenuButton1"
                                          data-bs-toggle="dropdown" aria-expanded="true">
                                        <?php echo Request::input('sortCol') ?? "id" ?>
                                    </span>
                                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="
                                        margin-top: 10px!important;">
                                        <li><a class="dropdown-item"
                                               href="<?php echo Util::buildOrderColByUrl("id"); ?>">Sắp xếp theo id</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                               href="<?php echo Util::buildOrderColByUrl("name") ?>">Sắp xếp theo
                                                tên</a></li>
                                        <li><a class="dropdown-item"
                                               href="<?php echo Util::buildOrderColByUrl("slug") ?>">Sắp xếp theo
                                                slug</a></li>
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
                       <span class="<?php echo Request::input('type') === "error" ? "text-warning" : "text-success" ?> card-header"
                             style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg')) ?></span>
                   <?php endif; ?>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="">
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        image
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tiêu đề ảnh
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Vị trí của ảnh
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $banners = $data['banners'] ?? [];
                                ?>
                                <?php if (!empty($banners)) : ?>
                                   <?php foreach ($banners as $item): ?>
                                        <tr>
                                            <td class=" text-center" style="width: 10px;">
                                                <input type="checkbox" name="id[]"
                                                       class="mx-auto"
                                                       value="<?php echo $item['id'] ?>"
                                                       style="width: 15px; height:15px"
                                                >
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center" style="width: 150px;">
                                                        <img src="<?php echo _WEB_ROOT.$item["image"] ?>"
                                                             alt="<?php echo $item["title"] ?>">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?php echo $item["title"] ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center text-center">
                                                    <h6 class="mb-0 text-sm"><?php echo $item["status"] ?></h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center text-center">
                                                    <h6 class="mb-0 text-sm"><?php echo $item["sort_order"] ?></h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="<?php echo _WEB_ROOT . "/dashboard/banner-update/" . $item['id'] ?>"
                                                   class="text-secondary font-weight-bold text-xs "
                                                   style="margin-bottom: 0;"
                                                   id="btnEdit"
                                                >
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
               $totalPages = $data['totalPages'] ?? 0;
               ?>
                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end"
                     style="border-radius: 10px">
                    <span>Items per page:</span>
                    <div class="dropdown"
                         style="
                         height: 30px;
                         line-height: 30px;
                         padding: 0 15px;
                         border-radius: 10px;
                         border: 1px solid #dee2e6;
                         margin-right: 10px;
                         border-radius: 10px;
                    ">
                        <span class="d-block text-center" type="text" value="" id="dropdownMenuButton1"
                              data-bs-toggle="dropdown" aria-expanded="true">
                            <?php echo Request::input('limit') ?? 10 ?>
                        </span>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="
                        margin-top: 10px!important;">
                            <li><a class="dropdown-item" href="<?php echo Util::buildLimitUrl(10) ?>">10</a></li>
                            <li><a class="dropdown-item" href="<?php echo Util::buildLimitUrl(25) ?>">25</a></li>
                            <li><a class="dropdown-item" href="<?php echo Util::buildLimitUrl(50) ?>">50</a></li>
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
                <div class="footer-function gap-2 mt-2 p-2 position-relative bottom-0 bg-white">
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
                                    onclick="alert('Bạn có muốn xóa tài khoản này không?')">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCreated" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?php echo _WEB_ROOT . "/dashboard/banner-create" ?>" class="modal-dialog"
          enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Banner</h1>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề ảnh</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="usernameHelp"
                           value="">
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label d-block">Hình ảnh</label>
                    <input type="file" class="form-control" id="imageCreateBlog" name="image"
                           aria-describedby="usernameHelp" value="" style="display: none">
                    <label for="imageCreateBlog" style=" width: 250px;height: 250px;"
                           class="d-flex justify-content-center align-items-center flex-column circle text-primary border border-2 rounded-2 position-relative">
                        <img src="<?php echo ASSET ?>/admin/img/upload-6699084_640.webp" id="previewImageBlog" alt=""
                             style="height: 100px; object-fit: cover;">
                    </label>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Chọn</label>
                    <input type="radio" name="is_departure" id="is_departure">
                    <label for="is_departure" id="status" name="status" value="0"
                           class="form-label badge badge-sm bg-gradient-secondary">
                        Inactive
                    </label>
                    <input type="radio" name="is_destination" id="is_destination">
                    <label for="is_destination" id="status" name="status" value="1"
                           class="form-label badge badge-sm bg-gradient-success">
                        Active
                    </label>
                </div>
                <div class="mb-3">
                    <label for="order" class="form-label">Vị trí của ảnh</label>
                    <input type="text" class="form-control" id="order" name="order" aria-describedby="usernameHelp"
                           value="">
                </div>

                <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                >Close
                </button>
                <button type="submit" class="btn btn-primary">Tạo</button>
            </div>
        </div>
    </form>

</div>


