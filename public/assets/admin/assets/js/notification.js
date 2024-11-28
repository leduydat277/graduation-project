var pusher = new Pusher('2934f03ec3f3092b7fc7', {
  cluster: 'ap1'
});

var channel = pusher.subscribe('notifications');
channel.bind('notification.sent', function(data) {
  showNotification(data.title, data.message);
  fetchNotifications();
});

function showNotification(title, message) {
  var popup = document.createElement('div');
  popup.className = 'notification-popup';

  popup.innerHTML = `
<button class="close-btn">&times;</button>
<h4>${title}</h4>
<p>${message}</p>
`;

  popup.querySelector('.close-btn').addEventListener('click', function() {
      popup.remove();
  });

  document.getElementById('notification-container').appendChild(popup);

  popup.style.display = 'block';

  setTimeout(function() {
      if (popup.parentNode) {
          popup.remove();
      }
  }, 5000);
}

function fetchNotifications() {
  $.ajax({
      url: '/api/notifications',
      method: 'GET',
      success: function(data) {
          let notificationItemsTabContent = $('#notificationItemsTabContent');
          let unreadBadge = $('#page-header-notifications-dropdown .topbar-badge');
          let dropdownHeaderBadge = $('.dropdown-tabs .badge');
          notificationItemsTabContent.empty();

          if (data.type === 'success' && data.data.length > 0) {
              const unreadNotifications = data.data.filter(notification => notification.is_read ===
                  0);

              unreadBadge.text(unreadNotifications.length);

              dropdownHeaderBadge.text(`${unreadNotifications.length} thông báo mới`);

              data.data.forEach(notification => {
                  let read;
                  if (notification.is_read === 1) {
                      read = `<i class="bx bx-check" style="color: green;"></i>`
                  }
                  if (notification.is_read === 0) {
                      read = `<i class="bx"></i>`
                  }
                  const notificationItem = $('<div>')
                      .addClass(
                          'text-reset notification-item d-block dropdown-item position-relative'
                      );

                  const notificationContent = `
              <div class="d-flex">
                  <div class="avatar-xs me-3 flex-shrink-0">
                      <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                          ${read}
                      </span>
                  </div>
                  <div class="flex-grow-1">
                      <a href="/admin/bookings/${notification.id}" class="stretched-link">
                          <h6 class="mt-0 mb-2 lh-base">${notification.message}</h6>
                      </a>
                      <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                          <span><i class="mdi mdi-clock-outline"></i> ${notification.date}</span>
                      </p>
                  </div>
                  <div class="px-2 fs-15">
                      <div class="form-check notification-check">
                          <input class="form-check-input notification-checkbox" type="checkbox" value="${notification.id}" id="notification-check-${notification.id}">
                          <label class="form-check-label" for="notification-check-${notification.id}"></label>
                      </div>
                  </div>
              </div>
          `;

                  notificationItem.html(notificationContent);
                  notificationItemsTabContent.append(notificationItem);
              });
          } else {
              unreadBadge.text('0');
              dropdownHeaderBadge.text('Không có thông báo mới');
              const noNotificationMessage = $('<div>')
                  .addClass('text-center text-muted py-3')
                  .text('Hiện không có thông báo.');
              notificationItemsTabContent.append(noNotificationMessage);
          }
      },
      error: function(xhr, status, error) {
          console.error('Error fetching data:', error);
          $('#notificationItemsTabContent')
              .empty()
              .append('<div class="text-center text-danger py-3">Không thể tải thông báo.</div>');
      }
  });
}

fetchNotifications();

function toggleDeleteButton() {
  const checkedCount = $('.notification-checkbox:checked').length;
  const deleteButtonContainer = $('#deleteNotificationButtonContainer');

  if (checkedCount > 0) {
      deleteButtonContainer.show();
  } else {
      deleteButtonContainer.hide();
  }
}

function toggleReadButton() {
  const checkedCount = $('.notification-checkbox:checked').length;
  const readButtonContainer = $('#readNotificationButtonContainer');
  if (checkedCount > 0) {
      readButtonContainer.show();
  } else {
      readButtonContainer.hide();
  }
}

$(document).on('change', '.notification-checkbox', function() {
  toggleReadButton();
  toggleDeleteButton();
});

$(document).on('click', '#deleteNotificationButton', function() {
  const selectedNotifications = $('.notification-checkbox:checked')
      .map(function() {
          return $(this).val();
      })
      .get();
  if (selectedNotifications.length > 0) {
      $.ajax({
          url: '/api/notifications/delete',
          method: 'POST',
          data: {
              notification_ids: selectedNotifications
          },
          success: function(response) {
              if (response.type === 'success') {
                  $('#readNotificationButton').hide();
                  $('#deleteNotificationButton').hide();
                  fetchNotifications();
              } else {
                  alert('Không thể xóa thông báo.');
              }
          },
          error: function(xhr, status, error) {
              console.error('Error deleting notifications:', error);
          }
      });
  } else {
      alert('Vui lòng chọn ít nhất một thông báo để xóa.');
  }
});

$(document).on('click', '#readNotificationButton', function() {
  const selectedNotifications = $('.notification-checkbox:checked')
      .map(function() {
          return $(this).val();
      })
      .get();
  if (selectedNotifications.length > 0) {
      $.ajax({
          url: '/api/notifications/read',
          method: 'POST',
          data: {
              notification_ids: selectedNotifications
          },
          success: function(response) {
              if (response.type === 'success') {
                  $('#readNotificationButton').hide();
                  $('#deleteNotificationButton').hide();
                  fetchNotifications();
              } else {
                  alert('Không thể đọc thông báo.');
              }
          },
          error: function(xhr, status, error) {
              console.error('Error reading notifications:', error);
          }
      });
  } else {
      alert('Vui lòng chọn ít nhất một thông báo để đọc.');
  }
});
