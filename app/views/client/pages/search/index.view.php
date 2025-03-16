<div class="search-result">
   <div class="container">
         <h3 class="block-title">
            <?php echo $data['count'] > 0 ?  'Có '.$data['count'].' kết quả phù hợp' : "Không tìm thấy bất kỳ kết quả nào với từ khóa trên"?>
         </h3>
         <?php if(isset($data['tourSearch']) && is_array($data['tourSearch'])):?>
            <div class="">
               <div class="tour__list">
                  <?php foreach ($data['tourSearch'] as $tour):?>
                     <div class="tour__item ">
                        <div class="tour__img">
                           <img src="<?php echo _WEB_ROOT . $tour['image'] ?>" alt="">
                           <div class="tour__info--transport">
                              <i class="fa-solid fa-plane"></i>
                              <i class="fa-solid fa-bus"></i>
                           </div>
                        </div>
                        <div class="tour__item--wrap">
                           <div class="tour__name">
                              <a href="<?php echo _WEB_ROOT . '/du-lich/' . $tour['slug'] ?>"><?php echo $tour['name'] ?></a>
                           </div>
                           <div class="tour__detail">
                              <div class="tour__detail--top">
                                 <div class="tour__detail--depart">
                                    <svg fill="#615c5c" height="20px" width="20px" version="1.1" id="Capa_1"
                                         xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                         xml:space="preserve" stroke="#615c5c"><g id="SVGRepo_bgCarrier"
                                                                                  stroke-width="0"></g>
                                       <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                          stroke-linejoin="round"></g>
                                       <g id="SVGRepo_iconCarrier">
                                          <g>
                                             <g>
                                                <path d="M494.628,114.192h9.793c4.187,0,7.579-3.393,7.579-7.579v-45.47c0-4.186-3.392-7.579-7.579-7.579h-9.793 c-8.205,0-14.879-6.674-14.879-14.878v-15.25c0-4.186-3.392-7.579-7.579-7.579H142.145c-4.187,0-7.579,3.393-7.579,7.579 c0,4.186,3.392,7.579,7.579,7.579h322.446v7.671c0,16.562,13.474,30.036,30.037,30.036h2.214v30.312h-2.214 c-16.563,0-30.037,13.473-30.037,30.036c0,16.563,13.474,30.036,30.037,30.036h2.214v30.312h-2.214 c-16.563,0-30.037,13.473-30.037,30.035v17.182h-13.419l-90.469-20.372h67.195c4.187,0,7.579-3.393,7.579-7.579V58.966 c0-4.186-3.392-7.579-7.579-7.579H84.102c-4.187,0-7.579,3.393-7.579,7.579v149.718c0,4.186,3.392,7.579,7.579,7.579h19.448 l-4.588,20.372H47.408v-7.671c0-16.562-13.474-30.036-30.036-30.036h-2.214v-30.312h2.214c16.562,0,30.036-13.474,30.036-30.036 c0-16.562-13.474-30.036-30.036-30.036h-2.214V78.233h2.214c16.562,0,30.036-13.473,30.036-30.036V31.015h49.791 c4.187,0,7.579-3.393,7.579-7.579c0-4.186-3.392-7.579-7.579-7.579h-57.37c-4.187,0-7.579,3.393-7.579,7.579v24.761 c0,8.203-6.674,14.878-14.878,14.878H7.579C3.392,63.075,0,66.468,0,70.654v45.47c0,4.186,3.392,7.579,7.579,7.579h9.793 c8.204,0,14.878,6.674,14.878,14.878c0,8.205-6.674,14.878-14.878,14.878H7.579c-4.187,0-7.579,3.393-7.579,7.579v45.47 c0,4.186,3.392,7.579,7.579,7.579h9.793c8.204,0,14.878,6.674,14.878,14.878v15.25c0,4.186,3.392,7.579,7.579,7.579h55.719 l-0.532,2.36l-4.243,18.842c0,0.002,0,0.003-0.001,0.005L63.379,394.652c-1.195,5.306-0.246,10.772,2.675,15.39 c2.92,4.618,7.452,7.82,12.758,9.014l340.097,76.584c1.495,0.337,3.003,0.503,4.501,0.503c3.818,0,7.572-1.081,10.889-3.179 c4.617-2.92,7.818-7.452,9.014-12.758l4.355-19.34c0.92-4.084-1.645-8.139-5.729-9.058c-4.081-0.921-8.139,1.645-9.058,5.729 l-4.355,19.34c-0.306,1.357-1.133,2.521-2.329,3.277c-1.197,0.757-2.602,1.002-3.958,0.698L82.141,404.27 c-1.357-0.305-2.52-1.132-3.276-2.328c-0.757-1.196-1.005-2.602-0.699-3.958l25.73-114.264l350.358,78.894l-6.009,26.682 c-0.92,4.084,1.645,8.14,5.729,9.059c4.084,0.922,8.139-1.645,9.058-5.729l28.376-126.001c1.195-5.306,0.246-10.772-2.675-15.39 c-2.199-3.478-5.313-6.15-8.984-7.769v-24.012c0-8.203,6.674-14.877,14.879-14.877h9.793c4.187,0,7.579-3.393,7.579-7.579v-45.47 c0.001-4.187-3.391-7.58-7.578-7.58h-9.793c-8.205,0-14.879-6.674-14.879-14.878C479.75,120.866,486.424,114.192,494.628,114.192z M91.681,201.105V66.545h328.64v134.56H293.388l-157.512-35.469c-5.305-1.194-10.771-0.245-15.389,2.676 c-4.617,2.92-7.818,7.452-9.014,12.758l-4.511,20.035H91.681z M457.583,347.826l-350.357-78.894l8.22-36.502l350.357,78.894 L457.583,347.826z M476.622,263.295l-7.486,33.241l-350.361-78.895l1.668-7.408c0.002-0.01,0.005-0.021,0.007-0.031l5.811-25.802 c0.306-1.357,1.133-2.521,2.329-3.277c1.198-0.757,2.6-1.005,3.958-0.698l312.77,70.43c1.083,0.597,2.327,0.939,3.652,0.939h0.515 l23.159,5.215C475.475,257.645,477.258,260.466,476.622,263.295z"></path>
                                             </g>
                                          </g>
                                          <g>
                                             <g>
                                                <path d="M301.557,356.72c-1.075-1.699-2.78-2.9-4.74-3.342l-151.742-34.169c-1.96-0.441-4.018-0.086-5.716,0.988 c-1.699,1.074-2.901,2.78-3.343,4.74l-6.822,30.297c-0.92,4.084,1.645,8.139,5.729,9.058l151.741,34.169 c0.561,0.126,1.12,0.187,1.671,0.187c3.466,0,6.593-2.393,7.387-5.916l6.823-30.297 C302.988,360.475,302.633,358.419,301.557,356.72z M282.6,382.011l-136.954-30.839l3.492-15.51l136.954,30.839L282.6,382.011z"></path>
                                             </g>
                                          </g>
                                          <g>
                                             <g>
                                                <path d="M383.756,372.955l-53.739-12.101c-1.96-0.441-4.018-0.086-5.716,0.988c-1.699,1.074-2.901,2.78-3.343,4.74l-6.822,30.297 c-0.92,4.084,1.645,8.139,5.729,9.058l53.739,12.101c0.551,0.124,1.11,0.185,1.664,0.185c1.423,0,2.829-0.4,4.051-1.173 c1.699-1.074,2.901-2.78,3.343-4.74l6.822-30.297C390.405,377.93,387.84,373.875,383.756,372.955z M369.54,401.588l-38.952-8.771 l3.492-15.51l38.952,8.771L369.54,401.588z"></path>
                                             </g>
                                          </g>
                                       </g></svg>
                                    <div>
                                       <span> <?php echo $tour['code_tour'] ?></span>
                                    </div>
                                 </div>
                                 <div class="tour__detail--depart">
                                    <svg width="20px" height="20px" viewBox="-4 0 32 32" version="1.1"
                                         xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#615c5c">
                                       <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                       <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                          stroke-linejoin="round"></g>
                                       <g id="SVGRepo_iconCarrier"><title>location</title>
                                          <desc>Created with Sketch Beta.</desc>
                                          <defs></defs>
                                          <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                             fill-rule="evenodd" sketch:type="MSPage">
                                             <g id="Icon-Set" sketch:type="MSLayerGroup"
                                                transform="translate(-104.000000, -411.000000)"
                                                fill="#000000">
                                                <path d="M116,426 C114.343,426 113,424.657 113,423 C113,421.343 114.343,420 116,420 C117.657,420 119,421.343 119,423 C119,424.657 117.657,426 116,426 L116,426 Z M116,418 C113.239,418 111,420.238 111,423 C111,425.762 113.239,428 116,428 C118.761,428 121,425.762 121,423 C121,420.238 118.761,418 116,418 L116,418 Z M116,440 C114.337,440.009 106,427.181 106,423 C106,417.478 110.477,413 116,413 C121.523,413 126,417.478 126,423 C126,427.125 117.637,440.009 116,440 L116,440 Z M116,411 C109.373,411 104,416.373 104,423 C104,428.018 114.005,443.011 116,443 C117.964,443.011 128,427.95 128,423 C128,416.373 122.627,411 116,411 L116,411 Z"
                                                      id="location" sketch:type="MSShapeGroup"></path>
                                             </g>
                                          </g>
                                       </g>
                                    </svg>
                                    <div>
                                       <span>Khời hành từ: <?php echo $tour['departure_name'] ?></span>
                                    </div>
                                 </div>
                                 <div class="tour__detail--depart">
                                    <svg width="20px" height="20px" viewBox="0 0 32 32" version="1.1"
                                         xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" fill="#615c5c">
                                       <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                       <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                          stroke-linejoin="round"></g>
                                       <g id="SVGRepo_iconCarrier">
                                          <g id="icomoon-ignore"></g>
                                          <path d="M3.205 3.205v25.59h25.59v-25.59h-25.59zM27.729 4.271v4.798h-23.457v-4.798h23.457zM4.271 27.729v-17.593h23.457v17.593h-23.457z"
                                                fill="#000000"></path>
                                          <path d="M11.201 5.871h1.6v1.599h-1.6v-1.599z" fill="#000000"></path>
                                          <path d="M19.199 5.871h1.599v1.599h-1.599v-1.599z"
                                                fill="#000000"></path>
                                          <path d="M12.348 13.929c-0.191 1.297-0.808 1.32-2.050 1.365l-0.193 0.007v0.904h2.104v5.914h1.116v-8.361h-0.953l-0.025 0.171z"
                                                fill="#000000"></path>
                                          <path d="M18.642 16.442c-0.496 0-1.005 0.162-1.408 0.433l0.38-1.955h3.515v-1.060h-4.347l-0.848 4.528h0.965l0.059-0.092c0.337-0.525 0.952-0.852 1.606-0.852 1.064 0 1.836 0.787 1.836 1.87 0 0.98-0.615 1.972-1.79 1.972-1.004 0-1.726-0.678-1.756-1.649l-0.006-0.194h-1.115l0.005 0.205c0.036 1.58 1.167 2.641 2.816 2.641 1.662 0 2.963-1.272 2.963-2.895-0-1.766-1.154-2.953-2.872-2.953z"
                                                fill="#000000"></path>
                                       </g>
                                    </svg>
                                    <div>
                                       <span> Lịch khởi hành: <?php echo Util::formatDate($tour['date']) ?></span>
                                    </div>
                                 </div>
                                 <div class="tour__detail--depart">
                                    <svg fill="#615c5c" width="20px" height="20px" viewBox="0 0 24.00 24.00"
                                         id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                                         stroke="#615c5c" stroke-width="0.00024000000000000003"
                                         transform="rotate(90)">
                                       <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                       <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                          stroke-linejoin="round"></g>
                                       <g id="SVGRepo_iconCarrier">
                                          <path d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Zm2-10a2,2,0,1,1-3-1.723V7a1,1,0,0,1,2,0v3.277A1.994,1.994,0,0,1,14,12Z"></path>
                                       </g>
                                    </svg>
                                    <div>
                                       <span><?php echo $tour['duration'] ?></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="tour__detail--bottom">
                                 <div class="tour__detail--price">
                                    <p>Giá chỉ:</p>
                                    <span><?php echo number_format($tour['adult_price'], 0, ",", "."); ?>đ</span>
                                 </div>
                                 <div class="tour__detail--quantity">
                                    <a href="<?php echo _WEB_ROOT.'/du-lich/'.$tour['slug']?>" class="btn btn-booking">Đặt ngay</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php endforeach;?>
               </div>
            </div>
         <?php endif;?>
        <?php if(isset($data['blogSearch']) && is_array($data['blogSearch'])):?>
          <div class="blog page-blog">
              <div class="blog__list">
                 <?php foreach($data['blogSearch'] as $blog):?>
                     <div class="blog__item">
                         <img src="<?php echo _WEB_ROOT.$blog['thumbnail']?>" alt="<?php echo $blog['slug']?>">
                         <a class="blog__item--category" href="<?php echo _WEB_ROOT.'/tin-tuc'."/".$blog['category_slug']?>"><?php echo $blog['category_name']?></a>
                         <a href="<?php echo _WEB_ROOT.'/tin-tuc/'.$blog['slug']?>"><?php echo $blog['title']?></a>
                         <div>
                             <i class="fa-solid fa-calendar-days"></i>
                             <span><?php echo Util::formatDate($blog['created_at'])?></span>
                         </div>
                     </div>
                 <?php endforeach;?>
              </div>
          </div>
      <?php endif;?>
   </div>
</div>
