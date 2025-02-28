<div class="container-fluid py-4">
   <div class="row">
      <div class="col-12">
         <div class="card mb-4">
            <div class="card-header">
               <h3>Chỉnh sửa thông tin admin</h3>
               <?php if(Request::input("msg") !== null) :?>
                  <span class="<?php echo Request::input('type') === "error"?"text-warning" :"text-success"?> card-header" style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg'))?></span>
               <?php endif;?>
            </div>
            <div class="card-body">
               <form method="post" action="<?php echo _WEB_ROOT."/dashboard/category-update-post"?>">
                  <input type="hidden" name="csrf_token" value="<?php echo Session::get("csrf_token")?>">
                  <input type="hidden" name="id" value="<?php echo $data['category']['id'] ?? ""?>">
                  <div class="mb-3">
                     <label for="username" class="form-label">Danh mục</label>
                     <input type="text" class="form-control" name="title" value="<?php echo $data['category']['name'] ?? "";?>">
                  </div>
                  <div class="dropdown mb-3">
                     <input class="form-control formEdit"  type="text"value="<?php echo $data['parent'] ?? "Không có danh mục cha"; ?>"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true"/>
                     <input type="hidden" name="parent" class="parentId" >
                     <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                        <?php $categories = $data['categories']?>
                        <?php if(!empty($categories)) : ?>
                           <?php foreach ($categories as $item):?>
                              <li>
                                 <a class="dropdown-item" href="#" data-id="<?php echo$item['id']?>" data-value="<?php echo $item['name'] ?>">

                                    <?php echo$item['name']?></a>
                              </li>
                           <?php endforeach;?>
                        <?php endif;?>

                     </ul>
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