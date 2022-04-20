<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner as BecomePartner;
use Spatie\Permission\Models\Role;
use DataTables;

class Partner extends Controller
{
    public function partners()
    {
        return view('admin.partner.all');
    }


    public function viewPartner($partner_id)
    {
        $partner = BecomePartner::find($partner_id);

        return view('admin.partner.view', compact('partner'));
    }

    public function fetchBecomePartners(Request $request)
    {
        if ($request->ajax()) {
            $data = BecomePartner::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/view-partners/$id' class='delete btn btn-primary btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

}
