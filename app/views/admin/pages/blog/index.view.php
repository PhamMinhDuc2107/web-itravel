<div class="container-fluid py-4">
   <div class="row">
      <div class="col-12">
         <form action="<?php echo _WEB_ROOT."/dashboard/blog-delete"?>" method="post" class="">
            <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
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
                    <button type="button" class=" btn btn-primary  text-white font-weight-bold text-xs " style="margin-bottom: 0;" data-bs-toggle="modal" data-bs-target="#modalCreated">
                        Thêm mới
                    </button>
                </div>
               <?php if(Request::input("msg") !== null) :?>
                  <span class="<?php echo Request::input('type') === "error"?"text-warning" :"text-success"?> card-header" style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg'))?></span>
               <?php endif;?>
               <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                     <table class="table align-items-center mb-0 min-vh-50">
                        <thead>
                        <tr>
                           <th class="">
                           </th>
                           <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-2">Tiêu đề</th>
                           <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-2">slug</th>
                           <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">hình ảnh</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-3">nội dung</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity- col-1">danh mục</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7col-1">tác giả</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7col-1">Hot</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-1">trạng thái</th>
                           <th class="text-secondary opacity-7"></th>
                        </tr>
                        </thead>
                        <tbody class="table-body">
                        <?php
                        $blogs = $data['blogs'] ??[];
                        ?>
                        <?php if(!empty($blogs)) : ?>
                           <?php foreach($blogs as $item): ?>
                              <tr>
                                 <td class= "text-center" style="width: 10px;">
                                    <input type="checkbox" name="id[]"
                                           class="mx-auto input-checkbox"
                                           value="<?php echo $item['id']?>"
                                           style="width: 15px; height:15px"
                                    >
                                 </td>
                                 <td class ='col-2'>
                                    <div class="d-flex px-2 py-1">
                                          <h6 class="mb-0 text-sm hiddenText"><?php echo $item["title"]?></h6>
                                    </div>
                                 </td>
                                  <td class ='col-2'>
                                      <div class="d-flex px-2 py-1">
                                              <h6 class="mb-0 text-sm hiddenText"><?php echo $item["slug"]?></h6>
                                      </div>
                                  </td>
                                  <td class ='col-1'>
                                      <div class="d-flex px-2 py-1">
                                              <img src="<?php echo _WEB_ROOT."/".$item["thumbnail"]?>" alt="<?php echo $item['slug']?>" class="rounded-3" style="width:95px; height: 95px;">
                                      </div>
                                  </td>
                                  <td class ='col-3 '>
                                      <div class="d-flex px-2 py-1 overflow-hidden" style="height: 62px;">
                                          <div class="mb-0 text-sm hiddenText"><?php echo $item["content"]?></div>
                                      </div>
                                  </td>
                                  <td class ='col-1'>
                                      <div class="d-flex px-2 py-1">
                                          <div class="d-flex flex-column justify-content-center">
                                              <h6 class="mb-0 text-sm"><?php echo $item["category_name"]?></h6>
                                          </div>
                                      </div>
                                  </td>
                                  <td class ='col-1'>
                                      <div class="d-flex px-2 py-1">
                                          <div class="d-flex flex-column justify-content-center">
                                              <h6 class="mb-0 text-sm"><?php echo $item["admin_username"]?></h6>
                                          </div>
                                      </div>
                                  </td>
                                  <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                <i class='<?php echo $item["hot"] === 1 ? "fa-solid fa-circle-check" : "" ?>'
                                                   style="display: block; font-size: 20px; color:#83f28f;"
                                                ></i>
                                                </span>
                                  </td>
                                  <td class="align-middle text-center text-sm">
                                      <span class="badge badge-sm
                                      <?php
                                      echo ($item['status'] === 'draft') ? "bg-gradient-warning" :
                                         (($item['status'] === 'published') ? "bg-gradient-success" : "bg-gradient-secondary");

                                      ?>
                                        ">
                                         <?php echo $item['status']?>
                                      </span>
                                  </td>
                                 <td class="align-middle text-center">
                                    <a href="<?php echo _WEB_ROOT."/dashboard/blog-update/".$item['id']?>" class="text-secondary font-weight-bold text-xs " style="margin-bottom: 0;"
                                       id="btnEdit"
                                    >
                                       Edit
                                    </a>

                                 </td>
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
            <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end" style="border-radius: 10px">
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
                        <li><a class="dropdown-item limit-option" data-value="10" href="<?php echo Util::buildLimitUrl(10)?>">10</a></li>
                        <li><a class="dropdown-item limit-option" data-value="25" href="<?php echo Util::buildLimitUrl(25)?>">25</a></li>
                        <li><a class="dropdown-item limit-option" data-value="50" href="<?php echo Util::buildLimitUrl(50)?>">50</a></li>
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
            <div class="footer-function gap-2 mt-2 p-2 position-relative bottom-0 bg-white d-none">
               <div class="d-flex justify-content-between align-items-center w-100">
                  <div class="footer-text w-25 d-flex gap-2 align-items-center">
                     <span class="footer-text-content"></span> selected
                     <span class="footer-btn d-flex justify-content-center align-items-center rounded-circle" style="width: 20px; height: 20px">
                                <i class="fa fa-close " style="width: 100%; height: 100%;"></i>
                            </span>
                  </div>
                  <div>
                     <button type="submit" class=" btn btn-danger text-white font-weight-bold text-xs " style="margin-bottom: 0;" data-toggle="tooltip" data-original-title="Edit user"
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
<div class="modal fade" id="modalCreated" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:10000">
   <form method="post" action="<?php echo _WEB_ROOT."/dashboard/blog-create"?>" class="modal-dialog modal-xl" style="
    height: 850px; overflow-y: scroll;" enctype="multipart/form-data">
       <div class="modal-content">
         <div class="modal-header ">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm tin tức</h1>
            <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body" >
            <div class="mb-3">
               <label for="title" class="form-label">Tiêu đề tin tức</label>
               <input type="text" class="form-control" id="title" name="title" aria-describedby="usernameHelp" value="">
            </div>
             <div class="mb-3">
                 <label for="slug" class="form-label">Slug</label>
                 <input type="text" class="form-control" id="slug" name="slug" aria-describedby="usernameHelp" value="">
             </div>
             <div class="mb-3">
                 <label for="images" class="form-label d-block">Hình ảnh</label>
                 <input type="file" class="form-control" id="imageCreateBlog" name="image" aria-describedby="usernameHelp" value="" style="display: none">
                 <label for="imageCreateBlog" style=" width: 250px;height: 250px;" class="d-flex justify-content-center align-items-center flex-column circle text-primary border border-2 rounded-2 position-relative">
                     <img src="<?php echo ASSET?>/admin/img/upload-6699084_640.webp" id="previewImageBlog" alt="" style="height: 100px; object-fit: cover;">
                 </label>
             </div>
            <?php
            $admins = $data["admins"] ?? [];
            $blogCategories = $data["blogCategories"] ?? [];
            ?>
             <div class="mb-3">
                 <label for="parent" class="form-label">Danh mục tin tức</label>
                 <div class="dropdown">
                     <input class="form-control" type="text" value=""  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn danh mục" readonly/>
                     <input type="hidden" name="category_id" class="parentId" value="">
                     <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                        <?php if(!empty($blogCategories)) : ?>
                           <?php foreach ($blogCategories as $item):?>
                                <li><a class="dropdown-item" href="#" data-value="<?php echo$item['id']?>"><?php echo$item['name']?></a></li>
                           <?php endforeach;?>
                        <?php endif;?>
                     </ul>
                 </div>
             </div>
             <div class="mb-3">
                 <label for="parent" class="form-label">Tác giả</label>
                 <div class="dropdown">
                     <input class="form-control" type="text" value=""  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" placeholder="Chọn tác giả" readonly/>
                     <input type="hidden" name="author_id" class="parentId" value="">
                     <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                        <?php if(!empty($admins)) : ?>
                           <?php foreach ($admins as $item):?>
                                <li><a class="dropdown-item" href="#" data-value="<?php echo$item['id']?>"><?php echo$item['username']?></a></li>
                           <?php endforeach;?>
                        <?php endif;?>
                     </ul>
                 </div>
             </div>

            <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
             <div id="froala-editor"></div>
             <input type="hidden" id="content" name="content">
             <script>
                 const editor = new FroalaEditor('#froala-editor', {
                     height: 400,
                 });
                 document.getElementById('modalCreated').addEventListener('submit', function (event) {
                     const content = editor.html.get();
                     document.getElementById('content').value = content;
                 });
             </script>
             <div class="mt-3">
                 <label for="status" class="form-label">Trạng thái</label>
                 <input type="radio" name="status" id="createStatus" value="0">
                 <label for="createStatus" id="status" name="status" class="form-label badge badge-sm bg-gradient-warning">
                     draft
                 </label>
                 <input type="radio" name="status" id="createPublished" value="1">

                 <label for="createPublished" id="status" name="status" class="form-label badge badge-sm bg-gradient-success">
                     published
                 </label>
                 <input type="radio" name="status" id="createArchived" value="2">
                 <label for="createArchived" id="status" name="status" class="form-label badge badge-sm bg-gradient-secondary">
                     archived
                 </label>
             </div>
             <div class="mt-3">
                 <label for="hot" class="form-label">Địa điểm hot</label>
                 <input type="checkbox" name="hot" id="hot">
                 <label for="hot" id="hot" name="hot"
                        class="form-label badge badge-sm bg-gradient-warning">
                     Hot
                 </label>
             </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
            >Close</button>
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
