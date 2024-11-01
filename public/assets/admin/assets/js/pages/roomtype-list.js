$(document).ready(function () {
  var table = $('#roomTypeTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: '/roomtype/list',
      type: 'GET',
      data: function (d) {

      }
    },
    columns: [
      { data: 'id', title: 'ID' },
      { data: 'type', title: 'Tên loại phòng' },
      { data: 'title', title: 'Tiêu đề của loại phòng' },
      {
        data: 'price_per_night',
        title: 'Giá 1 đêm từ',
        render: function (data) {
          return data.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
          });
        }
      },
      {
        data: 'create_at',
        title: 'Ngày tạo',
        type: 'date',
        render: function (data) {
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
          return `
                      <a href="/admin/room-type/edit/${$id}" class="btn btn-sm btn-primary">Sửa</a>
                      <a href="/admin/room-type/copy/${$id}" class="btn btn-sm btn-secondary">Chép</a>
                      <a href="/admin/room-type/delete/${$id}" class="btn btn-sm btn-danger">Xóa bỏ</a>
                  `;
        }
      }
    ],
    order: [[0, 'asc']], // Sắp xếp mặc định theo ID
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
    pageLength: 10
  });
});
