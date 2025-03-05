<div class="breadcrumb">
   <div class="container">
      <div class="row">
         <a href="<?php echo _WEB_ROOT?>">Trang chủ</a>
         <?php if(isset($data['breadcrumbs'])):?>
            <?php foreach ($data['breadcrumbs'] as $item):?>
               <i class="fa fa-angle-right"></i>
               <a href="<?php echo _WEB_ROOT.'/'.$item['link']?>"><?php echo $item['name']?></a>
            <?php endforeach;?>
         <?php endif;?>
      </div>
   </div>
</div>