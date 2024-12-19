<div class="modal fade" id="cancelReasonModal" tabindex="-1" aria-labelledby="cancelReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelReasonModalLabel">Lý do hủy đơn đặt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <select id="cancelReasonSelect" name="reson" class="form-select">
                    <option value="">Chọn lý do hủy</option>
                    @foreach ($reson as $reasonItem)
                        <option value="{{ $reasonItem->id }}">{{ $reasonItem->reson }}</option>
                    @endforeach
                </select>
                <textarea id="cancelReason" name="description" rows="10" class="form-control mt-3" placeholder="Nhập lý do hủy đơn hàng..."></textarea>
                <span style="font-style: italic; font-size: smaller; font-weight: bold;">
                    * Vui lòng đọc kỹ điều khoản và liên hệ qua SĐT: 0876587532 hoặc gửi email quyen.pham@rikai.technology để được hỗ trợ thêm
                </span>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button class="btn btn-danger" id="confirmBookingBtn" type="submit">Xác nhận hủy</button>
            </div>
        </div>
    </div>
</div>
