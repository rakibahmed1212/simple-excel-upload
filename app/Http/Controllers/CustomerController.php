<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Jobs\ImportCustomersJob;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $customers = Customer::query();

        $branches = Customer::select('branch_id')
            ->groupBy('branch_id')
            ->pluck('branch_id', 'branch_id');
        $customers->when($request->gender, function ($query) use ($request) {
            return $query->where('gender', $request->gender);
        });

        $customers->when($request->branch, function ($query) use ($request) {
            return $query->where('branch_id', $request->branch);
        });

        $customers = $customers->get();
        return view('welcome', compact('customers', 'branches'));
    }
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:csv']);
        // dd($request->all());
        $path = $request->file('file')->store('uploads');


        ImportCustomersJob::dispatch($path);

        return redirect()->back()->with('message', 'Import started!');
    }
    public function getCustomerCounts()
    {
        $counts = DB::select('CALL GetCustomerCounts()');
        return view('show-store-proc', compact('counts'));
    }
}
