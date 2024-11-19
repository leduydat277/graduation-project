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
    columns: [
      {
        data: 'room_details.title',
        render: function (data, type, row) {
          return `
              <div class="d-flex align-items-center">
                <div class="avatar-sm bg-light rounded p-1 me-2">
                  <img src="assets/images/products/img-1.png" alt="" class="img-fluid d-block" />
                </div>
                <div>
                  <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset"><a href="">${data}</a></h5>
                  <span class="text-muted">${row.room_details.room_type.type}</span>
                </div>
              </div>
            `;
        },
      },
      {
        data: 'room_details.price',
        render: function (data) {
          return `<h5 class="fs-14 my-1 fw-normal">${data}vnđ</h5>
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
    ]
  });
});
