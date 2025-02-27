<?php



class Dashboard extends Controller{
      private $data;
      private $AdminModel;
      private $jwt;
      public function __construct()
      {
         $this->AdminModel = $this->model("AdminModel");
         $this->jwt = new JwtUtil();
         if(!Util::checkCsrfToken()) {
            Util::redirect("cpanel/category",Response::forbidden("Thất bại! Token không hợp lệ"));
         }
      }
      public function index() {
         $admin = $this->jwt->checkAuth("token_auth");
         if (!$admin['success']) {
            Util::redirect("cpanel/login",Response::unauthorized($admin['msg']));
         }
         $this->data['page']= 'index';
         $this->data['title'] = "Dashboard";
         $this->data['admin'] = $admin['payload'];
         $this->render("layouts/admin_layout", $this->data);
      }
      public function login() {
         $admin = $this->jwt->checkAuth("token_auth");
         if ($admin['success']) {
            Util::redirect("cpanel/");
         }
         $this->data['title']= 'Login';
         $this->render("layouts/admin_login_layout", $this->data);
      }
      public function loginPost() {
         if(Request::isMethod("POST"))  {
            $username = Request::input("username", "");
            $password = Request::input("password", "");
            $remember = isset($_POST['remember']) ? 1 : 0;
            $admin = $this->AdminModel->find($username, "username");
            if ($admin['status'] != 1) {
               Util::redirect("cpanel/login", Response::badRequest("Tài khoản của bạn chưa kích hoạt vui lòng liên hệ admin"));
            }
            if(empty($admin) || !password_verify($password, $admin['password'])) {
               Util::redirect("cpanel/login", Response::badRequest("Tài khoản hoặc mật khẩu sai"));
            }
            $payload = $this->jwt->generatePayload($admin, $remember);
            $token = $this->jwt->encode($payload);
            setcookie('token_auth', $token, $payload['exp'], '/', null, true, true);
            Util::redirect("cpanel");
         }
      }
      public function logout() {
         setcookie('token_auth', '', time() - 30 * 24 * 60 *60, '/', "", true, true);
         Util::redirect("cpanel/login");
      }
   }
?>
