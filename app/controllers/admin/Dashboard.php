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
            Util::redirect("cpanel/login",['invalid' => "Thất bại! Token không hợp lệ"]);
         }
      }

      public function index() {
         $user = $this->jwt->checkAuth("token_auth");
         if (!$user) {
            Util::redirect("cpanel/login");
            exit;
         }
         $this->data['page']= 'index';
         $this->data['title'] = "Dashboard";
         $this->data['admin'] = $user->data;
         $this->render("layouts/admin_layout", $this->data);
      }
      public function login() {
         $admin = $this->jwt->checkAuth("token_auth");
         if ($admin) {
            Util::redirect("cpanel/");
            exit;
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
               Util::redirect("cpanel/login", ['invalid' => "Tài khoản của bạn chưa được kích hoạt"]);
            }
            if(empty($admin) || !password_verify($password, $admin['password'])) {
               Util::redirect("cpanel/login", ["invalid" => "Tài khoản mật khẩu sai"]);
            }

            $payload = $this->jwt->generatePayload($admin, $remember);
            $token = $this->jwt->encode($payload);

            setcookie('token_auth', $token, $remember ? time() + (30 * 24 * 60 * 60) : 0, '/', null, true, true);
            Session::set("username", $admin['username']);
            Util::redirect("cpanel");
         }
      }
      public function logout() {
         setcookie('token_auth', '', time() - 3600, '/', "", true, true);
         Util::redirect("cpanel/login");
      }
   }
?>