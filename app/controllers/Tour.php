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


      $tours = $this->TourModel->getTours();
      $totalPages = ceil($this->TourModel->countTours() / $this->TourModel->getLimit());

      if (!empty($filters)) {
         $tours = $this->TourModel->searchTours($filters);
         $totalPages = ceil($this->TourModel->countSearchTours($filters) / $this->TourModel->getLimit());
      }

      $breadcrumbs = [
         ['name' => "Du lịch", "link" => "du-lich"],
      ];

      $this->data["title"] = "ITravel | Tất cả tour";
      $this->data['heading'] = "Tất cả tour";
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['totalPages'] = $totalPages;
      $this->data['tours'] = $tours;
      // seo
      $this->data['seo_desc'] = "Khám phá tour du lịch hấp dẫn trong và ngoài nước với giá ưu đãi. Đặt tour dễ dàng, khởi hành linh hoạt, dịch vụ chuyên nghiệp từ Itravel.";
      $this->data["seo_kw"] = "tour du lịch, đặt tour, tour trong nước, tour nước ngoài, tour giá rẻ, tour cao cấp, Itravel, du lịch trọn gói, tour theo yêu cầu";
      $this->data['seo_og_title'] = "Đặt Tour Du Lịch Trọn Gói Giá Tốt | Itravel.com";
      $this->data["seo_og_desc"] = "Itravel cung cấp hàng trăm tour du lịch trong và ngoài nước, khởi hành hàng ngày. Dễ dàng đặt tour, giá hợp lý, hỗ trợ tận tâm.";
      $this->render("layouts/client_layout", $this->data);
   }

   public function detail($slug)
   {
      $this->loadCommonData();

      $condition = ['slug' => htmlspecialchars($slug)];
      $tour = $this->TourModel->getTour($condition);
      $category = $this->CategoryModel->find($tour['category_id']);
      if (empty($tour) && !is_array($tour)) {
         Util::loadError();
      }
      $breadcrumbs = [
         ['name' => "Du lịch", "link" => "/du-lich"],

         ['name' => $category['name'], "link" => "/" . $category['slug']],

         ['name' => $tour['name'], "link" => "/du-lich/" . $tour['slug']],
      ];

      $relatedTour = $this->TourModel->getTours(['category_id' => $tour['category_id']], true);
      $listImg = $this->TourImgModel->where(['tour_id' => $tour["id"]]);
      $listPriceCalendar = $this->TourPriceCalendarModel->where(['tour_id' => $tour["id"]]);

      $this->TourItineraryModel->setOrderBy("day_number");
      $tourItinerary = $this->TourItineraryModel->where(['tour_id' => $tour['id']]);

      $this->TourNoteModel->setOrderBy("number");
      $tourNotes = $this->TourNoteModel->where(['tour_id' => $tour['id']]);

      $this->data['tourItinerary'] = $tourItinerary;
      $this->data['heading'] = $tour['name'];
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['tour'] = $tour;
      $this->data['listImg'] = $listImg;
      $this->data['listPriceCalendar'] = $listPriceCalendar;
      $this->data['relatedTour'] = $relatedTour;
      $this->data['tourNotes'] = $tourNotes;
      $this->data["page"] = "tour/detail";
      // seo
      $this->data['title'] = $tour['name'] . ' từ ' . $tour['departure_name'] . ' | Itravel';
      $this->data['seo_desc'] = 'Khám phá tour ' . $tour['name'] . ' khởi hành từ ' . $tour['departure_name'] . ', giá chỉ ' . number_format($tour['adult_price'], 0, ',', '.') . 'đ. Hành trình ' . $tour['duration'] . ', khám phá thiên nhiên hùng vĩ ' .$tour["destination_name"].".";
      $this->data['seo_kw'] = implode(', ', [
         $tour['name'],
         'tour ' . strtolower($tour['destination_name']),
         'tour ' . strtolower($tour['departure_name']),
         'du lịch ' . strtolower($tour['destination_name']),
         'tour giá rẻ',
         'tour ' . strtolower($tour['duration']),
         'Itravel',
      ]);

      $this->data['seo_og_title'] = $tour['name'] . ' | Tour ' . $tour['duration'] . ' | Itravel';

      $this->data['seo_og_desc'] = $tour['description'] ?? $this->data['seo_desc'];

      $this->data['seo_og_image'] = $tour['image'];

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
      $categoryName = $category['name'];

      $filters = $this->processFilters();
      $filters['typeTour'] = $category['id'];
      $conditions = ['category_id' => $category['id']];
      $tours = $this->TourModel->getTours($conditions, true);
      $totalPages = ceil($this->TourModel->countTours($conditions, true) / $this->TourModel->getLimit());

      if (!empty($filters)) {
         $tours = $this->TourModel->searchTours($filters);
         $totalPages = ceil($this->TourModel->countSearchTours($filters) / $this->TourModel->getLimit());
      }

      $breadcrumbs = [
         ['name' => "Du lịch", "link" => "du-lich"],
         ['name' => $categoryName, 'link' => "{$category['slug']}"]
      ];
      $title = $categoryName;
      if (in_array($slug, ['tour-trong-nuoc', 'tour-nuoc-ngoai',"tour-cao-cap","tour-combo-gia-re"])) {
         $this->data['typeTour'] = $filters['typeTour'];
      }
      $seo = $this->generateSeoForCategory($category['slug']);
      $this->data["title"] = $seo['title'];
      $this->data['heading'] = $title;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['totalPages'] = $totalPages;
      $this->data['tours'] = $tours;
      // seo 
      
      $this->data['seo_desc'] = $seo['desc'];
      $this->data["seo_kw"] = $seo['keywords'];
      $this->data['seo_og_title'] = $seo['og_title'];
      $this->data["seo_og_desc"] = $seo['og_desc'];
      if (Request::has("destination", "get")) {
         $destination = htmlspecialchars(Request::input("destination", ""));
         $destination = $this->LocationModel->find($destination,"slug");
         $this->data["title"] = "Tour du lịch ". $destination['name']. " hấp dẫn - Itravel";
         $this->data['seo_desc'] = $destination['description'];
         $this->data["seo_kw"] = "Tour du lịch ". $destination['name'].", du lịch ".$destination['name'].", tour " .$destination['name'].", Tour du lịch ". $destination['name'] ." giá rẻ, đặt tour ".$destination['name']. " trực tuyến";
         $this->data['seo_og_title'] = "Tour du lịch ". $destination['name']. " hấp dẫn - Itravel";
         $this->data["seo_og_desc"] =$destination['description'];
      }
      $this->data["page"] = "tour/index";
      $this->render("layouts/client_layout", $this->data);
   }

   public function searchProductAjax()
   {
      $res = [];
      $filters = $this->processFilters();
      if (Request::has("typeTour", "get")) {
         $typeTour = htmlspecialchars(Request::input("typeTour"));
         $category = $this->CategoryModel->find($typeTour, "slug");

         if ($category && !empty($category)) {
            $filters['typeTour'] = $category['id'];
         }
      }
      $this->TourModel->setLimit(9);
      $tours = $this->TourModel->searchTours($filters);
      $res['tours'] = $tours;
      $res['totalPage'] = ceil($this->TourModel->countSearchTours($filters) / $this->TourModel->getLimit());
      echo json_encode(Response::success('Oke', $res));
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
            $this->data['count'] = $this->TourModel->countTours([], false, $query) ?? 0;
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
         $priceList = Util::getPriceRange((int)htmlspecialchars(Request::input("budgetId")));
         if ($priceList !== null) {
            $filters['priceStart'] = $priceList['start'];
            $filters['priceEnd'] = $priceList['end'];
         }
      }
      if (Request::has("page", "get")) {
         $page = htmlspecialchars(Request::input("page"));
         $filters['page'] = $page;
      }


      return $filters;
   }
  private function generateSeoForCategory($category) {
      $category = strtolower(trim($category));
      
      switch ($category) {
         case 'tour-trong-nuoc':
               return [
                  'title' => 'Tour Du Lịch Trong Nước Độc Đáo, Giá Tốt | ITravel',
                  'desc' => 'Khám phá hàng trăm tour du lịch trong nước đa dạng, từ Bắc vào Nam với giá hấp dẫn, dịch vụ chất lượng tại ITravel.',
                  'keywords' => 'tour trong nước, du lịch trong nước, tour giá rẻ trong nước, đặt tour du lịch trong nước, ITravel',
                  'og_title' => 'Tour Du Lịch Trong Nước Độc Đáo, Giá Tốt | ITravel',
                  'og_desc' => 'Hàng trăm tour du lịch trong nước, điểm đến hấp dẫn, giá ưu đãi và dịch vụ chuyên nghiệp tại ITravel.',
               ];

         case 'tour-nuoc-ngoai':
               return [
                  'title' => 'Tour Du Lịch Nước Ngoài Giá Tốt, Điểm Đến Hấp Dẫn | ITravel',
                  'desc' => 'Trải nghiệm tour du lịch nước ngoài đa dạng điểm đến nổi tiếng với giá cạnh tranh, dịch vụ chuẩn 5 sao tại ITravel.',
                  'keywords' => 'tour nước ngoài, du lịch nước ngoài, tour quốc tế giá tốt, đặt tour quốc tế, ITravel',
                  'og_title' => 'Tour Du Lịch Nước Ngoài Giá Tốt, Điểm Đến Hấp Dẫn | ITravel',
                  'og_desc' => 'Khám phá các tour quốc tế hấp dẫn, nhiều ưu đãi và dịch vụ hoàn hảo tại ITravel.',
               ];

         case 'tour-cao-cap':
               return [
                  'title' => 'Tour Du Lịch Cao Cấp Sang Trọng, Trải Nghiệm Đẳng Cấp | ITravel',
                  'desc' => 'Đặt tour cao cấp với dịch vụ sang trọng, tiện nghi hàng đầu, trải nghiệm du lịch đẳng cấp cùng ITravel.',
                  'keywords' => 'tour cao cấp, tour sang trọng, tour du lịch đẳng cấp, dịch vụ cao cấp, ITravel',
                  'og_title' => 'Tour Du Lịch Cao Cấp Sang Trọng, Trải Nghiệm Đẳng Cấp | ITravel',
                  'og_desc' => 'Tour du lịch cao cấp với chất lượng dịch vụ tuyệt vời, trải nghiệm tiện nghi và sang trọng tại ITravel.',
               ];

         case 'tour-combo-gia-re':
               return [
                  'title' => 'Tour Combo Giá Rẻ, Ưu Đãi Hấp Dẫn Cho Gia Đình | ITravel',
                  'desc' => 'Tiết kiệm với tour combo giá rẻ, ưu đãi hấp dẫn dành cho gia đình, nhóm bạn tại ITravel. Đặt ngay hôm nay!',
                  'keywords' => 'tour combo giá rẻ, tour ưu đãi, tour tiết kiệm, đặt tour giá rẻ, ITravel',
                  'og_title' => 'Tour Combo Giá Rẻ, Ưu Đãi Hấp Dẫn Cho Gia Đình | ITravel',
                  'og_desc' => 'Tour combo giá rẻ, ưu đãi nhiều gói hấp dẫn, phù hợp cho gia đình và nhóm bạn tại ITravel.',
               ];

         default:
               return [
                  'title' => 'Tour Du Lịch Đa Dạng Trong Và Ngoài Nước | ITravel',
                  'desc' => 'Khám phá các tour du lịch trong và ngoài nước đa dạng, hấp dẫn với giá tốt cùng ITravel.',
                  'keywords' => 'tour du lịch, đặt tour, tour trong nước, tour nước ngoài, ITravel',
                  'og_title' => 'Tour Du Lịch Đa Dạng Trong Và Ngoài Nước | ITravel',
                  'og_desc' => 'Khám phá nhiều lựa chọn tour du lịch trong và ngoài nước với giá hấp dẫn và dịch vụ chất lượng.',
               ];
      }
   }


}
