<?php

class Tour extends Controller
{
   private $data;
   private $TourModel;
   private $CategoryModel;
   private $LocationModel;
   private $TourImgModel;
   private $TourPriceCalendarModel;
   private $TourItineraryModel;
   private $TourNoteModel;
   private $BlogModel;

   public function __construct()
   {
      $this->TourModel = $this->model("TourModel");
      $this->CategoryModel = $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->TourImgModel = $this->model("TourImgModel");
      $this->TourItineraryModel = $this->model("TourItineraryModel");
      $this->TourPriceCalendarModel = $this->model("TourPriceCalendarModel");
      $this->TourNoteModel = $this->model("TourNoteModel");
      $this->BlogModel = $this->model("BlogModel");
   }




   public function index()
   {
      $this->data["page"] = "tour/index";
      $filters = $this->processFilters();

      $this->loadCommonData();
      $this->TourModel->setLimit(9);
      $this->TourModel->setBaseModel();

      $totalPages = $this->TourModel->getTotalPages();
      $tours = $this->TourModel->getTours();

      if (!empty($filters)) {
         $tours = $this->TourModel->searchTours($filters);
      }

      $breadcrumbs = [
         ['name' => "Tất cả tour", "link" => "du-lich"],
      ];

      $this->data["title"] = "ITravel | Tất cả tour";
      $this->data['heading'] = "Tất cả tour";
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['totalPages'] = $totalPages;
      $this->data['tours'] = $tours;

      $this->render("layouts/client_layout", $this->data);
   }

   public function detail($slug)
   {
      $this->loadCommonData();

      $condition = ['slug' => htmlspecialchars($slug)];
      $tour = $this->TourModel->getTour($condition);

      if (empty($tour) && !is_array($tour)) {
         Util::loadError();
      }

      $breadcrumbs = [
         ['name' => $tour['name'], "link" => "/chuong-tring/" . $tour['slug']],
      ];

      $relatedTour = $this->TourModel->getTours(['category_id' => $tour['category_id']], true);
      $listImg = $this->TourImgModel->where(['tour_id' => $tour["id"]]);
      $listPriceCalendar = $this->TourPriceCalendarModel->where(['tour_id' => $tour["id"]]);

      $this->TourItineraryModel->setColOrderBy("day_number");
      $tourItinerary = $this->TourItineraryModel->where(['tour_id' => $tour['id']]);

      $this->TourNoteModel->setColOrderBy("number");
      $tourNotes = $this->TourNoteModel->where(['tour_id' => $tour['id']]);

      $this->data['tourItinerary'] = $tourItinerary;
      $this->data["title"] = $tour['name'];
      $this->data['heading'] = $tour['name'];
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['tour'] = $tour;
      $this->data['listImg'] = $listImg;
      $this->data['listPriceCalendar'] = $listPriceCalendar;
      $this->data['relatedTour'] = $relatedTour;
      $this->data['tourNotes'] = $tourNotes;
      $this->data["page"] = "tour/detail";

      $this->render("layouts/client_layout", $this->data);
   }

   public function getPrice()
   {
      $tourId = $_GET['tour_id'];
      $date = DateTime::createFromFormat('d-m-Y', $_GET['date'])->format('Y-m-d');
      $price = $this->TourPriceCalendarModel->where(['tour_id' => $tourId, 'date' => $date]);

      header('Content-Type: application/json');
      if ($price) {
         echo json_encode(['success' => true, 'adult_price' => number_format($price[0]['adult_price'], 0, ",", ".") . "đ"]);
      } else {
         echo json_encode(['success' => false, 'message' => 'Không tìm thấy giá.']);
      }
   }

   public function getToursByCategory($slug)
   {
      $this->loadCommonData();
      $this->TourModel->setLimit(9);
      $this->TourModel->setBaseModel();

      $category = $this->CategoryModel->find($slug, "slug");
      if (!$category) {
         Util::loadError();
         return;
      }

      $filters = $this->processFilters();
      $filters['typeTour'] = $category['id'];
      $conditions = ['category_id' => $category['id']];
      $tours = $this->TourModel->getTours($conditions, true);
      if ($filters && !empty($filters)) {

         $tours = $this->TourModel->searchTours($filters);
      }
      $totalPages = $this->TourModel->getTotalPages();

      $breadcrumbs = [
         ['name' => "Tất cả tour", "link" => "du-lich"],
         ['name' => $category['name'], 'link' => "{$category['slug']}"]
      ];
      $title = $category['name'];
      if (in_array($slug, ['tour-trong-nuoc', 'tour-nuoc-ngoai'])) {
         $this->data['typeTour'] = $filters['typeTour'];
      }
      $this->data["title"] = "ITravel | " . $title;
      $this->data['heading'] = $title;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['totalPages'] = $totalPages;
      $this->data['tours'] = $tours;
      $this->data["page"] = "tour/index";
      $this->render("layouts/client_layout", $this->data);
   }

   public function searchProductAjax()
   {
      $filters = $this->processFilters();
      if (Request::has("typeTour", "get")) {
         $typeTour = htmlspecialchars(Request::input("typeTour"));
         $category = $this->CategoryModel->find($typeTour, "slug");

         if ($category && !empty($category)) {
            $filters['typeTour'] = $category['id'];
         }
      }
      $tours = $this->TourModel->searchTours($filters);
      echo json_encode(Response::success('Oke', $tours));
   }

   public function search()
   {
      $type = Request::has("type", "get") ? Request::input("type") : null;
      $this->loadCommonData();
      $query = htmlspecialchars(Request::input("search"));

      switch ($type) {
         case "tour":
            $tours = $this->TourModel->getTours([], false, $query);

            $this->data["title"] = "ITravel | Tìm kiếm tour du lịch";
            $this->data['heading'] = "Tìm kiếm tour ";
            $this->data['count'] = count($tours) ?? 0;
            $this->data['tourSearch'] = $tours;
            break;

         case "blog":
            $blogs = $this->BlogModel->getBlogs([], true, $query);
            $this->data["title"] = "ITravel | Tìm kiếm tin tức du lịch";
            $this->data['heading'] = "Tìm kiếm tin tức ";
            $this->data['count'] = count($blogs) ?? 0;
            $this->data['blogSearch'] = $blogs;
            break;

         default:
            $filters = $this->processFilters();
            if ($filters['destination']) {
               $filters['destination'] = Util::generateSlug($filters['destination']);
            }
            $tours = $this->TourModel->searchTours($filters);

            $this->data["title"] = "ITravel | Tìm kiếm tour du lịch";
            $this->data['heading'] = "Tìm kiếm tour ";
            $this->data['count'] = count($tours) ?? 0;
            $this->data['tourSearch'] = $tours;
            break;
      }

      $breadcrumbs = [
         ['name' => "Tìm kiếm", "link" => "#"],
      ];

      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data["page"] = "search/index";
      $this->render("layouts/client_layout", $this->data);
   }

   public function searchProductAndBlogAjax()
   {
      $search = Request::has("search", "get") ? Request::input("search") : null;

      if (empty($search)) {
         echo json_encode([]);
         exit();
      }

      $tours = $this->TourModel->getTours([], false, $search);
      $blogs = $this->BlogModel->getBlogs(['status' => "published"], false, $search);
      $data = [];

      if (!empty($tours) && is_array($tours)) {
         $data['tours'] = $tours;
      }

      if (!empty($blogs) && is_array($blogs)) {
         $data['blogs'] = $blogs;
      }

      echo json_encode($data);
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

   public function getSort($name)
   {
      $res = [];
      switch ($name) {
         case 'nameDesc':
            $res['col'] = 'name';
            $res['sort'] = 'desc';
            break;
         case "priceAsc":
            $res['col'] = 'price';
            $res['sort'] = 'asc';
            break;
         case "priceDesc":
            $res['col'] = 'price';
            $res['sort'] = 'desc';
            break;
         default:
            $res['col'] = 'name';
            $res['sort'] = 'asc';
            break;
      }
      return $res;
   }
   private function loadCommonData()
   {
      $this->data["categories"] = $this->CategoryModel->all();
      $this->data["destination"] = $this->LocationModel->where(['is_destination' => 1]);
      $this->data["departure"] = $this->LocationModel->where(['is_departure' => 1]);
   }


   private function processFilters()
   {
      $filters = [];

      if (Request::has("destination", "get")) {
         $destination = htmlspecialchars(Request::input("destination", ""));
         $filters['destination'] = $destination;
      }

      if (Request::has("departure", "get")) {
         $departure = htmlspecialchars(Request::input("departure"));
         $filters['departure'] = $departure;
      }

      if (Request::has("fromDate", "get")) {
         $fromDate = htmlspecialchars(Request::input("fromDate"));
         $filters['fromDate'] = Util::formatDate($fromDate, 'Y-m-d');
      }

      if (Request::has("priceSort", "get")) {
         $priceSort = htmlspecialchars(Request::input("priceSort"));
         $filters['priceSort'] = $priceSort;
      }

      if (Request::has("budgetId", "get")) {
         $priceList = $this->getPriceRange((int)htmlspecialchars(Request::input("budgetId")));
         if ($priceList !== null) {
            $filters['priceStart'] = $priceList['start'];
            $filters['priceEnd'] = $priceList['end'];
         }
      }


      return $filters;
   }
}
