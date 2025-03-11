<div class="container-fluid py-4">
   <div class="row">
      <div class="col-12">
         <div class="card mb-4">
            <div class="card-header">
               <h3><?php echo $data["title"] ?? ""?></h3>
               <?php if(Request::input("msg") !== null) :?>
                  <span class="<?php echo Request::input('type') === "error"?"text-warning" :"text-success"?> card-header" style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg'))?></span>
               <?php endif;?>
            </div>
            <?php $blog = $data['blog'] ?? []?>
            <div class="card-body">
               <form method="post" class="form-update" action="<?php echo _WEB_ROOT."/dashboard/blog-update-post"?>" enctype="multipart/form-data">
                   <input type="hidden" name="id" value="<?php echo $blog['id'] ?>">
                  <div class="mb-3">
                     <label for="title" class="form-label">Tiêu đề tin tức</label>
                     <input type="text" class="form-control" id="title" name="title" aria-describedby="usernameHelp" value="<?php echo $blog['title']?>">
                  </div>
                  <div class="mb-3">
                     <label for="slug" class="form-label">Slug</label>
                     <input type="text" class="form-control" id="slug" name="slug" aria-describedby="usernameHelp" value="<?php echo $blog['slug']?>">
                  </div>
                  <div class="mb-3">
                     <label for="images" class="form-label d-block">Hình ảnh</label>

                      <input type="file" class="form-control" id="image" name="image" aria-describedby="usernameHelp" value="" style="display: none" accept="image/*">
                      <label for="image" style="width: 250px; height: 250px">
                          <img src="<?php echo _WEB_ROOT . $blog['thumbnail']  ?>" alt="<?php echo $blog['title'] ?>" class="img-fluid img-responsive img-thumbnail" style="width: 400px;" id="previewImage">
                      </label>
                  </div>
                  <?php
                  $admins = $data["admins"] ?? [];
                  $blogCategories = $data["blogCategories"] ?? [];
                  ?>
                  <div class="mb-3">
                     <label for="parent" class="form-label">Danh mục tin tức</label>
                     <div class="dropdown">
                        <input class="form-control" type="text" value="<?php echo $data['categoryName'] ?? ""?>"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" readonly/>
                        <input type="hidden" name="category_id" class="parentId" value="<?php echo $blog['category_id'] ?? ""?>">
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                           <?php if(!empty($blogCategories)) : ?>
                              <?php foreach ($blogCategories as $item):?>
                                 <li><a class="dropdown-item"data-value="<?php echo$item['id']?>"><?php echo$item['name']?></a></li>
                              <?php endforeach;?>
                           <?php endif;?>
                        </ul>
                     </div>
                  </div>
                  <div class="mb-3">
                     <label for="parent" class="form-label">Tác giả</label>
                     <div class="dropdown">
                        <input class="form-control" type="text" value="<?php echo $data['authorName'] ?? ""?>"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" readonly/>
                        <input type="hidden" name="author_id" class="parentId" value="<?php echo $blog['author_id'] ?>">
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                           <?php if(!empty($admins)) : ?>
                              <?php foreach ($admins as $item):?>
                                 <li><a class="dropdown-item" data-value="<?php echo$item['id']?>"><?php echo$item['username']?></a></li>
                              <?php endforeach;?>
                           <?php endif;?>
                        </ul>
                     </div>
                  </div>
                  <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                  <div id="froala-editor"><?php echo $blog['content']?></div>
                  <input type="hidden" id="content" name="content">
                   <script>
                       document.addEventListener('DOMContentLoaded', function() {
                           const editor = new FroalaEditor('#froala-editor', {
                               height: 400,
                               toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'insertLink', 'insertImage', 'insertTable', 'undo', 'redo'],
                           });
                           document.querySelector('.form-update').addEventListener('submit', function (event) {
                               const content = editor.html.get();
                               document.getElementById('content').value = content;
                           });
                       });
                   </script>
                  <div class="mt-3">
                     <label for="status" class="form-label">Trạng thái</label>
                     <input type="radio" name="status" id="createStatus" value="0" <?php echo $blog['status'] === 'draft' ? "checked" :""?>>
                     <label for="createStatus" id="status" name="status" class="form-label badge badge-sm bg-gradient-warning">
                        draft
                     </label>
                     <input type="radio" name="status" id="createPublished" value="1"  <?php echo $blog['status'] === 'published' ? "checked" :""?>>

                     <label for="createPublished" id="status" name="status" class="form-label badge badge-sm bg-gradient-success">
                        published
                     </label>
                     <input type="radio" name="status" id="createArchived" value="2"  <?php echo $blog['status'] === 'archived' ? "checked" :""?>>
                     <label for="createArchived" id="status" name="status" class="form-label badge badge-sm bg-gradient-secondary">
                        archived
                     </label>
                  </div>
                   <div class="mt-3">
                       <label for="hot" class="form-label">Tin tức hot</label>
                       <input type="checkbox" name="hot" id="hot" <?php echo  $blog['status_hot'] === 1  ? "checked" :""?>>
                       <label for="hot" id="hot" name="hot" class="form-label badge badge-sm bg-gradient-warning">
                           Hot
                       </label>
                   </div>
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
