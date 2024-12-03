import 'https://code.jquery.com/jquery-3.6.0.min.js';
import 'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js';

const ctx = document.getElementById('revenueChart').getContext('2d');
$.get('/api/dashboard', function (data) {
  const months = [
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'Jun',
    'Jul',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec'
  ];

  // Khởi tạo dữ liệu cho các tháng
  const earningsData = months.map((_, index) => {
    const monthYear = `2024-${(index + 1).toString().padStart(2, '0')}`; // Định dạng YYYY-MM
    return data.earnings[monthYear] || 0; // Lấy giá trị theo tháng (YYYY-MM)
  });

  const ordersData = months.map((_, index) => {
    const monthYear = `2024-${(index + 1).toString().padStart(2, '0')}`;
    return data.orders[monthYear] || 0;
  });

  const refundsData = months.map((_, index) => {
    const monthYear = `2024-${(index + 1).toString().padStart(2, '0')}`;
    return data.canceled[monthYear] || 0;
  });

  const maxEarningsData = Math.max(...earningsData);
  const maxOrdersData = Math.ceil(Math.max(...ordersData));

  let doanhthuChart;
  let orderChart;
  let isRevenueChart = false;

  doanhthuChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: months,
      datasets: [
        {
          label: 'Doanh thu',
          type: 'bar',
          backgroundColor: 'rgba(46, 204, 113, 0.6)',
          borderColor: 'rgba(46, 204, 113, 1)',
          borderWidth: 1,
          data: earningsData
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          max: maxEarningsData
        }
      },
      plugins: {
        legend: {
          display: true,
          labels: {
            color: '#000'
          }
        }
      }
    }
  });

  document.getElementById('changeChartBtn').addEventListener('click', () => {
    if (isRevenueChart) {
      if (orderChart) {
        orderChart.destroy();
      }

      doanhthuChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: months,
          datasets: [
            {
              label: 'Doanh thu',
              type: 'bar',
              backgroundColor: 'rgba(46, 204, 113, 0.6)',
              borderColor: 'rgba(46, 204, 113, 1)',
              borderWidth: 1,
              data: earningsData
            }
          ]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              max: maxEarningsData
            }
          },
          plugins: {
            legend: {
              display: true,
              labels: {
                color: '#000'
              }
            }
          }
        }
      });

      document.getElementById('changeChartBtn').textContent =
        'Thống kê số lượng đặt và hủy theo tháng';

      isRevenueChart = false;
    } else {
      if (doanhthuChart) {
        doanhthuChart.destroy();
      }

      orderChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: months,
          datasets: [
            {
              label: 'Đặt thành công',
              data: ordersData,
              backgroundColor: 'rgba(46, 134, 193, 0.2)',
              borderColor: 'rgba(46, 134, 193, 1)',
              borderWidth: 2
            },
            {
              label: 'Hủy',
              data: refundsData,
              backgroundColor: 'rgba(255, 99, 132, 0.2)',
              borderColor: 'rgba(255, 99, 132, 1)',
              borderWidth: 2
            }
          ]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              max: Math.ceil(maxOrdersData)
            }
          },
          plugins: {
            legend: {
              display: true,
              labels: {
                color: '#000'
              }
            }
          }
        }
      });

      document.getElementById('changeChartBtn').textContent =
        'Thống kê doanh thu theo tháng';

      isRevenueChart = true;
    }
  });
});

function createProgress(selector, percentage) {
  const bar = new ProgressBar.Line(selector, {
    strokeWidth: 6,
    color: '#007bff',
    trailColor: '#e0e0e0',
    duration: 1400,
    text: { value: `${percentage}%`, style: { color: '#000' } }
  });
  bar.animate(percentage / 100);
  document.querySelector(selector).classList.add('progress-bar');
}

// Fetch dữ liệu từ API
fetch('/api/getWeeks')
  .then(response => response.json())
  .then(data => {
    if (data.type === 'success') {
      const weeks = data.data.map(week => week.week);
      const earnings = data.data.map(week => week.earnings);
      const ctx = document
        .getElementById('weeklyEarningsChart')
        .getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: weeks,
          datasets: [
            {
              label: 'Doanh thu (VNĐ)',
              data: earnings,
              backgroundColor: '#42A5F5',
              borderColor: '#1E88E5',
              borderWidth: 1,
              barThickness: 30
            }
          ]
        },
        options: {
          indexAxis: 'y', // Biểu đồ dạng thanh ngang
          responsive: true,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              callbacks: {
                label: function (tooltipItem) {
                  return `${tooltipItem.raw.toLocaleString()} VNĐ`;
                }
              }
            }
          },
          scales: {
            x: {
              beginAtZero: true,
              ticks: {
                callback: function (value) {
                  return value.toLocaleString();
                }
              }
            }
          }
        }
      });
    }
  })
  .catch(error => console.error('Error:', error));

$(document).ready(function () {
  $('#countRoomOrders').DataTable({
    serverSide: true,
    searching: false,
    ajax: {
      url: '/api/countRoomOrders',
      method: 'GET',
      data: function (d) {
        return $.extend({}, d, {});
      },
      dataSrc: function (json) {
        return json.data;
      },
      error: function () {
        alert('Lỗi khi tải dữ liệu từ API');
      }
    },
    pageLength: 5,
    lengthMenu: [5, 10, 25, 50],
    columns: [
      {
        data: 'room_details.title',
        render: function (data, type, row) {
          const baseURL = 'http://127.0.0.1:8000/storage/';
          const thumbnailPath = row.room_details.thumbnail_image;
          const fullImageURL = `${baseURL}${thumbnailPath}`;
          const id = row.room_details.id;
          const showRoom = `/admin/rooms/` + id;
          return `
          <div class="d-flex align-items-center">
            <div class="avatar-lg bg-light rounded p-1">
              <img src="${fullImageURL}" alt="Room Image" class="img-fluid d-block" />
            </div>
            <div>
              <h5 class="fs-14 my-1"><a href="${showRoom}" class="text-dark text-decoration-none">${data}</a></h5>
              <span class="text-muted">${row.room_details.room_type.type}</span>
            </div>
          </div>
        `;
        }
      },
      {
        data: 'room_details.price',
        render: function (data) {
          const formattedPrice = new Intl.NumberFormat('vi-VN').format(data);
          return `<h5 class="fs-14 my-1 fw-normal">${formattedPrice} VNĐ</h5>
            <span class="text-muted">Giá</span>`;
        }
      },
      {
        data: 'count',
        render: function (data) {
          return `<h5 class="fs-14 my-1 fw-normal">${data}</h5>
            <span class="text-muted">Lượt đặt</span>`;
        }
      }
    ],
    language: {
      paginate: {
        next: 'Tiếp',
        previous: 'Trước'
      },
      lengthMenu: 'Hiển thị _MENU_ mục',
      info: 'Hiển thị từ _START_ đến _END_ trên tổng _TOTAL_ mục',
      infoEmpty: 'Không có dữ liệu để hiển thị',
      emptyTable: 'Không có dữ liệu'
    }
  });
});

$(document).ready(function () {
  const table = $('#bookingsTodayTable').DataTable({
    processing: true,
    serverSide: false,
    searching: false,
    lengthChange: false,
    autoWidth: false,
    ajax: {
      url: '/api/getBookingsToday',
      type: 'GET',
      dataSrc: function (json) {
        if (json.success) {
          $('.statistics-summary').remove();
          $('body').append(`
                      <div class="statistics-summary">
                          <h5 class="delete-orders">Đơn hàng bị hủy trong hôm nay: ${
                            json.count
                          }</h5>
                          <h5 class="total-orders">Tổng doanh thu hôm nay: ${json.price.toLocaleString()}</h5>
                      </div>
                  `);
        }
        return json.data;
      }
    },
    columns: [
      {
        data: 'room.title',
        title: 'Tên phòng',
        render: function (data) {
          return data ?? 'Không có tên phòng';
        }
      },
      {
        data: 'check_in_date',
        title: 'Ngày đến',
        render: function (data) {
          return moment.unix(data).format('DD-MM-YYYY');
        }
      },
      {
        data: 'check_out_date',
        title: 'Ngày đi',
        render: function (data) {
          return moment.unix(data).format('DD-MM-YYYY');
        }
      },
      {
        data: 'total_price',
        title: 'Tổng tiền',
        render: function (data) {
          return parseInt(data).toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
          });
        }
      },
      {
        data: 'status',
        title: 'Trạng thái',
        render: function (data) {
          switch (data) {
            case 1:
              return 'Đang thanh toán cọc';
            case 2:
              return 'Đã thanh toán cọc';
            case 3:
              return 'Đã thanh toán tổng tiền';
            case 4:
              return 'Đang sử dụng';
            case 5:
              return 'Đã hủy';
            default:
              return 'Không xác định';
          }
        }
      },
      {
        data: 'created_at',
        title: 'Ngày tạo',
        render: function (data) {
          return moment.unix(data).format('DD-MM-YYYY HH:mm:ss');
        }
      }
    ],
    columnDefs: [{ targets: '_all', className: 'text-center' }],
    language: {
      paginate: {
        next: 'Tiếp',
        previous: 'Trước'
      },
      lengthMenu: 'Hiển thị _MENU_ mục',
      info: 'Hiển thị từ _START_ đến _END_ trên tổng _TOTAL_ mục',
      infoEmpty: 'Không có dữ liệu để hiển thị',
      emptyTable: 'Không có dữ liệu'
    }
  });

  $('#bookingsTodayTable tbody').on('click', 'tr', function () {
    const data = table.row(this).data(); // Lấy dữ liệu hàng được nhấp
    if (data) {
      $('#detailsModal .modal-body').html(`
        <p>Tên phòng: ${data.room.title}</p>
        <p>Ngày đến: ${moment.unix(data.check_in_date).format('DD-MM-YYYY')}</p>
        <p>Ngày đi: ${moment.unix(data.check_out_date).format('DD-MM-YYYY')}</p>
        <p>Tổng tiền: ${parseInt(data.total_price).toLocaleString('vi-VN', {
          style: 'currency',
          currency: 'VND'
        })}</p>
        <p>Trạng thái: ${getStatusText(data.status)}</p>
        <p>Ngày tạo: ${moment
          .unix(data.created_at)
          .format('DD-MM-YYYY HH:mm:ss')}</p>
      `);
      $('#detailsModal').modal('show');
    }
  });

  function getStatusText(status) {
    switch (status) {
      case 1:
        return 'Đang thanh toán cọc';
      case 2:
        return 'Đã thanh toán cọc';
      case 3:
        return 'Đã thanh toán tổng tiền';
      case 4:
        return 'Đang sử dụng';
      case 5:
        return 'Đã hủy';
      default:
        return 'Không xác định';
    }
  }
});

$(document).ready(function () {
  $('#assetsDie').DataTable({
      processing: true,
      serverSide: false,
      ajax: {
          url: '/api/assetsDie',
          type: 'GET',
          data: function (d) {
          }
      },
      columns: [
          { data: 'id', title: 'ID', className: 'text-center' },
          { data: 'name', title: 'Tên tài sản' },
          {
              data: 'image',
              title: 'Hình ảnh',
              render: function (data) {
                  return `<img src="${data}" alt="Asset Image" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">`;
              }
          },
          {
              data: 'status',
              title: 'Trạng thái',
              render: function (data) {
                  return data === 2 ? 'Hỏng' : 'Không xác định';
              }
          }
      ],
      language: {
          processing: "Đang tải...",
          paginate: {
              next: "Tiếp",
              previous: "Trước"
          },
          lengthMenu: "Hiển thị _MENU_ bản ghi mỗi trang",
          info: "Hiển thị từ _START_ đến _END_ trên tổng _TOTAL_ bản ghi",
          infoEmpty: "Không có bản ghi nào",
          emptyTable: "Không có dữ liệu",
          search: "Tìm kiếm:",
      },
      pageLength: 10,
      lengthChange: true,
      searching: false
  });
});

