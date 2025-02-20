<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo _WEB_ROOT.'/cpanel/admin-delete'?>" method="post" class="d-inline">
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
                                    <th></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $admins = $data['admins'] ??[];
                                ?>

                                <?php if(!empty($admins)) : ?>
                                <?php foreach($admins as $admin): ?>
                                <tr>
                                    <td class= " text-center" style="width: 10px;">
                                        <input type="checkbox" name="id[]"
                                               class="mx-auto"
                                               value="<?php echo $admin['id']?>"
                                               style="width: 15px; height:15px"
                                        >
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="<?php echo ASSET?>/admin/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?php echo $admin["username"]?></h6>
                                                <p class="text-xs text-secondary mb-0"><?php echo $admin["email"]?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                                        <p class="text-xs text-secondary mb-0">Organization</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <?php if($admin["status"] == 1):?>
                                            <span class="badge badge-sm bg-gradient-success">active</span>
                                        <?php else:?>
                                            <span class="badge badge-sm bg-gradient-secondary">inactive</span>
                                        <?php endif;?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <?php echo date("Y-m-d", strtotime($admin['created_at']));?>
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                            <a href="<?php echo _WEB_ROOT."/cpanel/admin-update/".$admin['id']?>"  class="text-secondary font-weight-bold text-xs " style="margin-bottom: 0;" >
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
                <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                <div class="footer-function gap-2 mt-2 p-2 position-sticky bottom-1 bg-white">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="footer-text w-25 d-flex gap-2 align-items-center">
                            <span class="footer-text-content"></span> selected
                            <span class="footer-btn d-flex justify-content-center align-items-center rounded-circle" style="width: 20px; height: 20px">
                                <i class="fa fa-close " style="width: 100%; height: 100%;"></i>
                            </span>
                        </div>
                        <div>
                            <button type="submit" class=" btn btn-danger text-white font-weight-bold text-xs " style="margin-bottom: 0;" data-toggle="tooltip" data-original-title="Edit user"
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
<div class="modal fade" id="modalCreated" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?php echo _WEB_ROOT."/cpanel/admin-create"?>" class="modal-dialog">  <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Admin</h1>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" value="">
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="">
                </div>
                <input type="hidden" name="id" value="">
                <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <input type="radio" name="status" id="createStatus" value="1">

                    <label for="createStatus" id="status" name="status" class="form-label badge badge-sm bg-gradient-success">
                        Active
                    </label>
                    <input type="radio" name="status" id="createInactive" value="0">

                    <label for="createInactive" id="status" name="status" class="form-label badge badge-sm bg-gradient-secondary">
                        Inactive
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