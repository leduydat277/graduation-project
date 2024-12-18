<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Đánh giá đơn đặt phòng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="reviewForm">
                    <input type="hidden" name="id" value="{{ $booking->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="room_id" value="{{ $booking->room_id }}">

                    <div class="mb-3">
                        <label for="rating" class="form-label">Đánh giá (1 - 5 sao)</label>
                        <div id="rating" class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 sao"></label>
                            <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 sao"></label>
                            <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 sao"></label>
                            <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 sao"></label>
                            <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 sao"></label>
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
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button class="btn btn-primary" id="submitReviewBtn">Gửi đánh giá</button>
            </div>
        </div>
    </div>
</div>
