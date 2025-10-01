<div class="container-fluid py-4">
   <div class="row">
      <div class="col-12">
         <form action="<?php echo _WEB_ROOT."/dashboard/tourNote-delete"?>" method="post" class="">
            <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
            <div class="card mb-4">
               <div class="d-flex justify-content-between align-items-center card-header pb-0">
                   <div class="d-flex justify-content-between col-2 col-md-2 gap-2 align-items-center">
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
                                   <li><a class="dropdown-item" data-value="username" href="<?php echo Util::buildOrderColByUrl("tour_id")?>">Sắp xếp theo tour</a>
                                   </li>
                                   <li><a class="dropdown-item" data-value="created_at" href="<?php echo Util::buildOrderColByUrl("created_at")?>">Sắp xếp theo Thời
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
                           <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-3">Tên tuor</th>
                           <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-3">STT</th>
                           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-3">Tiêu đề</th>
                           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 col-5">Nội dung</th>
                           <th class="text-secondary opacity-7"></th>
                        </tr>
                        </thead>
                        <tbody class="table-body">
                        <?php
                        $tourNotes = $data['tourNotes'] ??[];
                        ?>
                        <?php if(!empty($tourNotes)) : ?>
                           <?php foreach($tourNotes as $item): ?>
                              <tr>
                                 <td class= " text-center" style="width: 10px;">
                                    <input type="checkbox" name="id[]"
                                           class="mx-auto input-checkbox"
                                           value="<?php echo $item['id']?>"
                                           style="width: 15px; height:15px"
                                    >
                                 </td>
                                 <td>
                                    <div class="d-flex px-2 py-1">
                                       <div class="d-flex flex-column justify-content-center">
                                          <h6 class="mb-0 text-sm">
                                             <?php
                                                foreach ($data['tours'] as $tour) {
                                                   if($tour['id'] == $item['tour_id']) {
                                                      echo $tour['name'];
                                                      break;
                                                   }
                                                }
                                             ?>
                                          </h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="d-flex px-2 py-1">
                                       <div class="d-flex flex-column justify-content-center">
                                          <h6 class="mb-0 text-sm hiddenText"><?php echo $item["number"]?></h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="d-flex px-2 py-1">
                                       <div class="d-flex flex-column justify-content-center">
                                          <h6 class="mb-0 text-sm hiddenText"><?php echo $item["title"]?></h6>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="d-flex px-2 py-1">
                                       <div class="d-flex flex-column justify-content-center">
                                          <h6 class="mb-0 text-sm hiddenText"><?php echo $item["content"]?></h6>
                                       </div>
                                    </div>
                                 </td>

                                 <td class="align-middle text-center">
                                    <a href="<?php echo _WEB_ROOT."/dashboard/tourNote-update/".$item['id']?>" class="text-secondary font-weight-bold text-xs " style="margin-bottom: 0;"
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
<div class="modal modal-lg fade" id="modalCreated" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <form method="post" action="<?php echo _WEB_ROOT."/dashboard/tourNote-create"?>" class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm hành trình</h1>
            <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body" >
            <div class="mb-3">
               <label for="parent" class="form-label">Chọn tour</label>
               <div class="dropdown">
                  <input class="form-control" type="text" value=""  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" readonly/>
                  <input type="hidden" name="tour_id" class="parentId" value="">
                  <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                     <?php if(!empty($data['tours'])) : ?>
                        <?php foreach ($data['tours'] as $item):?>
                           <li><a class="dropdown-item" href="#" data-value="<?php echo$item['id']?>"><?php echo htmlspecialchars($item['name'])?></a></li>
                        <?php endforeach;?>
                     <?php endif;?>
                  </ul>
               </div>
            </div>
            <div class="mb-3">
               <label for="number" class="form-label">Số thứ tự</label>
               <input type="text" class="form-control" id="number" name="number" aria-describedby="usernameHelp" value="">
            </div>
            <div class="mb-3">
               <label for="title" class="form-label">Tiêu đề</label>
               <input type="text" class="form-control" id="title" name="title" aria-describedby="usernameHelp" value="">
            </div>
            <textarea class="tinymce" name="content">
                        Điền nội dung
                     </textarea>
                     <script>
                        const handlerProcessImage = (blobInfo, progress) => new Promise((resolve, reject) => {
                           const formData = new FormData();
                           formData.append('file', blobInfo.blob(), blobInfo.filename());
                           formData.append("csrf_token", "<?= Session::get("csrf_token")?>");

                           const xhr = new XMLHttpRequest();
                           xhr.open('POST', '<?php echo _WEB_ROOT ?>/dashboard/upload-image', true);

                           xhr.upload.onprogress = (e) => {
                                 if (e.lengthComputable && progress) {
                                    progress(e.loaded / e.total * 100);
                                 }
                           };

                           xhr.onload = () => {
                                 if (xhr.status < 200 || xhr.status >= 300) {
                                    reject('HTTP Error: ' + xhr.status);
                                    return;
                                 }

                                 let json;
                                 try {
                                    json = JSON.parse(xhr.responseText);
                                 } catch (err) {
                                    reject('Invalid JSON: ' + xhr.responseText);
                                    return;
                                 }

                                 if (json && typeof json.location === 'string') {
                                    resolve(json.location);
                                 } else {
                                    reject('Không nhận được đường dẫn ảnh.');
                                 }
                           };

                           xhr.onerror = () => {
                                 reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                           };

                           xhr.send(formData);
                        });

                        tinymce.init({
                           selector: '.tinymce',
                           plugins: [
                                 'advlist', 'anchor', 'autolink', 'autosave', 'charmap', 'code', 'codesample',
                                 'directionality', 'emoticons', 'fullscreen', 'help', 'image', 'importcss',
                                 'insertdatetime', 'link', 'lists', 'media', 'nonbreaking', 'pagebreak', 'preview',
                                 'print', 'quickbars', 'save', 'searchreplace', 'table', 'template', 'visualblocks',
                                 'visualchars', 'wordcount', 'checklist', 'mediaembed', 'casechange', 'formatpainter',
                                 'pageembed', 'a11ychecker', 'mentions', 'tableofcontents', 'footnotes',
                                 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown'
                           ],
                           toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | \
                           link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | \
                           emoticons charmap | removeformat | preview print fullscreen | code visualblocks visualchars | \
                           searchreplace a11ycheck typography markdown | insertdatetime template pagebreak',
                           height: 500,
                           relative_urls: false,
                           remove_script_host: false,
                           document_base_url: 'http://localhost/web-itravel/',
                           images_upload_handler: handlerProcessImage,
                           file_picker_callback: function (cb, value, meta) {
                                 if (meta.filetype === 'image') {
                                    var input = document.createElement('input');
                                    input.setAttribute('type', 'file');
                                    input.setAttribute('accept', 'image/*');

                                    input.onchange = function () {
                                       var file = this.files[0];
                                       var reader = new FileReader();
                                       reader.onload = function () {
                                             cb(reader.result, {title: file.name});
                                       };
                                       reader.readAsDataURL(file);
                                    };

                                    input.click();
                                 }
                           }
                        });
                     </script>
            <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
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
            if(dropdownMenu) {
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


