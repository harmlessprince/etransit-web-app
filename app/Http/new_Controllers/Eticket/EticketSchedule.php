<?php

namespace App\Http\new_Controllers\Eticket;

use App\Classes\ReturnUUIDTracker;
use App\Exports\ScheduleExport;
use App\Http\Controllers\Controller;
use App\Imports\ScheduleImport;
use App\Models\Bus;
use App\Models\Schedule as EventSchedule;
use App\Models\SeatTracker;
use App\Models\Terminal;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class EticketSchedule extends Controller
{
    public function addEticketSchedule(Request $request)
    {

        request()->validate([
            'departureTime' => 'required',
            'Tfare' => 'required',
            'TfareChild' => 'required'
        ]);

        $service = Terminal::where('id', $request['terminal'])->with('service')->first();
        $numberOfSeats = Bus::where('id', $request['busId'])->select('seater')->first();

        $serviceID = $service->id;
        try {
            DB::beginTransaction();
            $scheduleEvent = new EventSchedule();
            $scheduleEvent->terminal_id = (int)$request['terminal'];
            $scheduleEvent->service_id = 1;
            $scheduleEvent->bus_id = (int)$request['busId'];
            $scheduleEvent->pickup_id = (int)$request['pickUp'];
            $scheduleEvent->destination_id = (int)$request['destination'];
            $scheduleEvent->fare_adult = $request['Tfare'];
            $scheduleEvent->fare_children = $request['TfareChild'];
            $scheduleEvent->departure_date = $request['eventDate'];
            $scheduleEvent->departure_time = $request['departureTime'];
            $scheduleEvent->return_date = $request['returnDate'] ?? null;
            $scheduleEvent->seats_available = $numberOfSeats->seater;
            $scheduleEvent->return_uuid_tracker = ReturnUUIDTracker::generate();
            $scheduleEvent->tenant_id = session()->get('tenant_id');
            $scheduleEvent->save();

            $seatCount = (int)$numberOfSeats->seater;
            for ($i = 0; $i < $seatCount; $i++) {
                $seatTracker = new SeatTracker();
                $seatTracker->schedule_id = $scheduleEvent->id;
                $seatTracker->bus_id = (int)$request['busId'];
                $seatTracker->seat_position = $i + 1;
                $seatTracker->save();
            }


            if ($scheduleEvent && !is_null($request['returnDate'])) {
                $scheduleReturnTripEvent = new EventSchedule();
                $scheduleReturnTripEvent->terminal_id = (int)$request['terminal'];
                $scheduleReturnTripEvent->service_id = 1;
                $scheduleReturnTripEvent->bus_id = (int)$request['busId'];
                $scheduleReturnTripEvent->pickup_id = (int)$request['destination'];
                $scheduleReturnTripEvent->destination_id = (int)$request['pickUp'];
                $scheduleReturnTripEvent->fare_adult = $request['Tfare'];
                $scheduleReturnTripEvent->fare_children = $request['TfareChild'];
                $scheduleReturnTripEvent->departure_date = $request['returnDate'];
                $scheduleReturnTripEvent->departure_time = $request['departureTime'];
                $scheduleReturnTripEvent->return_date = $request['eventDate'];
                $scheduleReturnTripEvent->seats_available = $numberOfSeats->seater;
                $scheduleReturnTripEvent->return_uuid_tracker = $scheduleEvent->return_uuid_tracker;
                $scheduleReturnTripEvent->isReturn = 1;
                $scheduleReturnTripEvent->tenant_id = session()->get('tenant_id');
                $scheduleReturnTripEvent->save();

                $seatCount = (int)$numberOfSeats->seater;
                for ($i = 0; $i < $seatCount; $i++) {
                    $seatTracker = new SeatTracker();
                    $seatTracker->schedule_id = $scheduleReturnTripEvent->id;
                    $seatTracker->bus_id = (int)$request['busId'];
                    $seatTracker->seat_position = $i + 1;
                    $seatTracker->save();
                }
            }


            DB::commit();
            return response()->json(['success' => true, 'message' => 'Trip has been scheduled successfully']);
        } catch (Exception $e) {
            DB::rollback();
//            Log::info($e->getMessage());

            return response()->json(['success' => false, 'message' => 'Trip could not be scheduled .Try again']);

        }
    }


    public function allScheduledTrip()
    {
        $findSchedule = EventSchedule::where('tenant_id', session()->get('tenant_id'))->with(['pickup', 'destination', 'bus', 'terminal'])->get();
        $isEmptySeatAvailable = false;


        $emptySeatCount = [];
        foreach ($findSchedule->chunk(30) as $index => $schedule) {
            foreach ($schedule as $i => $sch) {
                $seatTracker = SeatTracker::where('schedule_id', $sch->id)->get();
                if (count($seatTracker) < 1) {
                    $isEmptySeatAvailable = true;
                    array_push($emptySeatCount, $i);
                }
            }
        }
        $seatCount = count($emptySeatCount);

        return view('Eticket.bus.all-schedule-trip', compact('seatCount', 'isEmptySeatAvailable'));
    }

    public function fetchAllSchedules(Request $request)
    {
        if ($request->ajax()) {
            $data = EventSchedule::with(['pickup', 'destination', 'bus', 'terminal'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/view-each-schedule/$id' class='delete btn btn-primary btn-sm'>View</a>";
//                    <a href='/e-ticket/edit-tenant-bus/$id'  class='edit btn btn-success btn-sm'>Edit</a>
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function viewEachSchedule($schedule_id)
    {

        $findSchedule = EventSchedule::where('id', $schedule_id)->with(['pickup', 'destination', 'bus', 'terminal'])->first();
        $seatTracker = SeatTracker::where('schedule_id', $schedule_id)->get();

        return view('Eticket.bus.view-schedule', compact('findSchedule', 'seatTracker'));
    }

    public function generateSeatTrackerForScheduleWithEmptySeat($schedule_id)
    {


        $findSchedule = EventSchedule::where('id', $schedule_id)->select('bus_id', 'seats_available')->first();

        $seatCount = (int)$findSchedule->seats_available;
        for ($i = 0; $i < $seatCount; $i++) {
            $seatTracker = new SeatTracker();
            $seatTracker->schedule_id = $schedule_id;
            $seatTracker->bus_id = (int)$findSchedule->bus_id;
            $seatTracker->seat_position = $i + 1;
            $seatTracker->save();
        }

        Alert::success('Success', $findSchedule->seats_available . ' Seat(s) generated  successfully');
        return back();
    }

    public function viewBusSchedule($bus_id)
    {

        $bus = Bus::find($bus_id);

        return view('Eticket.bus.each-bus-schedule', compact('bus'));
    }

    public function viewEachBusSchedule(Request $request, $bus_id)
    {

        if ($request->ajax()) {
            $data = EventSchedule::with(['pickup', 'destination', 'bus', 'terminal'])->where('bus_id', $bus_id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $actionBtn = "<a href='/e-ticket/view-each-schedule/$id' class='delete btn btn-primary btn-sm'>View</a>";
//                    <a href='/e-ticket/edit-tenant-bus/$id'  class='edit btn btn-success btn-sm'>Edit</a>
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function importExportViewSchedule()
    {
        return view('Eticket.schedule.import');
    }

    public function exportSchedule()
    {

        $schedules = DB::table('schedules')
            ->select('terminal_name', 'name', 'buses.bus_registration as Number Plate', 'pickups.location as pickup'
                , 'destinations.location', 'fare_adult', 'fare_children', 'departure_date', 'departure_time')
            ->join('terminals', 'schedules.terminal_id', '=', 'terminals.id')
            ->join('services', 'schedules.service_id', '=', 'services.id')
            ->join('buses', 'schedules.bus_id', '=', 'buses.id')
            ->join('pickups', 'schedules.pickup_id', '=', 'pickups.id')
            ->join('destinations', 'schedules.destination_id', '=', 'destinations.id')
            ->get();

        return Excel::download(new ScheduleExport($schedules), 'schedule.csv');
    }


    public function importSchedule(Request $request)
    {

        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        Excel::import(new ScheduleImport, request()->file('excel_file'));

//        toastr()->success('Data saved successfully');
        Alert::success('Success', 'Data imported successfully');
        return back();

//        return response()->json(['message' => 'uploaded successfully'], 200);
    }


    public function updateScheduleStatus(Request $request, $schedule_id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $findSchedule = EventSchedule::where('id', $schedule_id)->first();

        $findSchedule->update([
            'trip_status' => $request->status
        ]);

        Alert::success('Success', 'Status updated successfully');

        return back();
    }

    public function globalSeatTracker()
    {
        $findSchedule = EventSchedule::where('tenant_id', session()->get('tenant_id'))->with(['pickup', 'destination', 'bus', 'terminal'])->get();

        $emptySeatScheduleId = [];

        foreach ($findSchedule->chunk(30) as $schedule) {
            foreach ($schedule as $sch) {

                $seatTracker = SeatTracker::where('schedule_id', $sch->id)->get();

                if (count($seatTracker) < 1) {
                    $emptySeatScheduleId[] = $sch->id;
                }
            }
        }

        $emptySeatSchedules = EventSchedule::whereIn('id', $emptySeatScheduleId)->with(['pickup', 'destination', 'bus', 'terminal'])->get();

        return view('Eticket.bus.load-empty-seat', compact('emptySeatSchedules'));
    }

    public function globalSeatGenerator()
    {
        $findSchedule = EventSchedule::where('tenant_id', session()->get('tenant_id'))->with(['pickup', 'destination', 'bus', 'terminal'])->get();

        foreach ($findSchedule->chunk(30) as $schedule) {
            foreach ($schedule as $sch) {
                $seatTracker = SeatTracker::where('schedule_id', $sch->id)->get();

                if (count($seatTracker) < 1) {
                    $seatCount = (int)$sch->seats_available;
                    for ($i = 0; $i < $seatCount; $i++) {
                        $seatTracker = new SeatTracker();
                        $seatTracker->schedule_id = $sch->id;
                        $seatTracker->bus_id = (int)$sch->bus_id;
                        $seatTracker->seat_position = $i + 1;
                        $seatTracker->save();
                    }
                }
            }
        }
        Alert::success('Success', 'All Empty seats has been set successfully');
        return back();
    }

}
