$(document).ready(function () {
  $('#resetFilters').on('click', function () {
    $('#create_at').val('');
    $('#start_date').val('');
    $('#end_date').val('');
    $('#customSearch').val('');

    table.columns().search('').draw();

    $('#typeFilter').val('').change();
    $('#deposit_status').val('').change();
    $('#order_status').val('').change();
  });

  $('#create_at')
    .datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      endDate: new Date() // Giới hạn ngày không được quá hôm nay
    })
    .on('changeDate', function (e) {
      // Khi ngày được chọn, cập nhật lại DataTable
      table.draw();
    });

  // Sự kiện khi thay đổi giá trị trong input
  $('#create_at').on('change', function () {
    if (!$(this).val()) {
      table.columns(7).search('').draw();
    }
  });

  $('#start_date')
    .datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    })
    .on('changeDate', function (e) {
      // Cập nhật lại DataTable
      table.draw();

      // Thiết lập maxDate cho end_date không vượt quá start_date
      $('#end_date').datepicker('setStartDate', e.date); // Ngày bắt đầu không được nhỏ hơn start_date
    });

  // Khởi tạo datepicker cho end_date
  $('#end_date')
    .datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    })
    .on('changeDate', function (e) {
      // Cập nhật lại DataTable
      table.draw();

      // Thiết lập minDate cho start_date không được lớn hơn end_date
      $('#start_date').datepicker('setEndDate', e.date); // Ngày kết thúc không được lớn hơn end_date
    });

  // Sự kiện khi thay đổi giá trị trong input
  $('#start_date').on('change', function () {
    if (!$(this).val()) {
      table.columns(1).search('').draw();
    }
  });

  $('#end_date').on('change', function () {
    if (!$(this).val()) {
      table.columns(2).search('').draw();
    }
  });

  var table = $('#bookingTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: '/booking/list', // Thay bằng API hoặc URL lấy dữ liệu JSON
      type: 'GET',
      dataSrc: 'data',
      data: function (d) {
        d.searchValue = $('#customSearch').val(); // Gửi giá trị tìm kiếm
        d.startDate = $('#start_date').val(); // Lấy giá trị từ ngày đến
        d.endDate = $('#end_date').val(); // Lấy giá trị từ ngày đi
        d.orderColumn = d.order[0].column; // Lấy chỉ số cột được sắp xếp
        d.orderDir = d.order[0].dir; // Lấy hướng sắp xếp (asc/desc)
        d.type = $('#typeFilter').val(); // Giá trị lọc từ dropdown loại phòng
        d.deposit_status = $('#deposit_status').val();
        d.order_status = $('#order_status').val();
        d.create_at = $('#create_at').val();
      }
    },
    columns: [
      { data: 'id', title: 'Mã đơn' },
      {
        data: 'check_in_date',
        title: 'Ngày đến',
        type: 'date',
        render: function (data, type, row) {
          var date = new Date(data);
          return date.toLocaleDateString('vi-VN');
        }
      },
      {
        data: 'check_out_date',
        title: 'Ngày đi',
        type: 'date',
        render: function (data, type, row) {
          var date = new Date(data);
          return date.toLocaleDateString('vi-VN');
        }
      },
      {
        data: 'total_price',
        title: 'Tổng giá',
        render: $.fn.dataTable.render.number(',', '.', 2, '₫') // Định dạng số tiền
      },
      {
        data: 'type',
        title: 'Nơi đặt',
        render: function (data) {
          switch (data) {
            case 1:
              return 'Booking Online';
            case 2:
              return 'Tại quầy';
            default:
              return 'Không xác định';
          }
        }
      },
      {
        data: 'deposit_status',
        title: 'Trạng thái cọc',
        render: function (data) {
          switch (data) {
            case 'pending':
              return 'Đang chờ khách cọc';
            case 'paid':
              return 'Đã cọc';
            case 'refunded':
              return 'Đã hoàn trả lại cọc';
            default:
              return 'Không xác định';
          }
        }
      },
      {
        data: 'status',
        title: 'Trạng thái của đơn hàng',
        render: function (data, type, row) {
          return `
                <span class="badge" style="background-color: ${data.color}; color: #fff;">
                    ${data.name}
                </span>`;
        }
      },
      {
        data: 'create_at',
        title: 'Ngày tạo',
        render: function (data, type, row) {
          var date = new Date(data);
          return date.toLocaleDateString('vi-VN');
        }
      },
      {
        data: null,
        title: 'Hành động',
        orderable: false,
        render: function (full) {
          var $id = full['id'];
          return `<a href="/booking/detail/${$id}" class="btn btn-sm btn-primary detail-btn">Chi tiết</a>`;
        }
      }
    ],
    order: [[0, 'asc']], // Sắp xếp mặc định theo cột Mã đơn
    language: {
      lengthMenu: 'Hiển thị _MENU_ dòng mỗi trang',
      zeroRecords: 'Không tìm thấy kết quả',
      info: 'Trang _PAGE_ / _PAGES_',
      infoEmpty: 'Không có dữ liệu',
      infoFiltered: '(lọc từ _MAX_ dòng)',
      paginate: {
        next: 'Tiếp',
        previous: 'Trước'
      }
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
        .columns(4) // Cột thứ 6 (type)
        .every(function () {
          var column = this;
          var select = $(
            '<select id="typeFilter" class="form-select text-capitalize"><option value="">Nơi đặt</option></select>'
          )
            .appendTo('.product_status')
            .on('change', function () {
              var val = $(this).val();
              column.search(val ? '^' + val + '$' : '', true, false).draw();
            });

          // Lấy các giá trị duy nhất từ dữ liệu trong cột và tạo option động
          column
            .data()
            .unique()
            .sort()
            .each(function (d) {
              let displayText = d == 1 ? 'Booking Online' : 'Tại quầy'; // Hiển thị nhãn dựa trên giá trị
              select.append(
                '<option value="' + d + '">' + displayText + '</option>'
              );
            });
        });
      this.api()
        .columns(5) // Cột thứ 6 (trạng thái cọc)
        .every(function () {
          var column = this;
          var select = $(
            '<select id="deposit_status" class="form-select text-capitalize">' +
              '<option value="">Trạng thái cọc</option>' +
              '</select>'
          )
            .appendTo('.booking_status')
            .on('change', function () {
              var val = $(this).val();
              column.search(val ? '^' + val + '$' : '', true, false).draw();
            });

          column
            .data()
            .unique()
            .sort()
            .each(function (data) {
              let displayName;
              switch (data) {
                case 'pending':
                  displayName = 'Đang chờ khách cọc';
                  break;
                case 'paid':
                  displayName = 'Đã cọc';
                  break;
                case 'refunded':
                  displayName = 'Đã hoàn trả lại cọc';
                  break;
                default:
                  displayName = 'Không xác định';
              }
              select.append(
                '<option value="' + data + '">' + displayName + '</option>'
              );
            });
        });
      this.api()
        .columns(6) // Cột trạng thái của đơn hàng
        .every(function () {
          var column = this;

          // Tạo dropdown cho lọc trạng thái
          var select = $(
            '<select id="order_status" class="form-select text-capitalize">' +
              '<option value="">Trạng thái của đơn hàng</option>' +
              '</select>'
          )
            .appendTo('.status_book') // Thêm vào container .status_book
            .on('change', function () {
              var val = $(this).val();
              // Lọc theo giá trị chính xác
              column
                .search(
                  val ? '^' + $.fn.dataTable.util.escapeRegex(val) + '$' : '',
                  true,
                  false
                )
                .draw();
            });

          // Mảng để lưu trạng thái duy nhất
          var uniqueStatuses = {};

          column
            .data()
            .unique()
            .sort()
            .each(function (data) {
              if (!uniqueStatuses[data.id]) {
                uniqueStatuses[data.id] = true; // Đánh dấu trạng thái đã được thêm
                select.append(
                  '<option value="' + data.id + '">' + data.name + '</option>' // Sử dụng id và name
                );
              }
            });
        });
    }
  });

  // Chức năng chọn tất cả checkbox
  $('#checkAll').on('click', function () {
    var rows = $('#bookingTable')
      .DataTable()
      .rows({ search: 'applied' })
      .nodes();
    $('input[type="checkbox"]', rows).prop('checked', this.checked);
  });

  $('#customSearch').on('keyup', function () {
    table.search(this.value).draw();
  });
});
