<?php
class Blog extends Controller
{
   private $data;
   private $BlogModel;
   private $CategoryModel;
   private $LocationModel;
   public function __construct()
   {
      $this->BlogModel = $this->model("BlogModel");
      $this->CategoryModel = $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
   }
   public function index(): void
   {
      $this->BlogModel->setLimit(9);
      $this->BlogModel->setBaseModel();
      $totalPages = $this->BlogModel->getTotalPages();

      $blogs = $this->BlogModel->getBlogs(['status' => "published"]);
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);

      $breadcrumbs = [
         ['name' => "Tin tức", "link" => "tin-tuc"],
      ];
      $this->data["title"] = "Thông tin liên hệ";
      $this->data['heading'] = "Tin tức";
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['totalPages'] = $totalPages;
      $this->data['blogs'] = $blogs;
      $this->data['categories'] = $categories;
      $this->data['destination'] = $destination;
      $this->data['departure'] = $departure;
      $this->data['page'] = "blog/index";
       $this->data['seo_title'] = "Tin Tức Du Lịch Mới Nhất, Kinh Nghiệm & Ưu Đãi Hấp Dẫn | Itravel.com";
       $this->data['seo_desc'] = "Cập nhật các tin tức du lịch mới nhất, chia sẻ kinh nghiệm đặt phòng, điểm đến nổi bật và ưu đãi khách sạn hấp dẫn mỗi ngày.";
       $this->data['seo_og_title'] = "Tin Tức Du Lịch, Mẹo Hay & Ưu Đãi Hàng Tuần | Itravel.com";
       $this->data['seo_og_desc'] = "Khám phá cẩm nang du lịch, bí kíp tiết kiệm khi đặt phòng, tin tức địa điểm hot và khuyến mãi đặc biệt từ Itravel.";
       $this->data['seo_kw'] = "tin tức du lịch, blog du lịch, mẹo đặt phòng, ưu đãi khách sạn, kinh nghiệm du lịch, điểm đến nổi bật";
       $this->render("layouts/client_layout", $this->data);
   }
   function detail($slug): void
   {
      $checkBlog = $this->BlogModel->find(htmlspecialchars($slug), "slug");
      if (!$checkBlog) {
         Util::loadError();
      }
      $blog = $this->BlogModel->getBlogById($checkBlog['id']);
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      $relatedNews = $this->BlogModel->where(["category_id" => $blog['category_id']]);

      foreach ($relatedNews as $i =>  $item) {
         if ($item['id'] === $checkBlog['id']) {
            unset($relatedNews[$i]);
         }
      }
      $breadcrumbs = [
         ['name' => "Tin tức", "link" => "tin-tuc"],
         ['name' => $blog['title'], "link" => "tin-tuc/$slug"],
      ];
      $this->data["title"] = $blog['title'] . " | Itravel Blog Du Lịch";
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['blog'] = $blog;
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['relatedNews'] = $relatedNews;
      $this->data['page'] = "blog/detail";
       $this->data['seo_title'] = $blog['title'] . " | Itravel Blog Du Lịch";
       $this->data['seo_desc'] = strip_tags($blog['content']);
       $this->data['seo_og_title'] = $blog['title'];
       $this->data['seo_og_desc'] = strip_tags($blog['content']);
       $this->data['seo_kw'] = "tin tức du lịch, blog du lịch, mẹo đặt phòng, ưu đãi khách sạn, kinh nghiệm du lịch, điểm đến nổi bật";
       $this->render("layouts/client_layout", $this->data);
   }
}