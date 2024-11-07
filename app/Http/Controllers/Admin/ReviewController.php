<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReviewController extends Controller
{
    const VIEW_PATH = 'admin.reviews.';

    public function index(Request $request)
    {
        // Nhận từ khóa tìm kiếm
        $search = $request->input('search');

        // Nhận giá trị sắp xếp (mặc định là theo `rating` và thứ tự giảm dần)
        $sortBy = $request->input('sort_by', 'rating');
        $sortOrder = $request->input('sort_order', 'desc');

        // Truy vấn danh sách đánh giá với tìm kiếm và sắp xếp
        $reviews = Review::with(['user', 'room'])
            ->when($search, function ($query, $search) {
                return $query->where('comment', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        // Truyền các tham số sang view
        return view('admin.reviews.index', compact('reviews', 'search', 'sortBy', 'sortOrder'));
    }

    //hàm xóa comment
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Xóa đánh giá thành công');
    }
}
