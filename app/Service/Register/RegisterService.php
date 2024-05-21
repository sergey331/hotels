<?php

namespace App\Service\Register;

use App\Models\Company;
use App\Models\User;
use function Laravel\Prompts\error;

class RegisterService
{

    private array $general = [];
    private array $address = [];
    private array $company = [];

    private User $user;
    public function setData(array $data): void
    {
        $this->general = $data['general'];
        $this->address = $data['address'];
        $this->company = $data['company'];
    }

    public function processGeneral(): void
    {
        $this->general['dob'] = date('Y-m-d', strtotime($this->general['dob']));
        $this->user = User::create($this->general);
    }
    public function processAddress(): void
    {
        $this->user->update($this->address);
        $this->company['user_id']= $this->user->id;
    }
    public function processCompany()
    {
        Company::create($this->company);
    }
}