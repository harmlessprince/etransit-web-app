<?php

namespace App\Http\Controllers\Eticket;

use App\Exports\VehicleExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleCreateRequest;
use App\Imports\VehicleImport;
use App\Models\Bus;
use App\Models\BusType;
use App\Models\Destination;
use App\Models\Driver;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Tenant;
use App\Models\Terminal;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use RealRashid\SweetAlert\Facades\Alert;
use function app;
use function compact;
use function session;
use function view;

class ManageBus extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function allBuses()
    {
        $busCount = Bus::count();
        $terminalCount = Terminal::count();
        $schedule = Schedule::count();


        return view('Eticket.bus.index', compact('busCount', 'terminalCount', 'schedule'));
    }


    /**
     * @param Request $request
     * @return void
     */
    public function fetchOBuses(Request $request)
    {
        if ($request->ajax()) {
            $data = Bus::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/edit-tenant-bus/$id'  class='edit btn btn-success btn-sm'>Edit</a> <a href='/e-ticket/view-tenant-bus/$id' class='delete btn btn-primary btn-sm'>View</a> <a href='#' class='delete btn btn-danger btn-sm' onclick='deleteItem($id)'>Delete</a>";

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    /**
     * @param $bus_id
     * @return Application|Factory|View
     */
    public function viewBus($bus_id)
    {
        $authGuard = auth()->guard('e-ticket');
        $findBus = Bus::with('driver', 'schedules')->withoutGlobalScopes()->find($bus_id)->first();

        if ($authGuard->user()) {
            return view('Eticket.bus.view', compact('findBus'));
        }
        return view('pages.booking.view-bus', compact('findBus'));
    }


    /**
     * @return Application|Factory|View
     */
    public function addNewBus()
    {
        $busTypes = BusType::all();
        $authGuard = app('auth')->guard('admin');
        if ($authGuard->user()) {
            $tenants = Tenant::get(['id', 'company_name']);
            return view('admin.bus.new', compact('tenants', 'busTypes'));
        }
        return view('Eticket.bus.new', compact('busTypes'));
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function createTenantBus(Request $request)
    {

        $this->validateBusRequest($request);


        $files = $request->file('bus_pictures');
        foreach ($files as $file) {
            $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
            $bus_pictures[] = $uploadedFileUrl;
        }
        $bus_pictures = json_encode($bus_pictures);


        $files = $request->file('bus_proof_of_ownership');
        foreach ($files as $file) {
            $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
            $bus_proof_of_ownership[] = $uploadedFileUrl;
        }
        $bus_proof_of_ownership = json_encode($bus_proof_of_ownership);


        //service ID 1 == Bus Booking
        //the value should change if there are changes to the way the service is arranged
        $newBus = new Bus;
        $newBus->bus_model = $request->bus_model;
        $newBus->bus_type = $request->bus_type;
        $newBus->bus_registration = $request->bus_registration;
        $newBus->wheels = $request->wheels;
        $newBus->tenant_id = $request->tenant_id ?? session()->get('tenant_id');
        $newBus->seater = $request->seater;
        $newBus->bus_available_seats = $request->bus_available_seats;
        $newBus->bus_year = $request->bus_year;
        $newBus->bus_proof_of_ownership = $bus_proof_of_ownership;
        $newBus->bus_pictures = $bus_pictures;
        $newBus->bus_colour = $request->bus_colour;
        $newBus->service_id = 1;
        $newBus->air_conditioning = $request->air_conditioning == 'on' ? 1 : 0;
        $newBus->save();

        Alert::success('Success ', 'Bus added successfully');

        return redirect('e-ticket/buses');
    }

    /**
     * @return Application|Factory|View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addScheduleView()
    {
        $pickups = $destinations = Destination::select('id', 'location')->get();
        $tenant_id = session()->get('tenant_id');
        $buses = Bus::where('tenant_id', $tenant_id)->select('id', 'bus_registration')->get();
        $terminals = Terminal::where('tenant_id', $tenant_id)->get();
        $services = Service::where('status', 'active')->get();

        $authGuard = app('auth')->guard('admin');
        if ($authGuard->user()) {
            $tenants = Tenant::get(['id', 'company_name']);
            return view('admin.vehicle.add-bus-schedule', compact('tenants', 'services', 'terminals', 'pickups', 'destinations', 'buses'));
        }
        return view('Eticket.bus.add-bus-schedule', compact('services', 'terminals', 'pickups', 'destinations', 'buses'));
    }

    /**
     * @param ScheduleCreateRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function postScheduleView(ScheduleCreateRequest $request)
    {

        //validate departure date and time
        $departureTime = Carbon::parse("$request->departure_date $request->departure_time");
        if ($departureTime->diffInHours(Carbon::now()) <= 24) {
            throw  ValidationException::withMessages([
                'departure' => 'Departure time should be greater than 24 hours from now!',
            ]);
        }

        $s = $request->departure_date;
        $date = strtotime($s);
        $formattedDate = date('Y-m-d', $date);
        $schedule = new Schedule();

        $schedule->terminal_id = $request->terminal_id;
        $schedule->bus_id = $request->bus_id;
        $schedule->pickup_id = $request->pickup_id;
        $schedule->destination_id = $request->destination_id;
        $schedule->fare_adult = $request->adult_tfare;
        $schedule->service_id = $request->service_id;
        $schedule->fare_children = $request->child_tfare;
        $schedule->departure_date = $formattedDate;
        $schedule->departure_time = $request->departure_time;
        $schedule->tenant_id = $request->tenant_id ?? session()->get('tenant_id');
        $schedule->seats_available = $request->number_of_seats;
        $schedule->save();

        return redirect()->route('add-schedule-view');
    }

    /**
     * @param $bus_id
     * @return Application|Factory|View
     */
    public function assignDriver($bus_id)
    {
        $bus = Bus::find($bus_id);

        return view('Eticket.bus.assign-driver', compact('bus'));
    }

    /**
     * @param Request $request
     * @param $bus_id
     * @return Application|RedirectResponse|Redirector
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function assignDriverToBus(Request $request, $bus_id)
    {
        request()->validate([
            'driver_phone_number' => 'required'
        ]);

        $findBus = Bus::find($bus_id);

        if (!$findBus) {
            Alert::error('Error', 'No bus found');
            return back();
        }


        $findDriver = Driver::where('tenant_id', session()->get('tenant_id'))->where('phone_number', $request->driver_phone_number)->first();

        if (!$findDriver) {
            Alert::error('Error', 'No driver driver found with that number in your organization');
            return back();
        }

        $findBus->update([
            'driver_id' => $findDriver->id
        ]);

        Alert::success('Success ', 'Driver assigned to bus successfully');

        return redirect('e-ticket/view-tenant-bus/' . $bus_id);

    }


    /**
     * @param $driver_id
     * @param $bus_id
     * @return Application|RedirectResponse|Redirector
     */
    public function removeDriverFromBus($driver_id, $bus_id)
    {
        $findDriver = Driver::find($driver_id);

        if (!$findDriver) {
            Alert::error('Error', 'No driver driver found with that number in your organization');
            return back();
        }

        $findBus = Bus::find($bus_id);

        $findBus->update([
            'driver_id' => null
        ]);

        Alert::success('Success ', 'Driver removed from bus successfully');

        return redirect('e-ticket/view-tenant-bus/' . $bus_id);
    }


    /**
     * @param $bus_id
     * @return Application|Factory|View|RedirectResponse
     */
    public function scheduleTrip($bus_id)
    {
        $bus = Bus::find($bus_id);

        if (!$bus) {
            Alert::error('Error ', 'Unable to fetch bus');
            return back();
        }

        $locations = Destination::all();
        $terminals = Terminal::all();

        return view('Eticket.bus.schedule-event', compact('bus', 'locations', 'terminals'));

    }

    /**
     * @param $bus_id
     * @return Application|Factory|View
     */
    public function editBus($bus_id)
    {
        $bus = Bus::with('driver')->find($bus_id);

        return view('Eticket.bus.edit-bus', compact('bus'));
    }

    /**
     * @param $bus_id
     * @return RedirectResponse
     */
    public function deleteBus($bus_id)
    {
        $bus = Bus::findOrFail($bus_id);
        $bus->delete();

        return redirect()->to('/e-ticket/buses');
    }


    /**
     * @param Request $request
     * @param $bus_id
     * @return Application|RedirectResponse|Redirector
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function updateBus(Request $request, $bus_id)
    {
//        $this->validateBusRequest($request);

        $data = [
            'bus_model' => $request->bus_model,
            'bus_type' => $request->bus_type,
            'bus_registration' => $request->bus_registration,
            'wheels' => $request->wheels,
            'tenant_id' => session()->get('tenant_id'),
            'seater' => $request->seater,
            'bus_available_seats' => $request->bus_available_seats,
            'bus_year' => $request->bus_year,
            'bus_colour' => $request->bus_colour,
            'service_id' => 1,
            'air_conditioning' => $request->air_conditioning == 'on' ? 1 : 0,
        ];

        if ($files = $request->file('bus_pictures')) {
            foreach ($files as $file) {
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $bus_pictures[] = $uploadedFileUrl;
            }
            $bus_pictures = json_encode($bus_pictures);
            $data['bus_pictures'] = $bus_pictures;
        }


        if ($files = $request->file('bus_proof_of_ownership')) {
            foreach ($files as $file) {
                $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $bus_proof_of_ownership[] = $uploadedFileUrl;
            }
            $bus_proof_of_ownership = json_encode($bus_proof_of_ownership);
            $data['bus_proof_of_ownership'] = $bus_proof_of_ownership;
        }


        $bus = Bus::find($bus_id);
        $bus->update($data);


        Alert::success('Success ', 'Bus updated successfully');

        return redirect('e-ticket/buses');
    }


    /**
     * @return Application|Factory|View
     */
    public function importExportView()
    {
        return view('Eticket.bus.import-bus');
    }

    /**
     * @param Request $data
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addVehicle(Request $data)
    {

        $vehicle = new Bus();
        $vehicle->bus_type = $data['bus_type'];
        $vehicle->bus_model = $data['bus_model'];
        $vehicle->bus_registration = $data['bus_registration'];
        $vehicle->air_conditioning = $data['Ac_status'];
        $vehicle->wheels = $data['wheels'];
        $vehicle->seater = $data['seats'];
        $vehicle->tenant_id = session()->get('tenant_id');
        $vehicle->save();

        toastr()->success('Data saved successfully');
        return response()->json(['success' => true, 'message' => 'Vehicle saved successfully']);

    }

    /**
     * @return Collection
     */
    public function exportVehicle()
    {
        $vehicles = Bus::select(["id", "bus_type", "bus_model", "bus_registration", "air_conditioning", "wheels", "seater"])->get();

        return Excel::download(new VehicleExport($vehicles), 'bus.xlsx');

    }

    /**
     * @return Collection
     */
    public function importVehicle(Request $request)
    {

        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        Excel::import(new VehicleImport, request()->file('excel_file'));
        toastr()->success('Data saved successfully');
        return response()->json(['message' => 'uploaded successfully'], 200);
    }


    /**
     * @param $request
     * @return void
     */
    private function validateBusRequest($request)
    {
        $request->validate([
            'bus_model' => 'required',
            'bus_type' => 'required',
            'bus_registration' => 'required|unique:buses',
            'wheels' => 'required',
            'seater' => 'required',
            'driver_phone_number' => 'sometimes',
            'bus_year' => 'required|date_format:Y',
            'bus_colour' => 'required|string',
            'bus_available_seats' => 'required|numeric|lte:seater',
            'bus_pictures' => 'required|file|mimes:jpeg,png,jpg,gif',
            'bus_proof_of_ownership' => 'required|file',
            'tenant_id' => 'sometimes|exists:tenants,id',
        ]);
    }

}
