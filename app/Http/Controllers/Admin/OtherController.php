<?php

namespace App\Http\Controllers\Admin;

use App\Models\Other;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'description' => 'nullable',
            'value' => 'nullable|file',
        ]);
        if ($request->hasFile('value')) {
            $imagePath = $request->file('value')->storeAs(
                'upload/others',
                uniqid() . '.' . $request->file('value')->getClientOriginalExtension(),
                'public'
            );
            $validated['value'] = $imagePath;
        } else {
            $validated['value'] = $request->input('valuee');
        }

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
        $other = Other::findOrFail($id);
        $title = "Chỉnh sửa Others";
        return view('admin.others.edit', compact('title', 'other'));
    }

    public function update(Request $request, $id)
    {
        $other = Other::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'description' => 'nullable',
            'value' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->value) {
            if ($request->hasFile('value')) {
                $imagePath = $request->file('value')->storeAs(
                    'upload/others',
                    uniqid() . '.' . $request->file('value')->getClientOriginalExtension(),
                    'public'
                );
                $validated['value'] = $imagePath;
            } else {
                $validated['value'] = $request->input('valuee');
            }
        } else {
            $validated['value'] = $other->value;
        }

        // Cập nhật dữ liệu vào đối tượng
        $other->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'description' => $validated['description'],
            'value' => $validated['value'],
        ]);

        return redirect()->route('others.index')->with('success', 'Cập nhật thông tin thành công!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $other = Other::findOrFail($id);
            Storage::delete($other->value); 
        $other->delete();
        return redirect()->route('others.index')->with('success', 'Xóa thành công!');
    }

    public function policy()
    {
        $data = Other::where('type', 'policy')->get();

        return response()->json(['status' => 'success', 'data' => $data->value], 200);
    }

    public function privacy()
    {
        $data = Other::where('type', 'privacy')->get();

        return response()->json(['status' => 'success', 'data' => $data->value], 200);
    }
}
