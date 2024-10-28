$(document).ready(function () {
    // Khởi tạo datepicker cho các trường ngày
    $("#start_date")
        .datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
        })
        .on("changeDate", function (e) {
            // Khi ngày được chọn, cập nhật lại DataTable
            table.draw();
        });

    $("#end_date")
        .datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
        })
        .on("changeDate", function (e) {
            // Khi ngày được chọn, cập nhật lại DataTable
            table.draw();
        });

    var table = $("#bookingTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/booking/list", // Thay bằng API hoặc URL lấy dữ liệu JSON
            type: "GET",
            dataSrc: "data",
            data: function (d) {
                d.searchValue = $("#customSearch").val(); // Gửi giá trị tìm kiếm
                d.startDate = $("#start_date").val(); // Lấy giá trị từ ngày đến
                d.endDate = $("#end_date").val(); // Lấy giá trị từ ngày đi
                d.orderColumn = d.order[0].column; // Lấy chỉ số cột được sắp xếp
                d.orderDir = d.order[0].dir; // Lấy hướng sắp xếp (asc/desc)
                d.type = $("#typeFilter").val(); // Giá trị lọc từ dropdown loại phòng
                d.status = $("#statusFilter").val();
                console.log(d.status);
            },
        },
        columns: [
            { data: "id", title: "Mã đơn" },
            { data: "user.name", title: "Khách hàng" }, // Tên khách hàng
            {
                data: "total_price",
                title: "Tổng giá",
                render: $.fn.dataTable.render.number(",", ".", 2, "₫"), // Định dạng số tiền
            },
            {
                data: "check_in_date",
                title: "Ngày đến",
                type: "date",
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString("vi-VN");
                },
            },
            {
                data: "check_out_date",
                title: "Ngày đi",
                type: "date",
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString("vi-VN");
                },
            },
            {
                data: "type",
                title: "Nơi đặt",
                render: function (data) {
                    switch (data) {
                        case 1:
                            return "Booking Online";
                        case 2:
                            return "Tại quầy";
                        default:
                            return "Không xác định";
                    }
                },
            },
            {
                data: "deposit_status",
                title: "Trạng thái cọc",
                render: function (data) {
                    switch (data) {
                        case "pending":
                            return "Đang chờ khách cọc";
                        case "paid":
                            return "Đã cọc";
                        case "refunded":
                            return "Đã hoàn trả lại cọc";
                        default:
                            return "Không xác định";
                    }
                },
            },
            {
                data: "status_id",
                title: "Trạng thái của đơn hàng",
                render: function (data) {
                    switch (data) {
                        case 1:
                            return "Hoạt động";
                        case 2:
                            return "Bị khóa";
                        case 3:
                            return "Phòng trống";
                        case 4:
                            return "Đã thanh toán";
                        default:
                            return "Không xác định";
                    }
                },
            }, // Tên trạng thái
            {
                data: "create_at",
                title: "Ngày tạo",
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString("vi-VN");
                },
            },
            {
                data: null,
                title: "Hành động",
                orderable: false,
                render: function (full) {
                    var $id = full["id"];
                    return `<a href="/admin/booking/detail/${$id}" class="btn btn-sm btn-primary detail-btn">Chi tiết</a>`;
                },
            },
        ],
        order: [[0, "asc"]], // Sắp xếp mặc định theo cột Mã đơn
        language: {
            lengthMenu: "Hiển thị _MENU_ dòng mỗi trang",
            zeroRecords: "Không tìm thấy kết quả",
            info: "Trang _PAGE_ / _PAGES_",
            infoEmpty: "Không có dữ liệu",
            infoFiltered: "(lọc từ _MAX_ dòng)",
            paginate: {
                next: "Tiếp",
                previous: "Trước",
            },
        },
        pageLength: 10, // Số lượng bản ghi mặc định mỗi trang
        searching: false,
        createdRow: function (row, data, dataIndex) {
            // Nếu status_id = 2 thì thêm lớp CSS để gạch đỏ qua
            if (data.status_id === 2) {
                $(row).addClass('text-danger'); // Thêm lớp CSS màu đỏ
                $(row).css('text-decoration', 'line-through'); // Gạch qua
            }
        },
        initComplete: function () {
            // Tạo dropdown lọc cho cột "Loại đặt phòng"
            this.api()
                .columns(5) // Cột thứ 6 (type)
                .every(function () {
                    var column = this;
                    var select = $(
                        '<select id="typeFilter" class="form-select text-capitalize"><option value="">Nơi đặt</option></select>'
                    )
                        .appendTo(".product_status")
                        .on("change", function () {
                            var val = $(this).val();
                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    // Lấy các giá trị duy nhất từ dữ liệu trong cột và tạo option động
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d) {
                            let displayText =
                                d == 1 ? "Booking Online" : "Tại quầy"; // Hiển thị nhãn dựa trên giá trị
                            select.append(
                                '<option value="' +
                                    d +
                                    '">' +
                                    displayText +
                                    "</option>"
                            );
                        });
                });
        },
    });

    // Chức năng chọn tất cả checkbox
    $("#checkAll").on("click", function () {
        var rows = $("#bookingTable")
            .DataTable()
            .rows({ search: "applied" })
            .nodes();
        $('input[type="checkbox"]', rows).prop("checked", this.checked);
    });

    $("#customSearch").on("keyup", function () {
        table.search(this.value).draw();
    });
});
