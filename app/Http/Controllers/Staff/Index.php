<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Service\Staff\StaffService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use \Inertia\Response;
class Index extends Controller
{
    public function __construct(
        private readonly StaffService $staffService
    ){}

    public function __invoke(): Response
    {
        $staffs = $this->staffService->allStaff();
        return Inertia::render('Staff/Index', ['staffs' => $staffs]);
    }
}
