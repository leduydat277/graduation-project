@extends('client.layouts.master')

@section('title')
    Danh sách phòng
@endsection
@section('content')
    @include('client.layouts.banner.banner')
    <div class="post-wrap padding-small">
        <form action="/" method="GET" id="filter-form">
            @foreach (request()->all() as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <div class="filter-room row" style="margin: auto; width: 80%">
                <div class="col-md-4 mb-3">
                    <label for="filter-room-type" class="form-label">Chọn loại phòng</label>
                    <select id="filter-room-type" class="form-select">
                        <option value="" selected>Tất cả loại phòng</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="filter-price" class="form-label">Giới hạn tiền (VNĐ/₫)</label>
                    <input type="text" id="filter-price" class="form-control" placeholder="Giới hạn tiền (₫)">
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Lọc</button>
                </div>
            </div>
        </form>
        <div class="container-fluid padding-side">
            <div class="row">
                <main class="post-list post-card-small">
                    <div class="row g-lg-5" style="margin-top:0px">
                        <div class="post-wrap padding-small">
                            <!-- Thêm phần hiển thị loading -->
                            <div id="loading" class="d-flex justify-content-center align-items-center"
                                style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <div class="container-fluid padding-side">
                                <div class="row">
                                    <main class="post-list post-card-small">
                                        <div class="row g-lg-5" style="margin-top:0px">
                                            <div class="col-md-6 col-xl-4 mb-4">
                                                <!-- Placeholder for rooms -->
                                            </div>
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav aria-label="Page navigation" class="d-flex justify-content-center mt-5">
                        <ul class="pagination align-items-center">

                        </ul>
                    </nav>
                </main>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentPage = 1;
            let roomsPerPage = 6; // Số lượng phòng trên mỗi trang
            let allRooms = []; // Dữ liệu phòng đã lấy từ API

            const queryParams = new URLSearchParams(window.location.search);
            const urlParams = Object.fromEntries(queryParams.entries());

            fetchRooms(urlParams);

            $.ajax({
                url: "{{ route('api.room-types') }}",
                method: 'GET',
                success: function(response) {
                    if (response.type === "success" && Array.isArray(response.data)) {
                        const selectElement = $('#filter-room-type');
                        response.data.forEach(roomType => {
                            selectElement.append(
                                `<option value="${roomType.id}">${roomType.type}</option>`
                            );
                        });
                    } else {
                        console.error("Dữ liệu không hợp lệ");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi khi gọi API loại phòng:", error);
                }
            });

            $('#filter-room-type').on('change', function() {
                const selectedRoomType = $('#filter-room-type').val();
                const maxPrice = $('#filter-price').val();
                filterRooms(selectedRoomType, maxPrice);
            });

            $('#filter-form button').on('click', function(e) {
                e.preventDefault();
                const selectedRoomType = $('#filter-room-type').val();
                const maxPrice = $('#filter-price').val();
                filterRooms(selectedRoomType, maxPrice);
            });

            function fetchRooms(params) {
                // Hiển thị loading
                $('#loading').show();

                $.ajax({
                    url: "{{ route('api.search_room') }}",
                    method: "GET",
                    data: params,
                    success: function(response) {
                        if (response.status === "success" && Array.isArray(response.data)) {
                            allRooms = response.data;
                            renderRooms(allRooms, currentPage, roomsPerPage);
                            renderPagination(allRooms.length, roomsPerPage);
                        } else {
                            console.error("Dữ liệu phòng không hợp lệ");
                        }
                    },
                    error: function(error) {
                        console.error("Lỗi khi gọi API phòng:", error);
                    },
                    complete: function() {
                        // Ẩn loading khi hoàn tất
                        $('#loading').hide();
                    }
                });
            }

            function filterRooms(selectedRoomType, maxPrice) {
                // Hiển thị loading
                $('#loading').show();

                const filteredRooms = allRooms.filter(function(room) {
                    let isRoomTypeMatch = true;
                    let isPriceMatch = true;

                    if (selectedRoomType) {
                        isRoomTypeMatch = (room.room_type.id == selectedRoomType);
                    }

                    if (maxPrice) {
                      console.log(parseInt(maxPrice.replace(/\./g, ''), 10));
                        isPriceMatch = (room.price <= parseInt(maxPrice.replace(/\./g, ''), 10));
                    }

                    return isRoomTypeMatch && isPriceMatch;
                });
                renderRooms(filteredRooms, currentPage, roomsPerPage);
                renderPagination(filteredRooms.length, roomsPerPage);

                // Ẩn loading khi hoàn tất
                $('#loading').hide();
            }

            function renderRooms(rooms, page, perPage) {
                const roomList = $('.post-list .row.g-lg-5');
                roomList.empty();

                const startIndex = (page - 1) * perPage;
                const paginatedRooms = rooms.slice(startIndex, startIndex + perPage);

                paginatedRooms.forEach(room => {
                    const roomItem = `
                <div class="col-md-6 col-xl-4 mb-4">
                     <a href="${room.details_url}"><div class="room-item rounded-4">
                        <img src="http://127.0.0.1:8000/storage/${JSON.parse(room.image_room)[0]}" style="width: 100%;  height: 400px; object-fit: cover;" alt="img" class="img-fluid rounded-4">
                    </div></a>
                    <div class="room-content">
                        <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                            <h4 class="display-6 fw-normal"><a href="${room.details_url}">${room.title}</a></h4>
                        </div>
                        <p class="product-paragraph">${room.description}</p>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="pe-2">Loại phòng: </td>
                                    <td>${room.room_type.type}</td>
                                </tr>
                                <tr>
                                    <td class="pe-2">Giá tiền: </td>
                                    <td class="price">${formatPriceVND(room.price)}/Đêm</td>
                                </tr>
                                <tr>
                                    <td class="pe-2">Diện tích: </td>
                                    <td class="price">${room.room_area} m²</td>
                                </tr>
                                <tr>
                                    <td class="pe-2">Sức chứa: </td>
                                    <td>${room.max_people} Người</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="${room.details_url}">
                            <p class="text-decoration-underline mt-3">Chi tiết</p>
                        </a>
                    </div>
                </div>
            `;
                    roomList.append(roomItem);
                });
            }

            function renderPagination(totalRooms, perPage) {
                const totalPages = Math.ceil(totalRooms / perPage);
                const pagination = $('.pagination');
                pagination.empty();

                const prevPage = `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" aria-label="<" onclick="changePage(${currentPage - 1})"><</a>
        </li>`;

                pagination.append(prevPage);

                for (let page = 1; page <= totalPages; page++) {
                    const pageItem = `<li class="page-item ${currentPage === page ? 'active' : ''}">
                <a class="page-link" href="#" onclick="changePage(${page})">${page}</a>
            </li>`;
                    pagination.append(pageItem);
                }

                const nextPage = `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" aria-label=">" onclick="changePage(${currentPage + 1})">></a>
        </li>`;

                pagination.append(nextPage);
            }

            window.changePage = function(page) {
                if (page < 1 || page > Math.ceil(allRooms.length / roomsPerPage)) return;
                currentPage = page;
                renderRooms(allRooms, currentPage, roomsPerPage);
                renderPagination(allRooms.length, roomsPerPage);
            }

            function formatPriceVND(price) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(price);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#filter-price').on('input', function() {
                let value = $(this).val().replace(/\D/g, ''); // Xóa ký tự không phải số
                $(this).val(value.replace(/\B(?=(\d{3})+(?!\d))/g, '.')); // Format lại giá trị
            });
        });
    </script>
@endsection
