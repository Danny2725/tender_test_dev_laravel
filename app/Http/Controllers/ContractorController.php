<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractorController extends Controller
{
    public function index()
    {
        // Lấy danh sách các tenders mà người dùng hiện tại đã tạo
        $tenders = Tender::where('creator_id', Auth::id())->get();

        return view('contractors.index', compact('tenders'));
    }
}