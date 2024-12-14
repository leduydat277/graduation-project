<div class="modal fade" id="cancelReasonModal" tabindex="-1" aria-labelledby="cancelReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelReasonModalLabel">Lý do hủy đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <select id="cancelReasonSelect" name="reson" class="form-select">
                    <option value="">Chọn lý do hủy</option>
                    @foreach ($reson as $reasonItem)
                        <option value="{{ $reasonItem->id }}">{{ $reasonItem->reson }}</option>
                    @endforeach
                </select>
                <textarea id="cancelReason" name="description" class="form-control mt-3" placeholder="Nhập lý do hủy đơn hàng..."></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button class="btn btn-danger" id="confirmBookingBtn" type="submit">Xác nhận hủy</button>
            </div>

        </div>
    </div>
</div>
