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
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'rating');
        $sortOrder = $request->input('sort_order', 'desc');
        $reviews = Review::with(['user', 'room'])
            ->when($search, function ($query, $search) {
                return $query->where('comment', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        return view('admin.reviews.index', compact('reviews', 'search', 'sortBy', 'sortOrder'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Xóa đánh giá thành công');
    }
}
