<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $supplierId = Auth::id();

        // Lấy danh sách các tenders công khai
        $publicTenders = Tender::where('visibility', 'Public')->get();

        // Lấy danh sách các tenders riêng tư mà supplier này được mời
        $privateTenders = Tender::where('visibility', 'Private')
            ->whereHas('invites', function ($query) use ($supplierId) {
                $query->where('supplier_id', $supplierId);
            })
            ->get();

        return view('suppliers.index', compact('publicTenders', 'privateTenders'));
    }
}