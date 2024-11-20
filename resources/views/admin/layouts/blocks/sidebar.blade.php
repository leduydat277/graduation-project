 <!-- removeNotificationModal -->
 <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                     id="NotificationModalbtn-close"></button>
             </div>
             <div class="modal-body">
                 <div class="mt-2 text-center">
                     <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                         colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                     <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                         <h4>Are you sure ?</h4>
                         <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                     </div>
                 </div>
                 <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                     <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                     <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                         It!</button>
                 </div>
             </div>

         </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
 </div>
 <div class="app-menu navbar-menu">
     <!-- LOGO -->
     <div class="navbar-brand-box">
         <!-- Dark Logo-->
         <a href="/admin/" class="logo logo-dark">
             <span class="logo-sm">
                 <img src="/../assets/admin/assets/images/logo-sm.png" alt="" height="22">
             </span>
             <span class="logo-lg">
                 <img src="/../assets/admin/assets/images/logo-dark.png" alt="" height="17">
             </span>
         </a>
         <!-- Light Logo-->
         <a href="/admin/" class="logo logo-light">
             <span class="logo-sm">
                 <img src="/../assets/admin/assets/images/logo-sm.png" alt="" height="22">
             </span>
             <span class="logo-lg">
                 <img src="/../assets/admin/assets/images/logo-light.png" alt="" height="17">
             </span>
         </a>
         <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
             id="vertical-hover">
             <i class="ri-record-circle-line"></i>
         </button>
     </div>

     <div id="scrollbar">
         <div class="container-fluid">

             <div id="two-column-menu">
             </div>

             <ul class="navbar-nav" id="navbar-nav">
                 <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                 <li class="nav-item">
                     <a href="{{ route('admin.dashboard') }}" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-home"></i> <!-- Biểu tượng cho trang chủ -->
                         Trang chủ
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-users"></i> <!-- Biểu tượng cho danh sách người dùng -->
                         Tài khoản
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-address-book "></i> <!-- Biểu tượng cho trang chủ -->
                         Đơn đặt
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('payments.index') }}" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-address-book "></i> <!-- Biểu tượng cho trang chủ -->
                         Hóa đơn
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('room-types.index') }}" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-th-list"></i> <!-- Icon for room type list -->
                         Loại phòng
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('rooms.index') }}" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-bed"></i> <!-- Icon for room list -->
                         Danh sách phòng
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('room-types.index') }}" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-th-list"></i> <!-- Icon for room type list -->
                         Danh sách tiện nghi
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('room-assets.index') }}" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-th-list"></i> <!-- Icon for room type list -->
                         Quản lý tiện nghi phòng
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('manage-status-rooms.index') }}" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-hotel"></i> <!-- Thay đổi icon cho quản lý trạng thái phòng -->
                         Quản lý trạng thái phòng
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('reviews.index') }}" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-comments"></i> <!-- Icon for reviews and comments -->
                         Đánh giá và bình luận
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('checkin-checkout.index') }}" class="nav-link" data-key="t-analytics">
                         <i class="fas fa-th-list"></i>
                         Check-in & Check-out
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('others.index') }}" class="nav-link" data-key="t-analytics">
                     <i class="fas fa-th-list"></i>
                         Others
                     </a>
                 </li>
             </ul>
         </div>
         <!-- Sidebar -->
     </div>

     <div class="sidebar-background"></div>
 </div>
