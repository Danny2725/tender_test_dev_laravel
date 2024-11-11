<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\User;
use App\Models\Invite;
use Illuminate\Support\Facades\Auth;

class TenderController extends Controller
{
    public function create()
    {
        return view('tenders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'visibility' => 'required|in:Public,Private',
            'invited_suppliers' => 'nullable|array',
            'invited_suppliers.*' => 'email', 
        ]);
    
        $tender = Tender::create([
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility,
            'creator_id' => Auth::id(),
        ]);
    
        if ($request->visibility == 'Private' && !empty($request->invited_suppliers)) {
            $suppliers = User::whereIn('email', $request->invited_suppliers)
                ->where('role', 'Supplier')
                ->pluck('id');
            foreach ($suppliers as $supplierId) {
                Invite::create([
                    'tender_id' => $tender->id,
                    'supplier_id' => $supplierId,
                ]);
            }
        }
    
        return response()->json(['message' => 'Tender created successfully!']);
    }


    public function edit(Tender $tender)
    {
        return view('tenders.edit', compact('tender'));
    }

    public function update(Request $request, Tender $tender)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'visibility' => 'required|in:Public,Private',
        ]);

        $tender->update([
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility,
        ]);

        return redirect()->route('contractors.index')->with('success', 'Tender updated successfully!');
    }

        public function destroy(Tender $tender)
        {
            $tender->delete();
    
            return response()->json(['success' => 'Tender deleted successfully!']);
        }
}