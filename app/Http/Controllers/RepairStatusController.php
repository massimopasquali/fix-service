<?php
namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;

class RepairStatusController extends Controller
{
    public function show(Request $request)
    {
        $repair = null;
        if ($request->filled('ticket')) {
            $repair = Repair::where('ticket_code', strtoupper($request->ticket))->first();
        }
        return view('repair-status', compact('repair'));
    }
}
