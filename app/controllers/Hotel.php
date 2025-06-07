<?php

class Hotel extends Controller
{
   private $data = [];
   private $CategoryModel;
   private $LocationModel;
   private $HotelModel;
   private $HotelAmenityModel;
   private $HotelImageModel;
   private $HotelReviewModel;
   private $HotelReviewImageModel;
   private $HotelTypeModel;
   
   public function __construct()
   {
      $this->CategoryModel = $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->HotelModel = $this->model("HotelModel");
      $this->HotelAmenityModel = $this->model("HotelAmenityModel");
      $this->HotelImageModel = $this->model("HotelImageModel");
      $this->HotelReviewModel = $this->model("HotelReviewModel");
      $this->HotelReviewImageModel = $this->model("HotelReviewImageModel");
      $this->HotelTypeModel = $this->model("HotelTypeModel");
   }
   public function index()
   {
      $this->HotelModel->setLimit(100);
      $this->HotelModel->setBaseModel();
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      $hotelImages = $this->HotelImageModel->all();
      $hotelAmenities = $this->HotelAmenityModel->getAmenities();

      $dataHotels = [];
      if(Request::has("hotelType", "get") || Request::has("budgetId", "get") || Request::has("sortRating", "get") || Request::has("orderBy", "get")) {
          $dataParam = $this->filterData();
          $hotels = $this->HotelModel->filterHotelsByRange($dataParam);
      }else {
          $hotels =$this->HotelModel->getHotels();
      }
      foreach($hotels as $key => $hotel) {
         $dataHotels[$hotel['id']] = $hotel;
         $dataImages = [];
         foreach($hotelImages as $hotelImage) {
            if($hotel['id'] !== $hotelImage['hotel_id']) {
               continue;
            }
            $dataImages[] = $hotelImage['image'];
         }
         $dataHotelAmenities = [];
         foreach($hotelAmenities as $hotelAmenity) {
            if($hotel['id'] !== $hotelAmenity['hotel_id']) {
               continue;
            }
            $dataHotelAmenities[] = $hotelAmenity;
         }
         $dataHotels[$hotel['id']]['images'] = $dataImages;
         $dataHotels[$hotel['id']]['amenities'] = $dataHotelAmenities;
      }
      $hotelTyes = $this->HotelTypeModel->all(); 
      $breadcrumbs = [
         ['name' => "Đặt phòng khách sạn", "link" => "dat-phong-khach-san"],
      ];
      $this->data["title"] = "Đặt phòng khách sạn";
      $this->data['heading'] = "Đặt phòng khách sạn";
      $this->data["page"] = "hotel/index";
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['hotels'] = $dataHotels;
      $this->data['hotelTypes'] = $hotelTyes;
      // seo
      $this->data['seo_desc'] = "Đặt phòng khách sạn giá rẻ tại Việt Nam và quốc tế với nhiều ưu đãi hấp dẫn. Itravel - lựa chọn lý tưởng cho kỳ nghỉ thoải mái và tiện nghi của bạn.";
      $this->data['seo_og_title'] = "Đặt Phòng Khách Sạn Giá Tốt, Tiện Nghi, Gần Trung Tâm | Itravel.com";
      $this->data['seo_og_desc'] = "Itravel cung cấp hàng ngàn khách sạn trong và ngoài nước, đặt phòng nhanh chóng, giá ưu đãi, dịch vụ chuyên nghiệp, hỗ trợ 24/7.";
      $this->data['seo_kw'] = "khách sạn Việt Nam, đặt khách sạn giá rẻ, khách sạn tiện nghi, đặt phòng khách sạn online, khách sạn gần trung tâm, ưu đãi khách sạn";
      $this->render("layouts/client_layout", $this->data);
   }
   public function detail($slug) {
      $hotel  = $this->HotelModel->find(htmlspecialchars($slug), "slug");
      if(!$hotel) {
         Util::loadError("404");
      }
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      $amenityCategories = $this->HotelAmenityModel->getHotelAmenityCategory(["hotel_id" => $hotel["id"]]);
      $hotelAmenities = $this->HotelAmenityModel->getAmenitiesByHotelId($hotel["id"]);

      $hotelImages = $this->HotelImageModel->where(["hotel_id" => $hotel['id']]);
      $hotel['images'] = $hotelImages;
      $this->HotelReviewModel->setLimit(5);
      $this->HotelReviewModel->setOrderBy("review_date");
      $this->HotelReviewModel->setOrder("DESC");
      $this->HotelReviewModel->setBaseModel();
      $reviews = $this->HotelReviewModel->where(['hotel_id'=> $hotel['id']], true);
      if(!empty($reviews)) {
         $reviewIds = array_column($reviews, 'id');
         $reviewImages = $this->HotelReviewImageModel->whereIn('review_id', $reviewIds);
         $reviewData = [];
         foreach ($reviews as $review) {
            foreach ($reviewImages as $image) {
               if($review['id'] === $image['review_id']) {
                  $review['images'][] = $image;
               }
            }
            $reviewData[] = $review;
         }
      }
      $page = ceil($this->HotelReviewModel->getReviewCount(['hotel_id' => $hotel['id']]) / $this->HotelReviewModel->getLimit());
      // pointer
      $reviewAverageRatings  = $this->HotelReviewModel->getReviewAverageRatings($hotel['id']);
      $breadcrumbs = [
         ['name' => "Khách sạn", "link" => "khach-san"],
         ['name' => $hotel["name"], "link" => "khach-san/".$hotel["slug"]],
      ];
      $this->data['amenityCategories'] = $amenityCategories;
      $this->data['hotelAmenities'] = $hotelAmenities;

      $this->data['totalPages'] = $page;
      $this->data['page'] ="hotel/detail";
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['hotel'] = $hotel;
      $this->data['title'] = $hotel['name'];
      $this->data['heading'] = $hotel['name'];
      $this->data['reviewData'] = $reviewData ?? $reviews;
      $this->data['totalReview'] = $this->HotelReviewModel->getReviewCount(['hotel_id' => $hotel['id']]);
      $this->data['reviewAverageRatings'] = $reviewAverageRatings;
      $this->render('layouts/client_layout', $this->data);
   }
   public function createdHotelReview() {
      if (!Request::isMethod("post")) {
         echo json_encode(Response::badRequest("Phương thức không hợp lệ", []));
         exit;
      }
      $data = Request::all("post");
      if (!Util::checkCsrfToken($data['csrf_token'])) {
         echo json_encode(Response::badRequest('Thất bại! Token không hợp lệ', []));
         exit;
      }
      unset($data['csrf_token']);
      $data['review_date'] = date("Y-m-d H:i:s");
      $data['departure_date'] = Util::formatDate($data['departure_date'], "y-m-d");
      $res = $this->HotelReviewModel->insert($data);
      if (!$res) {
         echo json_encode(Response::internalServerError('Thêm không thành công', []));
         exit;
      }
      $idLastInsert = $this->HotelReviewModel->getLastInsertId();
      $images = Request::all("file")['review_images'] ?? [];
      if(!empty($images) && isset($images['size'][0]) && $images['size'][0] > 0) {
         $checkImages = $this->processImages($idLastInsert,$images);
         if (!$checkImages['success']) {
            echo json_encode(Response::internalServerError($checkImages['msg'],[]));
            exit;
         }
      }
      echo json_encode(Response::success(("Thêm thành công")));
   }
   public function getHotelReviewAjax()  {
      $hotelId= htmlspecialchars(Request::input("hotel_id", ""));
      $tripType = htmlspecialchars(Request::input("tag", ""));
      $sortOrder = htmlspecialchars(Request::input("sortOrder", "DESC"));
      $sortBy = htmlspecialchars(Request::input("sortBy", "review_date"));
      $page = (int)htmlspecialchars(Request::input("page", "1"));
      $this->HotelReviewModel->setLimit(5);
      $this->HotelReviewModel->setOffset($page);
      $this->HotelReviewModel->setOrderBy($sortBy);   
      $this->HotelReviewModel->setOrder($sortOrder);
      $conditions = ['hotel_id' => $hotelId, "trip_type" => $tripType];
      foreach ($conditions as $key => $value) {
         if (empty($value)) {
            unset($conditions[$key]);
         }
      }
      $data = $this->HotelReviewModel->where($conditions, true);
      
      if(empty($data)) {
         echo json_encode(Response::notFound("Không có đánh giá nào", []));
         exit;
      }
      foreach ($data as $key => $review) {
         $scoreString = Util::classifyScore($review['overall_rating']);
         $data[$key]['scoreString'] = $scoreString;
      }
      $reviewIds = array_column($data, 'id');
      $reviewImages = $this->HotelReviewImageModel->whereIn('review_id', $reviewIds);
      // reviewData
      $totalPages = ceil($this->HotelReviewModel->getReviewCount($conditions) / $this->HotelReviewModel->getLimit()); 
      $reviewData = [];
      foreach ($data as $review) {
         foreach ($reviewImages as $image) {
            if($review['id'] === $image['review_id']) {
               $review['images'][] = $image;
            }
         }
         $reviewData[] = $review;
      }
      $reviewData = [
         'totalPages' => $totalPages,
         'reviews' => $reviewData
      ];
      echo json_encode(Response::success("Lấy dữ liệu thành công",$reviewData));
   }
   public function editHotelReview() {

   }
   public function filterHotelAjax() {
      if(Request::has("GET")) {
         echo json_encode(Response::methodNotAllowed("Phương thức không hợp lệ", []));
         exit;
      }
       $this->HotelModel->setLimit(100);
      $data = $this->filterData();

      $hotels = $this->HotelModel->filterHotelsByRange($data);
      if(empty($hotels)) {
         echo json_encode(Response::notFound("Không tìm thấy khách sạn nào phù hợp",["hotels"=>[]]));
         exit;
      }

      $ids = array_column($hotels, 'id');
      $conditionHotelImage = [];
      foreach($ids as $id) {
         $conditionHotelImage["hotel_id"][] = $id;
      }
      $hotelImages = $this->HotelImageModel->where($conditionHotelImage);
      $hotelAmenities = $this->HotelAmenityModel->getAmenities();

      foreach($hotels as &$hotel) {
         foreach($hotelImages as $hotelImage) {
               if($hotel['id'] === $hotelImage['hotel_id']) {
                  $hotel['images'][] = $hotelImage;
               }
         }
         foreach($hotelAmenities as $hotelAmenity) {
               if($hotel['id'] === $hotelAmenity['hotel_id']) {
                  $hotel['amenties'][] = $hotelAmenity;
               }
         }
         $hotel['scoreString'] = Util::classifyScore($hotel['avg_overall_rating']);
      }
      $responseData = [];
      $responseData['hotels'] = $hotels;
      $responseData['limit'] = $this->HotelModel->getLimit();
      echo json_encode(Response::success("Thành công", $responseData));
   }
   private function processImages($review_id, $images): array
   {
      
      $pathAsset = '/public/uploads/review/';
      $files = Util::convertListImgToArr($images);

      foreach ($files as $file) {
         $data = ["review_id" => $review_id];
         $checkCreateImgPath = Util::createImagePath($file, $pathAsset);
         if (!$checkCreateImgPath['success']) {
            return ['success' => false, 'msg' => $checkCreateImgPath['msg']];
         }
         $newImgName = $checkCreateImgPath['name'];
         $data['image'] = $newImgName;
         $res = $this->HotelReviewImageModel->insert($data);
         if (!$res) {
            return ['success' => false, 'msg' => "Cập nhật ảnh cho tour không thành công"];
         }
         $checkUploadImg = Util::uploadImage($file, $newImgName);
         if (!$checkUploadImg["success"]) {
            return ['success' => false, 'msg' => $checkUploadImg['msg']];
         }
      }
      return ["success" => true, "msg" => "Ok"];
   }
    private function filterData(): array
    {
        $dataParam = [];
        $budgetId = Request::input('budgetId', []);
        $hotelType = Request::input('hotelType', []);
        $sortRating = Request::input('sortRating', []);

        $budgetId = is_array($budgetId) ? $budgetId : explode('_', $budgetId);
        $budgetId = array_map('intval', $budgetId);

        $hotelType = is_array($hotelType) ? $hotelType : explode('_', $hotelType);
        $hotelType = array_map('intval', $hotelType);

        $sortRating = is_array($sortRating) ? $sortRating : explode('_', $sortRating);
        $sortRating = array_map('intval', $sortRating);


        foreach($budgetId as $item) {
            $dataParam["budget"][] = Util::getPriceRange($item);
        }
        foreach($sortRating as $item) {
            $dataParam["sortRating"][] = Util::getOverallRating($item);
        }
        $dataParam['hotelType'] = $hotelType;
        $allowedOrders = ['asc', 'desc'];
        $allowedOrderBy = ['price', 'rating', 'overall_rating'];
        $order = 'asc';
        if (Request::has("order", "get")) {
            $inputOrder = strtolower(Request::input("order", ""));
            if (in_array($inputOrder, $allowedOrders)) {
                $order = $inputOrder;
            }
        }

        $orderBy = 'price';
        if (Request::has("orderBy", "get")) {
            $inputOrderBy = Request::input("orderBy", "");
            if (in_array($inputOrderBy, $allowedOrderBy)) {
                $orderBy = $inputOrderBy;
            }
        }

        $this->HotelModel->setOrder($order);
        $this->HotelModel->setOrderBy($orderBy);

        if(Request::has("page" , "get"))  {
            $limitDefault = 1;
            $inputPage = strtolower(Request::input("page", "get"));
            $this->HotelModel->setLimit($inputPage * $limitDefault);
        }
        return $dataParam;
    }

}
