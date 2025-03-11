<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo _WEB_ROOT . "/dashboard/tour-delete" ?>" method="post" class="">
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
                                        <li><a class="dropdown-item" data-value="asc" href="<?php echo Util::buildOrderByUrl()?>">Tăng dần</a></li>
                                        <li><a class="dropdown-item" data-value="desc" href="<?php echo Util::buildOrderByUrl("desc")?>">Giảm dần</a></li>
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
                                        <li><a class="dropdown-item" data-value="id" href="<?php echo Util::buildOrderColByUrl()?>">Sắp xếp theo ID</a></li>
                                        <li><a class="dropdown-item" data-value="title" href="<?php echo Util::buildOrderColByUrl("name")?>">Sắp xếp tên</a>
                                        </li>
                                        <li><a class="dropdown-item" data-value="slug" href="<?php echo Util::buildOrderColByUrl("status")?>">Sắp xếp trạng thái</a></li>
                                        <li><a class="dropdown-item" data-value="created_at" href="#">Sắp xếp theo Thời
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
                       <span class="<?php echo Request::input('type') === "error" ? "text-warning" : "text-success" ?> card-header"
                             style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg')) ?></span>
                   <?php endif; ?>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 min-vh-50">
                                <thead>
                                <tr>
                                    <th class="">
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-2">
                                        Tên
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-2">
                                        Slug
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                        Hình ảnh
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-2">
                                        Mô tả
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Khoảng thời gian
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                        Giá
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                        Địa điểm
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7col-1">
                                        Danh mục
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                        Trạng thái
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">
                                        Hot
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody class="table-body">
                                <?php
                                $tours = $data['tours'] ?? [];
                                ?>
                                <?php if (!empty($tours)) : ?>
                                   <?php foreach ($tours as $item): ?>
                                        <tr>
                                            <td class="text-center" style="width: 10px;">
                                                <input type="checkbox" name="id[]"
                                                       class="mx-auto input-checkbox"
                                                       value="<?php echo $item['id'] ?>"
                                                       style="width: 15px; height:15px"
                                                >
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
                                            <td class='col-1'>
                                                <div class="d-flex px-2 py-1">
                                                    <img src="<?php echo _WEB_ROOT . $item['image'] ?>"
                                                         alt="<?php echo $item['slug'] ?>" class="rounded-3"
                                                         style="width:95px; height: 95px;">
                                                </div>
                                            </td>
                                            <td class='col-3 '>
                                                <div class="d-flex px-2 py-1 overflow-hidden">
                                                    <div class="mb-0 text-sm hiddenText"><?php echo $item["description"] ?></div>
                                                </div>
                                            </td>
                                            <td class=''>
                                                <div class="px-2 py-1 text-center">
                                                    <div class="mb-0 text-sm"><?php echo $item["duration"] ?></div>
                                                </div>
                                            </td>
                                            <td class='col-1'>
                                                <div class="d-flex px-1 py-1 ">
                                                    <div class="mb-0 text-sm d-flex flex-column">
                                                        <span>Người lớn: <?php echo number_format($item["adult_price"], 2, '.', ','); ?></span>
                                                        <span>Người trẻ em: <?php echo number_format($item["child_price"], 2, '.', ','); ?></span>
                                                        <span>Người trẻ nhỏ: <?php echo number_format($item["infant_price"], 2, '.', ','); ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class='col-1'>
                                                <div class="d-flex px-1 py-1 ">
                                                    <div class="mb-0 text-sm d-flex flex-column">
                                                        <span>Khởi hành: <?php echo $item["departure_name"] ?></span>
                                                        <span>Điểm đến: <?php echo $item["destination_name"] ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class='col-1'>
                                                <div class="text-center">
                                                    <h6 class="mb-0 text-sm"><?php echo $item["category_name"] ?></h6>
                                                </div>
                                            </td>
                                            <td class='col-1 align-middle text-center'>
                                          <span class="mb-0 badge badge-sm <?php
                                          echo ($item['status'] === 'draft') ? "bg-gradient-warning" :
                                             (($item['status'] === 'active') ? "bg-gradient-success" : "bg-gradient-secondary");
                                          ?>
                                        "><?php echo $item["status"] ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">
                                    <i class='<?php echo $item["status_hot"] === 1 ? "fa-solid fa-circle-check" : "" ?>'
                                       style="display: block; font-size: 20px; color:#83f28f;"
                                    ></i>
                                    </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="<?php echo _WEB_ROOT . "/dashboard/tour-update/" . $item['id'] ?>"
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
               $totalPages = $data['totalPages'] ?? 1;
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
                    ">
                        <span class="d-block text-center dropdown-toggle limit" id="dropdownMenuButton1"
                              data-bs-toggle="dropdown" aria-expanded="true" >
                           <?php echo Request::input('limit') ?? 10 ?>
                        </span>
                        <ul class="dropdown-menu w-100 limit-options" aria-labelledby="dropdownMenuButton1" style="margin-top: 10px!important;">
                            <li><a class="dropdown-item limit-option" href="<?php echo Util::buildLimitUrl(10)?>">10</a></li>
                            <li><a class="dropdown-item limit-option" href="<?php echo Util::buildLimitUrl(25)?>">25</a></li>
                            <li><a class="dropdown-item limit-option" href="<?php echo Util::buildLimitUrl(50)?>">50</a></li>
                        </ul>
                    </div>
                    <ul class="pagination">
                        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="<?php echo Util::buildPageUrl(max(1, $page - 1)) ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                       <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                           <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                               <a class="page-link" href="<?php  echo Util::buildPageUrl($i); ?>"><?php echo $i; ?></a>
                           </li>
                       <?php endfor; ?>
                        <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="<?php echo Util::buildPageUrl(min($totalPages, $page + 1)); ?>" aria-label="Next">
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
    <form method="post" action="<?php echo _WEB_ROOT . "/dashboard/tour-create" ?>" class="modal-dialog modal-xl" style="
    height: 850px; overflow-y: scroll;" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header ">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm tour</h1>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên tour</label>
                    <input type="text" class="form-control" id="name" name="name" value="">
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="">
                </div>
                <div class="mb-3">
                    <label for="code_tour" class="form-label">Mã tour</label>
                    <input type="text" class="form-control" id="code_tour" name="code_tour" value="">
                </div>
                <div class="wrap-price">
                    <div class="mb-3 price-item gap-3 d-flex justify-content-between align-items-center">
                        <div class="col-11">
                            <div class="w-100">
                                <label for="desc" class="form-label">Ngày</label>
                                <input type="date" class="form-control flatpickr-input" id="desc" name="date[]" value=""
                                       placeholder="23-05-2023, 24-06-2024, ....">
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
                        <div class="btn-remove-price top-0 right-0 z-index-1 cursor-pointer">
                            <i class="fa fa-close  text-white rounded-circle bg-gradient-danger px-2  py-1 d-flex justify-content-center align-items-center"
                               style="width: 30px;height: 30px;pointer-events: none"></i>
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
                                <input type="text" class="form-control flatpickr-input" id="desc" name="date[]" value="" placeholder="23-05-2023, 24-06-2024, ....">
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

                    wrapPrice.addEventListener('click', function (e) {
                        if (e.target.closest('.btn-remove-price')) {
                            const priceItem = e.target.closest('.price-item');
                            if (priceItem) {
                                wrapPrice.removeChild(priceItem);
                            }
                        }
                    });

                    addButton.addEventListener('click', function (e) {
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
                    <input type="file" class="form-control" id="imageCreate" name="image[]" value=""
                           style="display: none" multiple>
                    <label for="imageCreate" style=" width: 200px;height: 200px;"
                           class=" d-flex justify-content-center align-items-center flex-column circle text-primary border border-2 rounded-2 position-relative">
                        <img src="<?php echo ASSET ?>/admin/img/upload-6699084_640.webp" id="previewImageBlog" alt=""
                             style="height: 100px; object-fit: cover;">
                    </label>
                    <div id="imagePreview" class="d-flex  gap-1 flex-wrap"></div>
                    <script>
                        const imageInput = document.getElementById('imageCreate');
                        const imagePreview = document.getElementById('imagePreview');
                        imageInput.addEventListener('change', function () {
                            imagePreview.innerHTML = '';
                            const files = this.files;
                            if (files.length > 0) {
                                for (let i = 0; i < files.length; i++) {
                                    const file = files[i];
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
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
                    <input type="text" class="form-control" id="duration" name="duration" value="">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Mô tả ngắn</label>
                    <input type="text" class="form-control" id="desc" name="desc" value="">
                </div>
               <?php
               $departures = $data["departures"] ?? [];
               $destinations = $data["destinations"] ?? [];
               $categories = $data["categories"] ?? [];
               ?>
                <div class="mb-3">
                    <label for="parent" class="form-label">Danh mục của tour</label>
                    <div class="dropdown">
                        <input class="form-control" type="text" value="" id="dropdownMenuButton1"
                               data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn danh mục" readonly/>
                        <input type="hidden" name="category" class="parentId" value="">
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1"
                            style="max-height: 250px;overflow-y:scroll">
                           <?php if (!empty($categories)) : ?>
                              <?php foreach ($categories as $item): ?>
                                   <li><a class="dropdown-item" href="#"
                                          data-value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></li>
                              <?php endforeach; ?>
                           <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="parent" class="form-label">Điểm khởi hành</label>
                    <div class="dropdown">
                        <input class="form-control" type="text" value="" id="dropdownMenuButton1"
                               data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn điểm khởi hành"
                               readonly/>
                        <input type="hidden" name="departure" class="parentId" value="">
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1"
                            style="max-height: 250px;overflow-y:scroll">
                           <?php if (!empty($departures)) : ?>
                              <?php foreach ($departures as $item): ?>
                                   <li><a class="dropdown-item" href="#"
                                          data-value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></li>
                              <?php endforeach; ?>
                           <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="parent" class="form-label">Điểm đến</label>
                    <div class="dropdown">
                        <input class="form-control" type="text" value="" id="dropdownMenuButton1"
                               data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn điểm đến" readonly/>
                        <input type="hidden" name="destination" class="parentId" value="">
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1"
                            style="max-height: 250px;overflow-y:scroll">
                           <?php if (!empty($destinations)) : ?>
                              <?php foreach ($destinations as $item): ?>
                                   <li><a class="dropdown-item" href="#"
                                          data-value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></li>
                              <?php endforeach; ?>
                           <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">

                <div class="mt-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <input type="radio" name="status" id="draft" value="0">
                    <label for="draft" id="status" name="status" class="form-label badge badge-sm bg-gradient-warning">
                        Draft
                    </label>
                    <input type="radio" name="status" id="createStatus" value="1">
                    <label for="createStatus" id="status" name="status"
                           class="form-label badge badge-sm bg-gradient-secondary">
                        Inactive
                    </label>
                    <input type="radio" name="status" id="createPublished" value="2">
                    <label for="createPublished" id="status" name="status"
                           class="form-label badge badge-sm bg-gradient-success">
                        Active
                    </label>
                </div>
                <div class="mt-3">
                    <label for="status_hot" class="form-label">Tour hot</label>
                    <input type="checkbox" name="status_hot" id="status_hot">
                    <label for="status_hot" id="status_hot" name="status"
                           class="form-label badge badge-sm bg-gradient-warning">
                        Hot
                    </label>
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


