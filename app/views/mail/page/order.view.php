<tr style="width: 100%; background-color: #f4f4f4;">
              <td style="padding: 0 30px;">
                <h3 style="border-bottom: 1px solid #ddd; padding-bottom: 10px;">Thông tin đơn hàng</h3>
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
                  <tr>
                    <td style="padding: 8px 0;">Mã đơn hàng:</td>
                    <td style="padding: 8px 0; text-align:right"><strong><?= $data['booking_code'] ?></strong></td>
                  </tr>
                  <tr>
                    <td style="padding: 8px 0;">Tên tour:</td>
                    <td style="padding: 8px 0; text-align:right"><?= $data['tour'] ?></td>
                  </tr>
                  <tr>
                    <td style="padding: 8px 0;">Ngày khởi hành:</td>
                    <td style="padding: 8px 0; text-align:right"><?= Util::formatDate($data['departure_date']) ?></td>
                  </tr>
                  <tr>
                    <td style="padding: 8px 0;">Số lượng người lớn:</td>
                    <td style="padding: 8px 0; text-align:right"><?= $data['num_adults'] ?> người</td>
                  </tr>
                  <tr>
                    <td style="padding: 8px 0;">Số lượng người trẻ con:</td>
                    <td style="padding: 8px 0; text-align:right"><?= $data['num_children'] ?> người</td>
                  </tr>
                  <tr>
                    <td style="padding: 8px 0;">Số lượng người trẻ nhỏ:</td>
                    <td style="padding: 8px 0; text-align:right"><?= $data['num_infants'] ?> người</td>
                  </tr>
                  <tr>
                    <td style="padding: 8px 0;">Tổng giá:</td>
                    <td style="padding: 8px 0; text-align:right"><strong><?= number_format($data['total_price'],0,"",".") ?>đ</strong></td>
                  </tr>
                </table>
              </td>
            </tr>
