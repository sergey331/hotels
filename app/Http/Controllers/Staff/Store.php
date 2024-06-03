<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Service\Staff\StaffService;
use Illuminate\Http\Request;

class Store extends Controller
{
    public function __construct(
        private StaffService $staffService
    )
    {
    }


    public function __invoke(Request $request)
    {
        $data = $request->all();
        $result = $this->staffService->add($data);
        return response()->json($result);
    }
}
