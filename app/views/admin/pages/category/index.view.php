<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <button type="button" class=" btn btn-primary  text-white font-weight-bold text-xs " style="margin-bottom: 0;" data-bs-toggle="modal" data-bs-target="#modalCreated">
                        Thêm mới
                    </button>

                </div>
               <?php if(Request::input("msg") !== null) :?>
                   <span class="<?php echo Request::input('type') === "error"?"text-warning" :"text-success"?> card-header" style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg'))?></span>
               <?php endif;?>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Parent</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create_at</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $categories = $data['categories'] ??[];
                            ?>
                            <?php if(!empty($categories)) : ?>
                               <?php foreach($categories as $category): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo $category["name"]?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if(!empty($category['parent_id'])) :?>
                                                <?php foreach ($categories as $item):?>
                                                    <?php if($category['parent_id'] == $item["id"]) :?>
                                                        <h6 class="mb-0 text-sm"><?php echo $item['name']?></h6>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo date("Y-m-d", strtotime($category['created_at']));?>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="<?php echo _WEB_ROOT."/cpanel/category-update/".$category['id']?>" class=" btn btn-primary  text-white font-weight-bold text-xs " style="margin-bottom: 0;"
                                                    id="btnEdit"
                                                    >
                                                Edit
                                            </a>
                                            <form action="<?php echo _WEB_ROOT."/cpanel/category-delete"?>" method="post" class="d-inline-block">
                                                <input type="hidden" name="categoryId" value="<?php echo $category['id']; ?>">
                                                <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                                                <button type="submit" class=" btn btn-danger text-white font-weight-bold text-xs " style="margin-bottom: 0;" data-toggle="tooltip" data-original-title="Edit user"
                                                        onclick="alert('Bạn có muốn xóa tài khoản này không?')">
                                                    Delete
                                                </button>
                                            </form>
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
        </div>
    </div>
</div>
<div class="modal fade" id="modalCreated" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?php echo _WEB_ROOT."/cpanel/category-create"?>" class="modal-dialog">  <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm danh mục</h1>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="mb-3">
                    <label for="title" class="form-label">Danh mục</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="usernameHelp" value="">
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">

                <div class="mb-3">
                    <label for="parent" class="form-label">Danh mục cha</label>
                    <div class="dropdown">
                        <input class="form-control" type="text" value=""  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true"/>
                        <input type="hidden" name="createdParentId" class="parentId" value="">
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                            <?php if(!empty($categories)) : ?>
                               <?php foreach ($categories as $item):?>
                                   <li><a class="dropdown-item" href="#" data-value="<?php echo$item['id']?>"><?php echo$item['name']?></a></li>
                               <?php endforeach;?>
                            <?php endif;?>

                        </ul>
                    </div>

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
