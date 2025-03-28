<?php

class Tour extends Controller {
   private $data;
   private $TourModel;
   private $CategoryModel;
   private $LocationModel;
   private $TourImgModel;
   private $TourPriceCalendarModel;
   public function __construct() 
   {
      $this->TourModel = $this->model("TourModel"); 
      $this->CategoryModel = $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->TourImgModel = $this->model("TourImgModel");
      $this->TourPriceCalendarModel = $this->model("TourPriceCalendarModel");
   }
   public function index() {
      $this->data["page"] = "tour/index";
      $filters = [];

      if(Request::has("destinationTo", "get")) {
         $destinationTo = htmlspecialchars(Request::input("destinationTo"));
         $filters['destinationTo'] = $destinationTo;
      }

      if(Request::has("departureFrom", "get")) {
         $departureFrom = htmlspecialchars(Request::input("departureFrom"));
         $filters['departureFrom'] = $departureFrom;
      }

      if(Request::has("fromDate", "get")) {
         $fromDate = htmlspecialchars(Request::input("fromDate"));
         $filters['fromDate'] = Util::formatDate($fromDate, 'Y-m-d');
      }

      if(Request::has("budgetId", "get")) {
         $priceList = $this->TourModel->getPriceRange((int)htmlspecialchars(Request::input("budgetId")));
         $priceStart = $priceList['start'];
         $priceEnd = $priceList['end'];

         $filters['priceStart'] = $priceStart;
         $filters['priceEnd'] = $priceEnd;
      }
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure'=>1]);

      $this->TourModel->setLimit(9);

      $this->TourModel->setBaseModel();

      $totalPages = $this->TourModel->getTotalPages();
      $tours = $this->TourModel->getTours();
      $breadcrumbs =[
         ['name'=> "Tất cả tour", "link"=>"du-lich"],
      ];
      $this->data["title"] = "ITravel | Tất cả tour";
      $this->data['heading'] = "Tất cả tour";

      if(!empty($filters)) {
         $tours = $this->TourModel->searchTours($filters);
         $countTours = $this->TourModel->countSearchTours($filters);
         $breadcrumbs =[
            ['name'=> "Tìm kiếm tour", "link"=>"#"],
         ];
         $this->data["title"] = "ITravel | Tìm kiếm tour du lịch";
         $this->data['heading'] = "Tìm kiếm tour ";

         $this->data['count'] = $countTours;
      }

      $this->data['departures'] = $departure;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['totalPages'] = $totalPages;
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['tours'] = $tours;
      $this->render("layouts/client_layout",$this->data);
   }
   public function detail($slug) {
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure'=>1]);
      $departure = $this->LocationModel->where(['is_departure'=>1]);

      $condition = ['slug'=> htmlspecialchars($slug)];
      $tour = $this->TourModel->getTour($condition);
      if(empty($tour) && !is_array($tour)) {
         Util::loadError();
      }
      $breadcrumbs =[
         ['name'=> $tour['name'], "link"=>"/chuong-tring/".$tour['slug']],
      ];

      $relatedTour  =$this->TourModel->getTours(['category_id'=>$tour['category_id']], true);
      $listImg  = $this->TourImgModel->where(['tour_id'=>$tour["id"]]);
      $listPriceCalendar = $this->TourPriceCalendarModel->where(['tour_id'=>$tour["id"]]);
      $this->data["title"] = $tour['name'];
      $this->data['heading'] = $tour['name'];
      $this->data['departure'] = $departure;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['tour'] = $tour;
      $this->data['listImg'] = $listImg;
      $this->data['listPriceCalendar'] = $listPriceCalendar;
      $this->data['relatedTour'] = $relatedTour;
      $this->data["page"] = "tour/detail";
      $this->render("layouts/client_layout",$this->data);
   }

   public function getPrice() {
      $tourId = $_GET['tour_id'];
      $date = DateTime::createFromFormat('d-m-Y', $_GET['date'])->format('Y-m-d');
      $price = $this->TourPriceCalendarModel->where(['tour_id'=>$tourId, 'date'=>$date]);
      header('Content-Type: application/json');
      if ($price) {
         echo json_encode(['success' => true, 'adult_price' => number_format($price[0]['adult_price'], 0, ",", ".")."đ"]);
      } else {
         echo json_encode(['success' => false, 'message' => 'Không tìm thấy giá.']);
      }
   }
   public function findTour($slug, $destinationOrDate = null) {
      $dpt = Request::input("departure", "");

      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      $this->TourModel->setLimit(9);
      $this->TourModel->setBaseModel();

      $category = $this->CategoryModel->find($slug, "slug");
      if (!$category) {
         Util::loadError();
      }

      $findDeparture = null;
      if (!empty($dpt)) {
         $findDeparture = $this->LocationModel->find($dpt, "slug");
         if (!$findDeparture) {
            Util::loadError();
         }
      }

      $checkDestination = null;
      if ($destinationOrDate) {
         $checkDestination = $this->LocationModel->find($destinationOrDate, "slug");
         if (!$checkDestination) {
            Util::loadError();
         }
      }

      $conditions = ['category_id' => $category['id']];

      if ($findDeparture) {
         $conditions['departure_id'] = $findDeparture['id'];
      }
      if ($checkDestination) {
         $conditions['destination_id'] = $checkDestination['id'];
      }

      $tours = $this->TourModel->getTours($conditions, true);
      $totalPages = $this->TourModel->getTotalPages();

      $breadcrumbs = [['name' => $category['name'], 'link' => "{$category['slug']}"]];
      if ($checkDestination) {
         $breadcrumbs[] = ['name' => $checkDestination['name'], 'link' => "{$category['slug']}/{$checkDestination['slug']}"];
      }

      $title = implode(" | ", array_column($breadcrumbs, 'name'));

      $this->data["title"] = $title;
      $this->data['heading'] = $title;
      $this->data['departure'] = $departure;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['totalPages'] = $totalPages;
      $this->data["destination"] = $destination;
      $this->data["categories"] = $categories;
      $this->data['tours'] = $tours;
      $this->data["page"] = "tour/index";
      $this->render("layouts/client_layout", $this->data);
   }

   public function getSort($name) {
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


}