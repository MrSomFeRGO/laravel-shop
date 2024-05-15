<?php

namespace App\Http\Controllers;

use App\Data\UserAddressData;
use App\Models\UserAddress;
use Auth;

class AddressController extends Controller
{
    public function index(int $id = null)
    {
        if ($id != null) {
            $address = UserAddress::where('id', '=', $id)->where('user_id', '=', Auth::id())->first();
            if ($address == null) {
                return redirect()->back();
            }
            return inertia('Address', [
                'user_address' => UserAddressData::from($address),
            ]);
        }
        return inertia('Address');
    }

    public function store(UserAddressData $addressData)
    {
        $addressDataArray = $addressData->toModelArray();
        $addressDataArray['user_id'] = Auth::id();
        UserAddress::query()->create($addressDataArray);
        return redirect()->route('profile.index');
    }

    public function update(int $id,UserAddressData $addressData)
    {
        $address = UserAddress::find($id);
        $address->update($addressData->toModelArray());
        return redirect()->route('profile.index');
    }

    public function destroy(int $id)
    {
        UserAddress::where('id', '=', $id)->where('user_id', '=', Auth::id())->first()->delete();
    }
}
