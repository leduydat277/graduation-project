<?php

namespace App\Http\Controllers\Admin;

use App\Models\Other;
use Illuminate\Http\Request;

class OtherController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Other Control';
        $others = Other::all();
        return view('admin.others.index', compact('others', 'title'));
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
            'type' => 'required|max:255',
            'description' => 'required',
            'value' => 'required|string|max:255',
        ]);
    
        $other = Other::create($validated);
    
        if ($other) {
            return redirect()->route('others.index')->with('success', 'Thêm mới thành công!');
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
        $other = Other::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'description' => 'nullable',
            'value' => 'required',
        ]);
        $other->name = $validated['name'];
        $other->type = $validated['type'];
        $other->description = $validated['description'];
        $other->value = $validated['value'];
    
        $other->save();
        return redirect()->route('others.index')->with('success', 'Cập nhật thông tin thành công!', compact('other'));
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    { 
            $other = Other::findOrFail($id); 
            $other->delete();  
            return redirect()->route('others.index')->with('success', 'Xóa thành công!');
    }
    
    
}
