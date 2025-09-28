<?php
class AdminCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'username'    => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email',
            "phone" => 'required|phone',
            "status" => "required|string|in:".AdminEnum::ACTIVE.",".AdminEnum::INACTIVE
        ];
    }
    public function messages(): array
   {
      return [
         'username.required' => 'Tên tài khoản không được để trống',
         'username.string'   => 'Tên tài khoản phải là chuỗi ký tự',

         'password.required' => 'Mật khẩu không được để trống',
         'password.string'   => 'Mật khẩu phải là chuỗi ký tự',

         'email.required'   => 'Email không được để trống',
         'email.email'      => 'Email không hợp lệ',

         'phone.required'   => 'Số điện thoại không được để trống',
         'phone.phone'      => 'Số điện thoại không hợp lệ (ví dụ: 0912345678)',

         'status.required'  => 'Trạng thái không được để trống',
         'status.string'    => 'Trạng thái phải là chuỗi',
         'status.in'        => 'Trạng thái không hợp lệ, chỉ được phép là 1 hoặc 2',
      ];
   }

}
