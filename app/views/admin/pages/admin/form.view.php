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
                  <form method="post" action="<?php echo _WEB_ROOT."/cpanel/admin-update-post"?>">
                     <input type="hidden" name="csrf_token" value="<?php echo Session::get("csrf_token")?>">
                     <input type="hidden" name="id" value="<?php echo $data['admin']['id'] ?? ""?>">
                     <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $data['admin']['username'] ?? "";?>">
                     </div>
                     <div class="mb-3">
                        <label for="username" class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Không muốn đổi mật khẩu thì bỏ trống">
                     </div>
                     <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $data['admin']['email'] ?? "";?>">
                     </div>
                     <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>

                        <div class="form-check form-check-inline">  <input class="form-check-input" type="radio" name="status" id="createStatus" value="1" <?php echo $data['admin']['status']=== 1 ? "checked":""?>>
                           <label class="form-check-label badge badge-sm bg-gradient-success" for="createStatus">Active</label>
                        </div>
                        <div class="form-check form-check-inline">  <input class="form-check-input" type="radio" name="status" id="createInactive" value="0" <?php echo $data['admin']['status']=== 0 ? "checked":""?>>
                           <label class="form-check-label badge badge-sm bg-gradient-secondary" for="createInactive">Inactive</label>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
               </div>
         </div>
      </div>
   </div>
</div>