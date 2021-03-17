<?php

namespace App\Http\Requests\ContractRoom;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ContractRoomWebRequest extends FormRequest
{
    public function rules()
    {
        return [
            'room_id' => [
                'required',
                Rule::in(Room::belongsToTeam(Auth::user()->team)->pluck('rooms.id')),
                Rule::unique('contract_room')->where(function ($query) {
                    return $query->where([
                        ['room_id', $this->room_id],
                        ['deleted_at', null],
                    ]);
                })
            ],
            'contract_id' => ['required',
                Rule::exists('contract_tenant', 'tenant_id')->where(function ($query) {
                    $query->where('tenant_id', $this->tenant->id);
                })
            ],
            'price_square_foot' => ['required', 'integer', 'min:0'],
            'moved_at' => ['required', 'date', 'after_or_equal:today'],
            'pay_start' => ['required', 'date', 'after_or_equal:today'],
        ];
    }
}
