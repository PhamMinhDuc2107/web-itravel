<?php
class AdminUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id'=>"required|string",
            'username'    => 'string',
            'password' => 'string',
            'email' => 'email',
            "phone" => 'phone',
            "status" => "string|in:".AdminEnum::ACTIVE.",".AdminEnum::INACTIVE
        ];
    }
    public function messages(): array
   {
      return [
         'id.required'   => 'ID là trường bắt buộc',
         'id.string'   => 'Id phải là chuỗi ký tự',
         'username.string'   => 'Tên tài khoản phải là chuỗi ký tự',
         'password.string'   => 'Mật khẩu phải là chuỗi ký tự',
         'email.email'      => 'Email không hợp lệ',
         'phone.phone'      => 'Số điện thoại không hợp lệ (ví dụ: 0912345678)',
         'status.string'    => 'Trạng thái phải là chuỗi',
         'status.in'        => 'Trạng thái không hợp lệ, chỉ được phép là 1 hoặc 2',
      ];
   }

}
