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
                                        <a href="<?php echo _WEB_ROOT."/cpanel/admin-update/".$admin['id']?>"  class=" btn btn-primary  text-white font-weight-bold text-xs " style="margin-bottom: 0;" >
                                            Edit
                                        </a>
                                    <form action="<?php echo _WEB_ROOT.'/cpanel/admin-delete'?>" method="post" class="d-inline-block">
                                        <input type="hidden" value="<?php echo $admin['id']; ?>" name="id">
                                        <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                                        <button type="submit"  class="btn btn-danger text-white font-weight-bold text-xs" style="margin-bottom: 0;" data-toggle="tooltip" data-original-title="Edit user"
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
    <form method="post" action="<?php echo _WEB_ROOT."/cpanel/admin-create"?>" class="modal-dialog">  <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật thông tin Admin</h1>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" value="">
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Nếu không muốn đổi mật khẩu thì để trống">
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
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </form>
</div>