<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'cccd' => $user->cccd,
            'phone' => $user->phone,
            'address' => $user->address,
            'role' => $user->role,
            'photo' => $user->image ? url()->route('image', ['path' => $user->image, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
        ])->toArray(); // Chuyển từ Collection sang array
    }
}
