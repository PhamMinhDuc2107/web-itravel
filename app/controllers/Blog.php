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
      $this->data["title"] = "Trang tin tức chi tiết | " . $blog['title'];
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['blog'] = $blog;
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['relatedNews'] = $relatedNews;
      $this->data['page'] = "blog/detail";
      $this->render("layouts/client_layout", $this->data);
   }
}