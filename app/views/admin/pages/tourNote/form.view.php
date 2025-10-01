<div class="container-fluid py-4">
   <div class="row">
      <div class="col-12">
         <div class="card mb-4">
            <div class="card-header">
               <h3>Chỉnh sửa thông tin</h3>
               <?php if(Request::input("msg") !== null) :?>
                  <span class="<?php echo Request::input('type') === "error"?"text-warning" :"text-success"?> card-header" style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg'))?></span>
               <?php endif;?>
            </div>
            <div class="card-body">
               <form id="form-submit" method="post" action="<?php echo _WEB_ROOT."/dashboard/tourNote-update-post"?>">
                  <input type="hidden" name="csrf_token" value="<?php echo Session::get("csrf_token")?>">
                  <input type="hidden" name="id" value="<?php echo $data['tourNote']['id'] ?? ""?>">
                  <div class="dropdown mb-3">
                     <input class="form-control formEdit"  type="text"
                            value="<?php foreach ($data['tours'] as $item) {
                               if($item['id'] === $data['tourNote']['tour_id']) {
                                  echo $item['name'];
                                  break;
                               }
                            } ?>"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true"/>
                     <input type="hidden" name="tour_id" class="parentId" >
                     <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                        <?php $tours = $data['tours']?>
                        <?php if(!empty($tours)) : ?>
                           <?php foreach ($tours as $item):?>
                              <li>
                                 <a class="dropdown-item" href="#" data-id="<?php echo$item['id']?>" data-value="<?php echo $item['name'] ?>">

                                    <?php echo$item['name']?></a>
                              </li>
                           <?php endforeach;?>
                        <?php endif;?>
                     </ul>
                  </div>
                  <div class="mb-3">
                     <label for="username" class="form-label">Ngày trong tour</label>
                     <input type="text" class="form-control" name="day_number" value="<?php echo $data['tourNote']['number'] ?? "";?>">
                  </div>
                  <div class="mb-3">
                     <label for="username" class="form-label">Tiêu đề</label>
                     <input type="text" class="form-control" name="title" value="<?php echo $data['tourNote']['title'] ?? "";?>">
                  </div>
                  <div class="mb-3">
                  <textarea class="tinymce" name="content">
                        <?php echo $data['tourNote']['content']?>
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
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
    let formEdit = document.querySelector('.formEdit');
    let inputParent = document.querySelector('.parentId');
    let inputValue = document.querySelector('#dropdownMenuButton1');
    let dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach((dropdownItem) => {
        dropdownItem.addEventListener('click', function (e) {
            let id =e.target.dataset.id;
            let value = e.target.dataset.value;
            inputValue.value = value;
            inputParent.value = id;
        })
    })
</script>