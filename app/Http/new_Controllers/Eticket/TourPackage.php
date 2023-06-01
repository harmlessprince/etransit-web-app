<?php

namespace App\Http\new_Controllers\Eticket;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Service;
use App\Models\TourImage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class TourPackage extends Controller
{
    public function allTours()
    {
       return view('Eticket.Tour.all-tour');
    }

    public function addTours()
    {
        return view('Eticket.Tour.add-tour');
    }

    public function fetchTours(Request $request)
    {
        if ($request->ajax()) {
            $data = Tour::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $actionBtn = "<a href='/admin/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/e-ticket/view-tour/$id'  class='edit btn btn-success btn-sm'>View</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function storeTour(Request $request)
    {
        request()->validate([
            'tour_name'      => 'required',
            'departure_date' => 'required',
            'departure_time' => 'required',
            'duration'       => 'required',
            'location'       =>'required',
            'amount_regular' => 'required',
            'amount_standard'  => 'required'
        ]);


        DB::beginTransaction();
        $service = Service::where('id', 8)->firstorfail();

        $tour = new \App\Models\Tour();
        $tour->name             = $request->tour_name;
        $tour->location         = $request->location;
        $tour->tour_date        = $request->departure_date;
        $tour->tour_time        = $request->departure_time;
        $tour->duration         = abs($request->duration);
        $tour->service_id       = $service->id;
        $tour->tenant_id        = session()->get('tenant_id');
        $tour->amount_regular   = $request->amount_regular;
        $tour->amount_standard  = $request->amount_standard;
        $tour->description      = $request->description;
        $tour->save();

        $images = array();

        if(count($request->file('images')) < 2)
        {
            Alert::error('Warning ', 'Please Upload at least two images');

            return back();
        }

        if($files = $request->file('images')){

            foreach($files as  $file){
                $request->validate([
                    'images' => 'required|array',
                    'images.*' => '|mimes:jpg,jpeg,png|max:4048',
                ]);
                $name = $file->getClientOriginalName();
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $tourImage = new TourImage();
                $tourImage->tour_id = $tour->id;
                $tourImage->path = $uploadedFileUrl;
                $tourImage->save();
            }

        }
        DB::commit();

        Alert::success('Success ', 'Tour added successfully');

        return redirect('e-ticket/tour-packages');
    }


    public function viewTour($tour_id)
    {
        $tour = Tour::with('tourimages')->find($tour_id);

        return view('Eticket.Tour.view-tour', compact('tour'));
    }
}
