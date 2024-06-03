<?php

namespace App\Service\Staff;

use App\Helpers\FileHelper;
use App\Models\Staff;
use App\Service\Staff\Interface\StaffInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffService implements StaffInterface
{


    public function allStaff(): Collection|array
    {
        return Staff::with(['country','state','city'])->get();
    }

    public function getStaff($staff_id): Model|Collection|Builder|array|null
    {
        return Staff::with(['country','state','city'])->find($staff_id);
    }

    public function add($data)
    {
        $validated = Validator::make($data,[
           'first_name' => 'required',
           'last_name' => 'required',
           'phone' => 'required',
           'email' => 'required:unique:staff',
           'country_id' => 'required',
           'state_id' => 'required',
           'city_id' => 'required',
           'address' => 'required',
           'zip' => 'required',
           'password' => 'required|min:6',
        ]);

        if($validated->fails()){
            return false;
        }
        $data['company_id'] = $this->getCompanyId();
        $staff = new Staff();
        if (isset($data['avatar'])) {
            $path = $this->getAvatarPath();
            $data['avatar'] = FileHelper::upload($data['avatar'],$path);
        }
        $staff->fill($data);
        $staff->save();
        return true;
    }

    public function update($staff_id)
    {

    }

    public function delete($staff_id)
    {

    }

    private function getCompanyId()
    {
        return Auth::user()->company->id;
    }

    private function getAvatarPath(): string
    {
        return '/public/staff';
    }
}