<?php
class LoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'username'    => 'required|string',
            'password' => 'required|string',
            "remember" => 'boolean'
        ];
    }
    public function messages(): array
    {
        return [
            'username.required' => 'Tên tài khoản không được để trống',
            'password.required'   => 'Số điện thoại không được để trống',
            // 'password.min'  => 'Mật khẩu tối thiểu 6 ký tự',
        ];
    }
}
