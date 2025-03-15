<?php

class Home extends Controller
{
   private $data = [];
   private $CategoryModel;
   private $LocationModel;
   private $BannerModel;
   private $BlogModel;
   private $TourModel;

   public function __construct()
   {
      $this->CategoryModel = $this->Model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->BannerModel = $this->model("BannerModel");
      $this->BlogModel = $this->model("BlogModel");
      $this->TourModel = $this->model("TourModel");
   }

   public function index()
   {
      $banners = $this->BannerModel->where(['status' => 1]);
      $categories = $this->CategoryModel->all();
      $locations = $this->LocationModel->where(['is_destination' => 1]);
      $listTourHot = $this->TourModel->getTours(['status_hot' => 1], true);
      $tours = $this->TourModel->getTours();

      $this->CategoryModel->setColOrderBy("display_home");
      $listCategoryHot = $this->CategoryModel->where(["display_home" => 1]);
      $listLocationDisplayHome = $this->LocationModel->where(["display_home" => 1]);
      $listTourCate = [];

      foreach ($tours as $tour) {
         foreach ($listCategoryHot as $category) {
            if ($tour['category_id'] == $category['id']) {
               $listTourCate[$category['name']]["tours"][] = $tour;
            }
         }
      }
      foreach ($listLocationDisplayHome as $location) {
         foreach ($listCategoryHot as $category) {
            if ($location['category'] == $category['id']) {
               $listTourCate[$category['name']]["locations"][] = $location;
            }
         }
      }
      $listTourCate = array_reverse($listTourCate);
      $listLocationHot = $this->LocationModel->where(['hot' => 1]);
      $listLocationCate = [];
      foreach ($listLocationHot as $location) {
         foreach ($listCategoryHot as $category) {
            if ($location['category'] == $category['id']) {
               $listLocationCate[$category['name']][] = $location;
            }
         }
      }
      $listLocationCate = array_reverse($listLocationCate);
      $firstLocationCate = reset($listLocationCate);
      $lastLocationCate = end($listLocationCate);
      $listBlogHot = $this->BlogModel->where(['status' => 1, 'status' => "published"]);
      $this->data["firstLocationCate"] = $firstLocationCate;
      $this->data["lastLocationCate"] = $lastLocationCate;
      $this->data["page"] = "home/index";
      $this->data["tours"] = $tours;

      $this->data["banners"] = $banners;
      $this->data["locations"] = $locations;
      $this->data["categories"] = $categories;
      $this->data["tourHot"] = $listTourHot;
      $this->data["listCategoryHot"] = $listCategoryHot;
      $this->data["listLocationHot"] = $listLocationHot;
      $this->data["listTourCate"] = $listTourCate;
      $this->data["listLocationCate"] = $listLocationCate;
      $this->data["listBlogHot"] = $listBlogHot;
      $this->data["js"] = "home";
      $this->render("layouts/client_layout", $this->data);
   }

   public function search()
   {
      $type = Request::has("type") ? Request::input("type") : null;
      $categories = $this->CategoryModel->all();
      $locations = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      switch ($type) {
         case "tour":

            break;
         case "blog":
            break;
         default:
            $filters = [];
            if (Request::has("destinationTo", "get") && Request::has("departureFrom", "get") && Request::has("fromDate", "get") &&
            Request::has("budgetId", "get")) {
               break;
            }
            if (Request::has("destinationTo", "get")) {
               $destinationTo = htmlspecialchars(Request::input("destinationTo"));
               $filters['destinationTo'] = Util::generateSlug($destinationTo);
            }

            if (Request::has("departureFrom", "get")) {
               $departureFrom = htmlspecialchars(Request::input("departureFrom"));
               $filters['departureFrom'] = $departureFrom;
            }

            if (Request::has("fromDate", "get")) {
               $fromDate = htmlspecialchars(Request::input("fromDate"));
               $filters['fromDate'] = Util::formatDate($fromDate, 'Y-m-d');
               print($filters['fromDate']);
            }

            if (Request::has("budgetId", "get")) {
               $priceList = $this->getPriceRange((int)htmlspecialchars(Request::input("budgetId")));
               if(!empty($priceList)) {
                  $priceStart = $priceList['start'];
                  $priceEnd = $priceList['end'];
                  $filters['priceStart'] = $priceStart;
                  $filters['priceEnd'] = $priceEnd;
               }

            }
            $tours = $this->TourModel->searchTours($filters);

            $breadcrumbs = [
               ['name' => "Tìm kiếm tour", "link" => "#"],
            ];
            $this->data["title"] = "ITravel | Tìm kiếm tour du lịch";
            $this->data['heading'] = "Tìm kiếm tour ";
            $this->data['count'] = count($tours) ?? 0;
            $this->data['tours'] = $tours;
            break;
      }

      $this->data['departures'] = $departure;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['categories'] = $categories;
      $this->data['locations'] = $locations;
      $this->data["page"] = "search/index";
      $this->render("layouts/client_layout", $this->data);
   }

   public function getPriceRange($price)
   {
      switch ($price) {
         case 1:
            return ['start' => 0, 'end' => 5000000];
         case 2:
            return ['start' => 5000000, 'end' => 10000000];
         case 3:
            return ['start' => 10000000, 'end' => 20000000];
         case 4:
            return ['start' => 20000000, 'end' => null];
         default:
            return null;
      }
   }
}