<div class="container-fluid py-4">
   <div class="row">
      <div class="col-12">
         <div class="card mb-4">
            <div class="card-header">
               <h3><?php echo $data['title'] ?></h3>
               <?php if (Request::input("msg") !== null) : ?>
                  <span
                     class="<?php echo Request::input('type') === "error" ? "text-warning" : "text-success" ?> card-header"
                     style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg')) ?></span>
               <?php endif; ?>
            </div>
            <div class="card-body">
               <form method="post" action="<?php echo _WEB_ROOT . "/dashboard/amenityCategory-update-post" ?>">
                  <input type="hidden" name="csrf_token" value="<?php echo Session::get("csrf_token") ?>">
                  <input type="hidden" name="id" value="<?php echo $data['amenityCategory']['id'] ?? "" ?>">
                  <div class="mb-3">
                     <label for="username" class="form-label">Tên</label>
                     <input type="text" class="form-control" name="title"
                        value="<?php echo $data['amenityCategory']['name'] ?? ""; ?>">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>