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
                     <div id="froala-editor"><?php echo $data['tourNote']['content']?></div>
                     <input type="hidden" id="content" name="content">
                     <script>
                         const editor = new FroalaEditor('#froala-editor', {
                             height: 400,
                         });
                         document.getElementById('form-submit').addEventListener('submit', function (event) {
                             const content = editor.html.get();
                             document.getElementById('content').value = content;
                             console.log(content);
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