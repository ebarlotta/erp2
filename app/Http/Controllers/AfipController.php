<?php

namespace App\Http\Controllers;

use App\Services\AfipService;
use Illuminate\Http\Request;

class AfipController extends Controller
{
    protected $afipService;

    public function __construct(AfipService $afipService)
    {
        $this->afipService = $afipService;
    }

    public function checkStatus()
    {
        try {
            $status = $this->afipService->getDummyData();
            return response()->json([
                'success' => true,
                'data' => $status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getLastVoucher(Request $request)
    // public function getLastVoucher()
    {
        $request->validate([
            'point_of_sale' => 'required|numeric',
            'type' => 'required|numeric'
        ]);

        try {
            $last = $this->afipService->getLastAuthorized(
                $request->point_of_sale,
                $request->type
            );
            
            return response()->json([
                'success' => true,
                'last_voucher' => $last
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}