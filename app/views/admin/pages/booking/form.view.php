<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3><?php echo $data["title"] ?? "" ?></h3>
                   <?php if (Request::input("msg") !== null) : ?>
                       <span class="<?php echo Request::input('type') === "error" ? "text-warning" : "text-success" ?> card-header"
                             style="padding-top: 5px; padding-bottom:5px"><?php echo htmlspecialchars(Request::input('msg')) ?></span>
                   <?php endif; ?>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo _WEB_ROOT . "/dashboard/booking-update-post" ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo Session::get("csrf_token") ?>">
                        <input type="hidden" name="id" value="<?php echo $data['booking']['id'] ?? "" ?>">
                        <div class="mb-3">
                            <label for="parent" class="form-label">Chọn tour</label>
                            <div class="dropdown">
                                <input class="form-control" type="text" value="<?php foreach ($data['tours'] as $item) {
                                    if($item['id']==$data['booking']['tour_id']){
                                        echo $item['name'];
                                        break;
                                    }
                                } ?>"  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" readonly/>
                                <input type="hidden" name="tour_id" class="parentId" value="<?php echo $data['booking']['tour_id']?>">
                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                                   <?php if(!empty($data['tours'])) : ?>
                                      <?php foreach ($data['tours'] as $item):?>
                                           <li><a class="dropdown-item"  data-value="<?php echo$item['id']?>"><?php echo $item['name']?></a></li>
                                      <?php endforeach;?>
                                   <?php endif;?>
                                </ul>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Tên khách hàng</label>
                            <input type="text" class="form-control" name="customer_name"
                                   value="<?php echo htmlspecialchars($data['booking']['customer_name']) ?? ""; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="customer_email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="customer_email"
                                   value="<?php echo  htmlspecialchars($data['booking']['customer_email']) ?? ""; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="customer_phone"
                                   value="<?php echo  htmlspecialchars($data['booking']['customer_phone']) ?? ""; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Ngày khởi hành</label>
                            <input type="text" class="form-control flatpickr-input" name="departure_date"
                                   value="<?php echo  htmlspecialchars($data['booking']['departure_date']) ?? ""; ?>">
                        </div>
                        <script>
                            flatpickr(".flatpickr-input", {
                                dateFormat: "Y-m-d",
                                minDate: new Date(),
                            });
                        </script>
                        <div class="mb-3">
                            <label for="num_adults" class="form-label">Người lớn </label>
                            <input type="text" class="form-control" name="num_adults"
                                   value="<?php echo  htmlspecialchars($data['booking']['num_adults']) ?? ""; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="num_children" class="form-label">Trẻ em </label>
                            <input type="text" class="form-control" name="num_children"
                                   value="<?php echo  htmlspecialchars($data['booking']['num_children']) ?? ""; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="num_infants" class="form-label">Trẻ nhỏ </label>
                            <input type="text" class="form-control" name="num_infants"
                                   value="<?php echo  htmlspecialchars($data['booking']['num_infants']) ?? ""; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Tổng giá tiền</label>
                            <input type="text" class="form-control" name="total_price"
                                   value="<?php echo  number_format(htmlspecialchars($data['booking']['total_price'] ?? 0), 0, '.', ','); ?>">
                        </div>
                        <div class="mb-3">
                            <textarea id="w3review" name="notes" class="form-control" rows="5"> <?php echo $data['booking']['notes'] ?? ""; ?>
                            </textarea>
                        </div>
                        <div class="mt-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <input type="radio" name="status" id="cancelled" value="0"  <?php echo $data['booking']['status'] === 'cancelled' ? "checked" :""?>>
                            <label for="cancelled" id="cancelled" name="status" class="form-label badge badge-sm bg-gradient-secondary">
                                cancelled
                            </label>
                            <input type="radio" name="status" id="pending" value="1" <?php echo $data['booking']['status'] === 'pending' ? "checked" :""?>>
                            <label for="pending" id="status" name="status" class="form-label badge badge-sm bg-gradient-warning">
                                pending
                            </label>
                            <input type="radio" name="status" id="confirmed" value="2"  <?php echo $data['booking']['status'] === 'confirmed' ? "checked" :""?>>

                            <label for="confirmed" id="status" name="status" class="form-label badge badge-sm bg-gradient-success">
                                confirmed
                            </label>
                        </div>
                        <div class="mt-3">
                            <label for="status" class="form-label">Trạng thái thanh toán</label>
                            <input type="radio" name="payment_status" id="refunded" value="0"  <?php echo $data['booking']['payment_status'] === 'refunded' ? "checked" :""?>>
                            <label for="refunded" id="status" name="status_payment" class="form-label badge badge-sm bg-gradient-secondary">
                                refunded
                            </label>
                            <input type="radio" name="payment_status" id="unpaid" value="1" <?php echo $data['booking']['payment_status'] === 'unpaid' ? "checked" :""?>>
                            <label for="unpaid" id="status" name="status_payment" class="form-label badge badge-sm bg-gradient-warning">
                                unpaid
                            </label>
                            <input type="radio" name="payment_status" id="paid" value="2"  <?php echo $data['booking']['payment_status'] === 'paid' ? "checked" :""?>>

                            <label for="paid" id="status" name="status" class="form-label badge badge-sm bg-gradient-success">
                                paid
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let dropdowns = document.querySelectorAll('.dropdown');
        if(dropdowns) {
            dropdowns.forEach((dropdown) => {
                let input = dropdown.querySelector('input');
                let dropdownMenu = dropdown.querySelector(".dropdown-menu");
                let inputParent = dropdown.querySelector('.parentId');
                if(dropdownMenu) {
                    dropdownMenu.addEventListener('click', (e) => {
                        if (e.target.classList.contains('dropdown-item')) {
                            inputParent.value = e.target.dataset.value;
                            input.value = e.target.textContent;
                        }
                    });
                }
            });
        }
    })
</script>