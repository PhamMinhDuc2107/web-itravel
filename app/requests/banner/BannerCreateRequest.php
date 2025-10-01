<?php

class BannerCreateRequest extends BaseRequest
{
   public function rules(): array
   {
      return [
         "title"  => "required|string|max:255",
         "image"  => "required|file|image|mimes:jpg,jpeg,png,gif",
         "status" => "required|in:0,1",
         "order"  => "nullable|integer|min:0"
      ];
   }

   public function messages(): array
   {
      return [
         "title.required"  => "Vui lòng nhập tiêu đề",
         "image.required"  => "Vui lòng chọn ảnh",
         "image.image"     => "File phải là hình ảnh",
         "status.required" => "Vui lòng chọn trạng thái",
      ];
   }
}
