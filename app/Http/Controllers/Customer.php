<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\CustomerWelcomeNotification;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class Customer extends Controller
{
    public function customerIndex()
    {
        return view('admin.customer.index');
    }

    public function addCustomer()
    {
        return view('admin.customer.add');
    }

    public function storeCustomer(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'phone_number' => 'required|numeric',
            'nin' => 'sometimes'
        ]);

        $validated['password'] = Hash::make(123456);

        $validated['nin'] = Hash::make($validated['nin']);

        if(User::create($validated)){
            Notification::route('mail', $validated['email'])
                ->notify(new CustomerWelcomeNotification($validated, 123456));

            $success = 'Customer created successfully';
            return redirect(url('admin/customers'))->with(compact('success'));
        }else{
            $error = 'Unable to create Customer';
            return redirect(url('admin/customers'))->with(compact('error'));
        }





    }

    public function customers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/customer/$id' class='success btn btn-success btn-sm'>View</a>";
//                    "<a href='/admin/customer/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/admin/customer/$id' class='delete btn btn-danger btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }


    public function getCustomer($customer_id)
    {
        $user = User::where('id' , $customer_id)->with(['transactions' => function($query)
        {
            $query->with('service')->limit(5)->latest()->get();
        }])->firstorfail();

        $totalTransactions = \App\Models\Transaction::where('user_id',$customer_id)->pluck('amount')->sum();

        return view('admin.customer.view' , compact('user','totalTransactions'));
    }


    public function suspendUser($customer_id)
    {
        $user = User::where('id',$customer_id)->first();

        $user->update(['banned_status' => 1]);

        Alert::success('Success ', 'User account has been suspended successfully');

        return back();
    }


    public function activateUser($customer_id)
    {
        $user = User::where('id',$customer_id)->first();

        $user->update(['banned_status' => 0]);

        Alert::success('Success ', 'User account has been activated successfully');

        return back();

    }


    public function customerTransaction($customer_id)
    {
        $user = User::find($customer_id);

        return view('admin.customer.tranx', compact('user'));
    }


    public function fetchCustomerTransaction(Request $request ,$customer_id)
    {
        if ($request->ajax()) {
            $data = \App\Models\Transaction::where('user_id',$customer_id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/view-transaction/$id' class='success btn btn-success btn-sm'>View</a>";
//                    "<a href='/admin/customer/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/admin/customer/$id' class='delete btn btn-danger btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


}
