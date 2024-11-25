<?php

namespace App\Http\Controllers\Admin;

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
        $title = 'Phí Phát Sinh';
        $phiphatsinhs = PhiPhatSinh::all();
        return view('admin.phiphatsinhs.index', compact('phiphatsinhs', 'title'));
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
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|max:255',
    //         'type' => 'required|max:255',
    //         'description' => 'required',
    //         'value' => 'required|string|max:255',
    //     ]);
    //     $other = Other::create($validated);
    
    //     if ($other) {
    //         return redirect()->route('others.index')->with('success', 'Thêm mới thành công!');
    //     } else {
    //         return redirect()->back()->with('error', 'Không thể thêm mới. Vui lòng thử lại.');
    //     }
    // }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // public function update(Request $request, $id)
    // {
    //     $other = Other::findOrFail($id);
    //     $validated = $request->validate([
    //         'name' => 'required|max:255',
    //         'type' => 'required|max:255',
    //         'description' => 'nullable',
    //         'value' => 'required',
    //     ]);
    //     $other->name = $validated['name'];
    //     $other->type = $validated['type'];
    //     $other->description = $validated['description'];
    //     $other->value = $validated['value'];
    //     $other->save();
    //     return redirect()->route('others.index')->with('success', 'Cập nhật thông tin thành công!', compact('other'));
    // }
    

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
