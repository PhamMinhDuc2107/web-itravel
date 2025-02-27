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
            <?php $location = $data['location'] ?? []?>
            <div class="card-body">
               <form method="post" class="form-update" action="<?php echo _WEB_ROOT."/cpanel/location-update-post"?>" enctype="multipart/form-data">
               <div class="mb-3">
                    <label for="title" class="form-label">Tên địa điểm</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="usernameHelp" value="<?php echo $location['name']?>">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Mô tả</label>
                    <textarea type="text" class="form-control " id="description" name="description" aria-describedby="usernameHelp" style="height: 100px;" > <?php echo $location['description']?></textarea>
                </div>
                <div class="mb-3">
                 <label for="images" class="form-label d-block">Hình ảnh</label>
                 <input type="file" class="form-control" id="imageCreateBlog" name="image" aria-describedby="usernameHelp" value="" style="display: none">
                 <label for="imageCreateBlog" style=" width: 250px;height: 250px;" class="d-flex justify-content-center align-items-center flex-column circle text-primary border border-2 rounded-2 position-relative">
                     <img src="<?php echo _WEB_ROOT.$location['image']?>" id="previewImageBlog" alt="" style="height: 100%; width:100%; object-fit: cover;">
                 </label>
             </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Chọn</label>
                    
                    <input type="checkbox" name="is_departure" id="is_departure"  <?php echo $location['is_departure'] == 1 ? "checked" : ""; ?>>
                    <label for="is_departure" id="status" name="is_departure" class="form-label badge badge-sm bg-gradient-success">
                        Là điểm khởi hành
                    </label>
                    <input type="checkbox" name="is_destination" id="is_destination" <?php echo $location['is_destination'] == 1 ? "checked" : ""; ?>>
                    <label for="is_destination" id="status" name="is_destination" class="form-label badge badge-sm bg-gradient-secondary">
                        Là điểm đến
                    </label>
                </div>
                  <input type="hidden" name="csrf_token" value="<?php echo Session::get('csrf_token'); ?>">
                  <input type="hidden" value="<?php echo $location['id']?>" name="id">
                  <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

