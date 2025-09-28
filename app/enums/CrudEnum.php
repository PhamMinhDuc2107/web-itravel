<?php
enum CrudEnum: string
{
    case CREATE_SUCCESS = 'Tạo thành công';
    case CREATE_FAIL    = 'Tạo không thành công';

    case UPDATE_SUCCESS = 'Cập nhật thành công';
    case UPDATE_FAIL    = 'Cập nhật không thành công';

    case DELETE_SUCCESS = 'Xóa thành công';
    case DELETE_FAIL    = 'Xóa không thành công';

    case INVALID_METHOD = "Phương thức không hợp lệ";
    case EXISTS         = 'Đã tồn tại';
    case NOT_FOUND      = 'Không tìm thấy';

    public function withEntity(string $entity): string
    {
        return str_replace(['Tạo','Cập nhật','Xóa'], 
                           ['Tạo '.$entity,'Cập nhật '.$entity,'Xóa '.$entity],
                           $this->value);
    }

    public function addMessage(string $extra): string
    {
        return $this->value .' - ' .$extra ;
    }
}
