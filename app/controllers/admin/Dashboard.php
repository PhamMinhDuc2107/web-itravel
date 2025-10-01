<?php



class Dashboard extends Controller
{
   private $data;
   private $AdminModel;
   private $BookingModel;
   private $ConsultationModel;
   private $jwt;
   private $error = [];
   public function __construct()
   {
      $this->AdminModel = $this->model("AdminModel");
      $this->BookingModel = $this->model("BookingModel");
      $this->ConsultationModel = $this->model("ConsultationModel");
      $this->jwt = new JwtUtil();
      if (!Util::checkCsrfToken()) {
         Util::redirect("dashboard/category", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index()
   {
      $admin = $this->jwt->checkAuth("token_auth");
      if (!$admin['success']) {
         FlashMessage::warning("auth","Vui lòng đăng nhập lại");
         Util::redirect("dashboard/login");
      }
      $month = htmlspecialchars(Request::input("month"));
      if ($month > date('m') || !is_numeric($month)) {
         $month = date('m');
      }
      $totalPriceMonth = $this->BookingModel->getMonthlyBookingSummary($month);
      $totalPriceDay = $this->BookingModel->getDailyBookingRevenue($month);
      $totalConsultation = $this->ConsultationModel->getTotalConsultation();
      $this->data['page'] = 'index';
      $this->data['title'] = "Dashboard";
      $this->data['admin'] = $admin['payload'];
      $this->data['month'] = $month;
      $this->data['totalPriceMonth'] = $totalPriceMonth;
      $this->data['totalPriceDay'] = $totalPriceDay;
      $this->data['totalConsultation'] = $totalConsultation;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function login()
   {
      $admin = $this->jwt->checkAuth("token_auth");
      if ($admin !== null && $admin['success']) {
         Util::redirect("dashboard/");
      }
      $this->data['title'] = 'Login';
      $this->render("layouts/admin_login_layout", $this->data);
   }
   public function loginPost()
   {
      if (Request::isMethod("POST")) {
         $request = new LoginRequest($_POST);

         if ($request->fails()) {
            FlashMessage::error("auth",$request->errors());
            Util::redirect("dashboard/login");
         }
         $data = $request->validated();
         $username = $data['username'];
         $password = $data['password'];
         $remember = $data['remember'] ? 1 : 0;
         $admin = $this->AdminModel->find($username, "username");
         if ($admin['status'] != 1) {
            FlashMessage::warning("auth","Tài khoản chưa được kích hoạt. Vui lòng liên hệ admin");
            Util::redirect("dashboard/login");
         }
         if (empty($admin) || !password_verify($password, $admin['password'])) {
            FlashMessage::error("auth","Mật khẩu hoặc tài khoản sai");
            Util::redirect("dashboard/login");
         }
         $payload = $this->jwt->generatePayload($admin, $remember);
         $token = $this->jwt->encode($payload);
         setcookie(
            'token_auth',
            $token,
            $payload['exp'],
            '/',
            null,
            true,
            false
         );
         FlashMessage::success("auth","Đăng nhập thành công");
         Util::redirect("dashboard");
      }
   }
   public function logout()
   {
      setcookie('token_auth', '', time() - 30 * 24 * 60 * 60, '/', "", true, true);
      FlashMessage::success("auth","Đăng xuất thành công");
      Util::redirect("dashboard/login");
   }
   public function uploadImage()
   {
       $file = Request::file("file");
       header('Content-Type: application/json');

       if (!$file || empty($file['name']) || ($_FILES['file']['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
           echo json_encode(['error' => 'Không có ảnh hợp lệ được gửi lên.']);
           return;
       }
       if(!Request::isMethod("POST")) {
           header( "HTTP/1.1 405 Method Not Allowed" );
           echo json_encode(Response::methodNotAllowed("Phương thức không hợp lệ"));
           return;
       }
       $pathAsset = '/public/uploads/images/';
       $checkCreateImgPath = Util::createImagePath($file, $pathAsset);
       if (!$checkCreateImgPath["success"]) {
           header( "HTTP/1.1 400 Invalid ". $checkCreateImgPath["msg"]);

           echo json_encode(Response::badRequest($checkCreateImgPath['msg']));
           return;
       }
       $checkUpload = Util::uploadImage($file, $checkCreateImgPath['name']);
       if (!$checkUpload["success"]) {
           header( "HTTP/1.1 400 Invalid ".+$checkUpload["msg"]);
           echo json_encode(Response::badRequest($checkUpload['msg']));
           return;
       }

       echo json_encode(array('location' => _WEB_ROOT.$checkCreateImgPath['name']),JSON_UNESCAPED_SLASHES);
   }
}
