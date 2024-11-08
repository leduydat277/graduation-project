<?php

namespace App\Http\Controllers;

class PaymentController
{
    protected $vnp_TmnCode;
    protected $vnp_HashSecret;
    protected $vnp_Url;
    protected $vnp_DefaultReturnUrl;

    public function __construct()
    {
        // Get config information from the configuration file
        $this->vnp_TmnCode = config('vnpay.vnp_TmnCode');
        $this->vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $this->vnp_Url = config('vnpay.vnp_Url');
        $this->vnp_DefaultReturnUrl = config('vnpay.vnp_Returnurl'); // Default return URL
    }

    /**Cách sử dụng
     * $oders là một mảng chứa các trường sau:
     * $order = [
        "code" => $id,
        "info" => "order_payment_$id",
        "type" => "billpayment",
        "bankCode" => "NCB",
        "total" => $price,
        ];
     * id: mã đơn hàng
        info: thông tin, thông thường tôi trả về một chuỗi order_payment_ kèm theo id đơn hàng
        type: mặc định là billpayment
        code: mặc định là NCB
        total: tổng gía cần thanh toán
    $ipAddr: IP của người dùng.
    VD: // Lấy IP của người dùng
        $ipAddr = $request->ip();
     $customReturnUrl: đường đẫn của frontend sau khi thanh toán xong

     Tài khoản để test:
     Số thẻ	9704198526191432198
     Tên chủ thẻ	NGUYEN VAN A
    Ngày phát hành	07/15
    Mật khẩu OTP	123456
     */
    public function generatePaymentUrl($order, $ipAddr, $customReturnUrl = null)
    {
        // Order and payment information
        $vnp_TxnRef = $order["code"];
        $vnp_OrderInfo = $order["info"];
        $vnp_OrderType = $order["type"];
        $vnp_Amount = $order["total"];
        $vnp_Locale = 'vn';
        $vnp_BankCode = $order["bankCode"];

        // Choose the return URL: custom or default
        $vnp_ReturnUrl = $customReturnUrl ?? $this->vnp_DefaultReturnUrl;

        // Input data to send to VNPay server
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $ipAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl, // Use the chosen return URL
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $this->vnp_Url . "?" . $query;

        if (isset($this->vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $this->vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }
}
