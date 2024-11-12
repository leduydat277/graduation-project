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
        text: { value: `${percentage}%`, style: { color: '#000' } },
    });
    bar.animate(percentage / 100);
    document.querySelector(selector).classList.add('progress-bar');
}

createProgress('#canada-progress', 75);
createProgress('#greenland-progress', 47);
createProgress('#russia-progress', 82);
