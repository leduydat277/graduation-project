<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\PhiPhatSinh;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PhiphatsinhController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allBooking = Booking::whereIn('status', [2, 3, 4])->get();
        $title = 'Phí Phát Sinh';
        $phiphatsinhs = PhiPhatSinh::all();
        return view('admin.phiphatsinhs.index', compact('phiphatsinhs', 'title', 'allBooking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'booking_id' => 'required',
            'price' => 'required',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs(
                'upload/phiphatsinhs',
                uniqid() . '.' . $request->file('image')->getClientOriginalExtension(), 
                'public'
            );
                    }
    
        // 3. Lưu dữ liệu vào database
        $phiPhatSinh = new PhiPhatSinh();
        $phiPhatSinh->name = $request->name;
        $phiPhatSinh->booking_id = $request->booking_id;
        $phiPhatSinh->description = $request->description;
        $phiPhatSinh->price = $request->price;
        $phiPhatSinh->image = $imagePath; 
        $phiPhatSinh->save();
        if ($phiPhatSinh) {
            return redirect()->route('phiphatsinhs.index')->with('success', 'Thêm mới thành công!');
        } else {
            return redirect()->back()->with('error', 'Không thể thêm mới. Vui lòng thử lại.');
        }
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $phiphatsinh = PhiPhatSinh::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'booking_id' => 'required|exists:bookings,id',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        $phiphatsinh->name = $request->input('name');
        $phiphatsinh->booking_id = $request->input('booking_id');
        $phiphatsinh->description = $request->input('description') ?? '';
        $phiphatsinh->price = $request->input('price');
        if ($request->hasFile('image')) {
            if ($phiphatsinh->image && file_exists(public_path("storage/{$phiphatsinh->image}"))) {
                unlink(public_path("storage/{$phiphatsinh->image}"));
            }
            $imagePath = $request->file('image')->store('upload/phiphatsinhs', 'public');
            $phiphatsinh->image = $imagePath;
        }
        $phiphatsinh->save();
        if ($phiphatsinh) {
            return redirect()->route('phiphatsinhs.index')->with('success', 'Sửa thành công!');
        } else {
            return redirect()->back()->with('error', 'Không thể sửa. Vui lòng thử lại.');
        }
    }
    
    

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy($id)
    { 
            $other = PhiPhatSinh::findOrFail($id); 
            $other->delete();  
            return redirect()->route('phiphatsinhs.index')->with('success', 'Xóa thành công!');
    }
}
