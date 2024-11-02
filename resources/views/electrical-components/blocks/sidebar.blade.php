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
         <a href="" class="logo logo-dark">
             <span class="logo-sm">
                 <img src="/../assets/admin/assets/images/logo-sm.png" alt="" height="22">
             </span>
             <span class="logo-lg">
                 <img src="/../assets/admin/assets/images/logo-dark.png" alt="" height="17">
             </span>
         </a>
         <!-- Light Logo-->
         <a href="" class="logo logo-light">
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
            
                <!-- Trang chủ -->
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link" data-key="t-home">
                        <i class="fas fa-home"></i>
                        Trang chủ
                    </a>
                </li>
            
                <!-- Booking -->
                <li class="nav-item">
                    <a href="{{ url('/admin/bookings') }}" class="nav-link" data-key="t-bookings">
                        <i class="fas fa-address-book"></i>
                        Booking
                    </a>
                </li>
            
                <!-- Payments -->
                <li class="nav-item">
                    <a href="{{ url('/admin/payments') }}" class="nav-link" data-key="t-payments">
                        <i class="fas fa-wallet"></i>
                        Payments
                    </a>
                </li>
            
                <!-- Rooms -->
                <li class="nav-item">
                    <a href="{{ url('/admin/rooms') }}" class="nav-link" data-key="t-rooms">
                        <i class="fas fa-bed"></i>
                        Rooms
                    </a>
                </li>
            
                <!-- Room Types -->
                <li class="nav-item">
                    <a href="{{ url('/admin/roomtypes') }}" class="nav-link" data-key="t-roomtypes">
                        <i class="fas fa-th-large"></i>
                        Room Types
                    </a>
                </li>
            
                <!-- Room Assets -->
                <li class="nav-item">
                    <a href="{{ url('/admin/roomasset') }}" class="nav-link" data-key="t-roomasset">
                        <i class="fas fa-couch"></i>
                        Room Assets
                    </a>
                </li>
            
                <!-- User Accounts -->
                <li class="nav-item">
                    <a href="{{ url('/admin/user') }}" class="nav-link" data-key="t-user">
                        <i class="fas fa-users"></i>
                        Danh sách tài khoản
                    </a>
                </li>
            
                <!-- Trở về trang chủ -->
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link" data-key="t-return-home">
                        <i class="fas fa-arrow-left"></i>
                        Trở về trang chủ
                    </a>
                </li>
            </ul>
            

         </div>
         <!-- Sidebar -->
     </div>

     <div class="sidebar-background"></div>
 </div>
