<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RoomAssetRequest;
use App\Models\Admin\AssetType;
use App\Models\Admin\Room;
use App\Models\Admin\RoomAsset;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomAssetController extends Controller
{
    const VIEW_PATH = 'admin.roomassets.';

    public function index(Request $request)
    {
        $title = 'Danh sách tiện nghi phòng';

        $search = $request->get('search');
        $sort = $request->get('sort');

        $query = RoomAsset::query()
            ->join('rooms', 'rooms.id', '=', 'roomassets.room_id')
            ->select('roomassets.room_id', 'rooms.title', DB::raw('COUNT(roomassets.id) as asset_count'))
            ->groupBy('roomassets.room_id', 'rooms.title');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('rooms.title', 'like', "%$search%")
                  ->orWhere('rooms.roomId_number', 'like', "%$search%");
            });
        }

        // Sắp xếp dữ liệu
        switch ($sort) {
            case 'room_name_asc':
                $query->orderBy('rooms.title', 'asc');
                break;
            case 'room_name_desc':
                $query->orderBy('rooms.title', 'desc');
                break;
            case 'asset_count_asc':
                $query->orderBy('asset_count', 'asc');
                break;
            case 'asset_count_desc':
                $query->orderBy('asset_count', 'desc');
                break;
            default:
                $query->orderBy('rooms.title', 'asc'); // Mặc định sắp xếp theo tên phòng
        }

        // Phân trang
        $roomassets = $query->paginate(10);

        // Truyền dữ liệu qua view
        return view(self::VIEW_PATH . __FUNCTION__, compact('roomassets', 'title'));
    }

    public function show($id)
    {
        $room = Room::select('id', 'title')->where('id', $id)->first();
        $title = 'Danh sách tiện nghi của phòng '. $room->title;

        $asset = RoomAsset::select('id', 'assets_type_id', 'room_id')->with('assetType')->where('room_id', $id)->where('status', 0)->get();

        return view(self::VIEW_PATH . __FUNCTION__, compact(['asset', 'room'], 'title'));
    }

    public function create()
    {
        //Tiêu đề trang
        $title = 'Thêm tiện nghi phòng';

        //danh sách phòng
        $roomAsset = RoomAsset::select('room_id')->get();
        $rooms = Room::select('id', 'title')->whereNotIn('id', $roomAsset)->get();

        //danh sach loại tiện nghi
        $assetTypes = AssetType::select('id', 'name', 'status')->where('status', 0)->get();

        // Truyền các tham số sang view
        return view(self::VIEW_PATH . __FUNCTION__, compact('title', 'rooms', 'assetTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $existingRoomAsset = RoomAsset::where('room_id', $data['room_id'])
            ->where('assets_type_id', $data['assets_type_id'])
            ->first();

        if ($existingRoomAsset) {
            return redirect()->back()->with('error', 'Phòng này đã có loại tiện nghi này rồi.');
        }

        foreach ($data['assets_type_id'] as $key) {
            RoomAsset::create([
                'assets_type_id' => $key,
                'room_id' => $data['room_id'],
            ]);
        }

        $room = Room::select('id')->where('id', $data['room_id'])->first();

        return redirect()->route('room-assets.show', $room)->with('success', 'Thêm mới thành công');
    }


    public function edit($id)
    {
        $room = Room::select('id', 'title')->where('id', $id)->first();
        $title = 'Thêm tiện nghi cho phòng ' . $room->title;

        $currentAssets = RoomAsset::where('room_id', $id)->pluck('assets_type_id')->toArray();

        $assetTypes = AssetType::select('id', 'name')->whereNotIn('id', $currentAssets)->where('status', 0)->get();

        return view(self::VIEW_PATH . __FUNCTION__, compact('title', 'room', 'assetTypes'));
    }


    public function update(Request $request, $id)
    {
        $asset = $request->input('assets_type_id');
        Log::error($asset);

        if (!isset($asset)) {
            return redirect()->back()->with('error', 'Vui lòng chọn tiện nghi.');
        }

        foreach($asset as $item){
            RoomAsset::create([
                'room_id' => $id,
                'assets_type_id' => $item
            ]);
        }

        return redirect()->route('room-assets.show', $id)->with('success', 'Cập nhật thành công');
    }


    public function destroy($id, Request $request)
    {
        // Tìm room asset theo ID
        $roomAsset = RoomAsset::find($id);
        // Xóa room asset
        $roomAsset->delete();

        $room_id = $request->room_id;

        return redirect()->route('room-assets.show', $room_id)->with('success', 'Xóa thành công');
    }
}
