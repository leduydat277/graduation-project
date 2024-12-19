<style>
    .rating {
        display: flex;
        direction: rtl;
        /* Chọn từ phải qua trái */
        justify-content: space-between;
        width: 250px;
    }

    .rating input {
        display: none;
        /* Ẩn các input radio */
    }

    .rating label {
        font-size: 40px;
        color: #ccc;
        /* Màu của sao khi chưa được chọn */
        cursor: pointer;
        transition: color 0.3s ease;
    }

    /* Khi sao được chọn, tất cả các sao trước sao đó sẽ sáng lên */
    .rating input:checked~label {
        color: #f39c12;
        /* Màu của sao khi được chọn */
    }

    /* Khi hover, tất cả các sao phía trước sao được hover cũng sẽ sáng */
    .rating label:hover,
    .rating label:hover~label {
        color: #f39c12;
    }

    /* Khi sao được chọn và hover, các sao sẽ sáng lên */
    .rating input:checked+label:hover,
    .rating input:checked+label:hover~label {
        color: #f39c12;
    }
</style>
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Đánh giá đơn đặt phòng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="reviewForm" action="{{ route('client.room-postComment', ['id' => $booking->room_id]) }}"
                    method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $booking->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="room_id" value="{{ $booking->room_id }}">

                    <div class="mb-3">
                        <label for="rating" class="form-label">Đánh giá (1 - 5 sao)</label>
                        <div id="rating" class="star-rating">
                            <div class="rating">
                                <input type="radio" id="star5" name="rating" value="5">
                                <label for="star5" title="5 sao">&#9733;</label>

                                <input type="radio" id="star4" name="rating" value="4">
                                <label for="star4" title="4 sao">&#9733;</label>

                                <input type="radio" id="star3" name="rating" value="3">
                                <label for="star3" title="3 sao">&#9733;</label>

                                <input type="radio" id="star2" name="rating" value="2">
                                <label for="star2" title="2 sao">&#9733;</label>

                                <input type="radio" id="star1" name="rating" value="1">
                                <label for="star1" title="1 sao">&#9733;</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Nhận xét</label>
                        <textarea id="comment" name="comment" rows="5" class="form-control" placeholder="Nhập nhận xét của bạn..."></textarea>
                    </div>

                    <div class="mb-3">
                        <span style="font-style: italic; font-size: smaller; font-weight: bold;">
                            * Vui lòng đánh giá và để lại nhận xét về trải nghiệm của bạn.
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="submitReviewBtn">Gửi đánh giá</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
