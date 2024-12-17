@extends('client.layouts.master')

@section('title')
Điều khoản
@endsection

@section('content')
@include('client.layouts.banner.banner')

<section class="padding-small">
    <div class="container-fluid padding-side">
        <div class="row g-lg-5 my-4">
            <main class="col-lg-12">
                <h4 class="display-6 fw-normal my-3">Điều khoản thường gặp</h4>
                <p>Các vấn đề thường gặp khi sử dụng dịch vụ bao gồm việc hủy phòng, đặt cọc, và quy trình check-in/check-out. Chúng tôi cam kết cung cấp thông tin rõ ràng để hỗ trợ khách hàng tốt nhất trong quá trình sử dụng dịch vụ.</p>
                <div class="page-content my-5">

                    <div class="accordion" id="accordion-box">
                        <div class="accordion-item mt-3 rounded-4">
                            <div class="accordion-header rounded-4 border-0" id="heading-one">
                                <button class="accordion-button rounded-4" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                    <h3 class="accordion-title fs-5 fw-bold m-0">Chính sách hủy phòng</h3>
                                </button>
                            </div>
                            <div id="collapse-one" class="accordion-collapse collapse show" aria-labelledby="heading-one">
                                <div class="accordion-body">
                                    <div class="faqs-box">
                                        <div class="element-box margin-xsmall d-flex align-items-center">
                                            <div class="item-title" id="chinh_sach_huy_phong">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mt-3 rounded-4">
                            <div class="accordion-header rounded-4" id="heading-two">
                                <button class="accordion-button rounded-4 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse-two" aria-expanded="false"
                                    aria-controls="collapse-two">
                                    <h3 class="accordion-title fs-5 fw-bold m-0">Đặt cọc</h3>
                                </button>
                            </div>
                            <div id="collapse-two" class="accordion-collapse collapse" aria-labelledby="heading-two">
                                <div class="accordion-body">
                                    <div class="faqs-box">
                                        <div class="element-box margin-xsmall d-flex align-items-center">
                                            <div class="item-title" id="dat_coc"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mt-3 rounded-4">
                            <div class="accordion-header rounded-4" id="heading-three">
                                <button class="accordion-button rounded-4 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse-three" aria-expanded="false"
                                    aria-controls="collapse-three">
                                    <h3 class="accordion-title fs-5 fw-bold m-0">Thời gian check-in check-out</h3>
                                </button>
                            </div>
                            <div id="collapse-three" class="accordion-collapse collapse"
                                aria-labelledby="heading-three">
                                <div class="accordion-body">
                                    <div class="faqs-box">
                                        <div class="element-box margin-xsmall d-flex align-items-center">
                                            <div class="item-title" id="thoi_gian_check_in_va_check_out"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mt-3 rounded-4">
                            <div class="accordion-header rounded-4" id="heading-four">
                                <button class="accordion-button rounded-4 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse-four" aria-expanded="false"
                                    aria-controls="collapse-four">
                                    <h3 class="accordion-title fs-5 fw-bold m-0">Quy định khác</h3>
                                </button>
                            </div>
                            <div id="collapse-four" class="accordion-collapse collapse" aria-labelledby="heading-four">
                                <div class="accordion-body">
                                    <div class="faqs-box">
                                        <div class="element-box margin-xsmall d-flex align-items-center">
                                            <div class="item-title" id="quy_dinh_khac"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="module">
    $.ajax({
        url: "/api/policy",
        type: "GET",
        dataType: "json",
        success: function(data) {
            console.log("Dữ liệu policy (trước khi xử lý):", data);
            const jsonString = data.data[0].value;

            try {
                const jsonObject = JSON.parse(jsonString);

                const chinhSachHuyPhong = jsonObject.chinh_sach.chinh_sach_nguoi_dung.chinh_sach_huy_phong;
                const datCoc = jsonObject.chinh_sach.chinh_sach_nguoi_dung.dat_coc;
                const quyDinhKhac = jsonObject.chinh_sach.chinh_sach_nguoi_dung.quy_dinh_khac;
                const thoiGianCheckInCheckOut = jsonObject.chinh_sach.chinh_sach_nguoi_dung.thoi_gian_check_in_va_check_out;

                console.log("Dữ liệu policy (sau khi parse):", quyDinhKhac);

                let huyPhongContent = `
                    <p><strong>Hủy trong vòng 1 giờ:</strong> ${chinhSachHuyPhong.huy_trong_vong_1_gio}</p>
                    <p><strong>Hủy trước 12h ngày check-in:</strong> ${chinhSachHuyPhong.huy_truoc_12h_ngay_check_in}</p>
                    <p><strong>Hủy sau 12h ngày check-in:</strong> ${chinhSachHuyPhong.huy_sau_12h_ngay_check_in}</p>
                    <p><strong>Không check-in trước 21h ngày check-in:</strong> 
                        <ul>
                            <li><strong>Trạng thái:</strong> ${chinhSachHuyPhong.khong_check_in_truoc_21h_ngay_check_in.trang_thai}</li>
                            <li><strong>Hoàn tiền:</strong> ${chinhSachHuyPhong.khong_check_in_truoc_21h_ngay_check_in.hoan_tien}</li>
                        </ul>
                    </p>
                    <p><strong>Quy trình:</strong> ${chinhSachHuyPhong.quy_trinh}</p>
                `;
                $("#chinh_sach_huy_phong").html(huyPhongContent);

                let datCocContent = `
                    <p><strong>Chính sách đặt cọc:</strong> ${datCoc.gia_tri}</p>
                `;
                $("#dat_coc").html(datCocContent);

                let quyDinhKhacContent = `
                    <p><strong>Quy định khác:</strong> ${quyDinhKhac.giai_quyet_tranh_chap}</p>
                `;
                $("#quy_dinh_khac").html(quyDinhKhacContent);

                let thoiGianCheckInCheckOutContent = `
                    <p><strong>Thời gian check-in:</strong> ${thoiGianCheckInCheckOut.check_in}</p>
                    <p><strong>Thời gian check-out:</strong> ${thoiGianCheckInCheckOut.check_out}</p>
                `;
                $("#thoi_gian_check_in_va_check_out").html(thoiGianCheckInCheckOutContent);

            } catch (error) {
                console.error("Lỗi khi parse JSON:", error);
                $(".item-title").text("Không thể tải dữ liệu.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Lỗi khi gọi API:", status, error);
            $(".item-title").text("Không thể tải dữ liệu.");
        },
    });
</script>
@endsection