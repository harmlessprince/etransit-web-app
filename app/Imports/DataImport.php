<?php
namespace App\Imports;

use App\Models\Bus;
use App\Models\Pickup;
use App\Models\Tenant;
use Maatwebsite\Excel;

use App\Models\BusType;
use App\Models\Eticket;
use App\Models\Terminal;
use App\Models\Destination;
use App\Models\ServiceTenant;
use Illuminate\Validation\Rule;
use App\Classes\ReturnUUIDTracker;
use Database\Seeders\ScheduleData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\Object_;
use App\Models\Schedule as BusSchedule;
use Spatie\Permission\Models\Permission;
use SebastianBergmann\Environment\Console;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class DataImport implements ToCollection,WithHeadingRow
{

    public function collection( Collection $rows)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        foreach($rows as $row){

           $scheduledata = new ScheduleData();
           $scheduledata->terminal = $row['terminal'];
           $scheduledata->operator = $row['operator'];
           $scheduledata->number_plate =$row['number_plate'];
           $scheduledata->pickup = $row['source'];
           $scheduledata->destination = $row['destination'];
           $scheduledata->adult_price = $row['adult_price'];
           $scheduledata->child_price = $row['child_price'];
           $scheduledata->departure_date = $row['departure_date'];
           $scheduledata->departure_time = $row['departure_time'];
//         $scheduledata->return_trip = $row['return_trip'];
           $scheduledata->return_date = $row['return_date'];
//         $scheduledata->return_time = $row['return_time];
           $scheduledata->seats = $row['seats'];
           $scheduledata->terminal_address = $row['terminal_address'];
           $scheduledata->operator_address = $row['operator_address'];
           $scheduledata->operator_phone= $row['operator_phone'];
           $scheduledata->bus_model = $row['bus_model'];
           $scheduledata->bus_type = $row['bus_type'];

           //$out->writeln("terminal: ".$row['terminal'].", operator: ".$scheduledata->operator);

           $password = "0peratorPa$$";

           $tenant = Tenant::where('company_name', $scheduledata->operator)->first();
           $pickup = Pickup::where('location',$scheduledata->pickup)->first();
           $destination = Destination::where('location',$scheduledata->destination)->first();







           if(is_null($tenant)){
               //$out->writeln("null");
               $tenant = new Tenant;
               $tenant->company_name = $scheduledata->operator;
               $tenant->address = $scheduledata->terminal_address;
               $tenant->display_name = $scheduledata->operator;
               $tenant->phone_number = $scheduledata->operator_phone;
               $tenant->save();
               $eticket = new Eticket;
               $eticket->full_name = $scheduledata->operator;
               $eticket->email     = str_replace(' ','',$scheduledata->operator)."@etransitafrica.com";
               $eticket->password  = Hash::make($password);
               $eticket->tenant_id = $tenant->id;
               $eticket->save();

               $role =  Role::create(['guard_name' => 'e-ticket', 'name' => 'Super Admin ' . $tenant->display_name, 'tenant_id' => $tenant->id]);

               $eticket->assignRole($role);

               $permissions = Permission::where('guard_name', 'e-ticket')->get();

               foreach ($permissions as $permission) {
                   $role->givePermissionTo($permission);
               }
                //activate bus service for new operator
                $service = \App\Models\Service::where('name' , 'Bus Booking')->first();
                $newserviceTenant = new ServiceTenant();
                $newserviceTenant->service_id = $service->id;
                $newserviceTenant->tenant_id  = $tenant->id;
                $newserviceTenant->save();

            }else{
               // $out->writeln("not null");
            }

           if($tenant){

            $terminal = Terminal::where('tenant_id',$tenant->id)->where('terminal_name',$scheduledata->terminal)->first();
            $bus = Bus::where('bus_registration',$scheduledata->number_plate)->where('tenant_id',$tenant->id)->first();

           }
           if(is_null($pickup)){
               $pickup =  Pickup::create([
                'location' => $scheduledata->pickup,
            ]);
            if(is_null(Destination::where('location',$scheduledata->pickup)->first()))  Destination::create(['location' => $scheduledata->pickup]);
           }
           if(is_null($destination)){
            $destination =  Destination::create([
                'location' => $scheduledata->destination,
            ]);
            if(is_null(Pickup::where('location',$scheduledata->destination)->first()))  Pickup::create(['location' => $scheduledata->pickup]);
           }
           if(is_null($terminal)){
            $terminal = Terminal::create([
                'terminal_name' => $scheduledata->terminal,
                'terminal_address' => $scheduledata->terminal_address,
                'tenant_id' => $tenant->id,
                'destination_id'=> $destination->id
            ]);
           }
           if(is_null($bus)){
            $newBus = new Bus;
            $newBus->bus_model = $scheduledata->bus_model;
            $newBus->bus_type = $scheduledata->bus_model;
            $newBus->bus_registration = $scheduledata->number_plate;
            $newBus->wheels = 4;
            $newBus->tenant_id = $tenant->id;
            $newBus->seater = $scheduledata->seats;
            $newBus->service_id = 1;
            $newBus->air_conditioning  = 1 ;
            $newBus->save();
            $bus = $newBus;
           }

           $schedule = new BusSchedule();
            $schedule->terminal_id         = $terminal->id;
            $schedule->service_id          = 1;
            $schedule->bus_id              = $bus->id;
            $schedule->pickup_id           = $pickup->id;
            $schedule->destination_id      = $destination->id;
            $schedule->fare_adult          = $scheduledata->adult_price;
            $schedule->fare_children       = $scheduledata->child_price;
            $schedule->departure_date      = date('Y:m:d',strtotime($scheduledata->departure_date));
            $schedule->departure_time      = date('H:i:s',strtotime($scheduledata->departure_time));
            $schedule->return_date         = date('Y:m:d',strtotime($scheduledata->return_date)) ?? null;
            $schedule->seats_available     = $scheduledata->seats ;
            $schedule->return_uuid_tracker = ReturnUUIDTracker::generate();
            $schedule->tenant_id           = $tenant->id;
            $schedule->save();

            $seatCount = (int) $scheduledata->seats;
            for($i = 0 ; $i < $seatCount ; $i++)
            {
                $seatTracker = new \App\Models\SeatTracker();
                $seatTracker->schedule_id = $schedule->id;
                $seatTracker->bus_id      = (int) $bus->id;
                $seatTracker->seat_position = $i + 1;
                $seatTracker->save();
            }


            if($schedule && !is_null($scheduledata->return_date))
            {
                $scheduleReturnTripEvent = new BusSchedule();
                $scheduleReturnTripEvent->terminal_id         = $terminal->id;
                $scheduleReturnTripEvent->service_id          = 1;
                $scheduleReturnTripEvent->bus_id              = $bus->id;
                $scheduleReturnTripEvent->pickup_id           = $pickup->id;
                $scheduleReturnTripEvent->destination_id      = $destination->id;
                $scheduleReturnTripEvent->fare_adult          = $scheduledata->adult_price;
                $scheduleReturnTripEvent->fare_children       = $scheduledata->child_price;
                $scheduleReturnTripEvent->departure_date      = date('Y:m:d',strtotime($scheduledata->return_date));
                $scheduleReturnTripEvent->departure_time      = date('H:i:s',strtotime($scheduledata->departure_time));
                $scheduleReturnTripEvent->return_date         = date('Y:m:d',strtotime($scheduledata->departure_date));
                $scheduleReturnTripEvent->seats_available     = $scheduledata->seats ;
                $scheduleReturnTripEvent->return_uuid_tracker =  $schedule->return_uuid_tracker;
                $scheduleReturnTripEvent->isReturn            =  1;
                $scheduleReturnTripEvent->tenant_id           = $tenant->id;
                $scheduleReturnTripEvent->save();

                $seatCount = (int) $scheduledata->seats;
                for($i = 0 ; $i < $seatCount ; $i++)
                {
                    $seatTracker = new \App\Models\SeatTracker();
                    $seatTracker->schedule_id = $scheduleReturnTripEvent->id;
                    $seatTracker->bus_id      = (int) $bus->id;
                    $seatTracker->seat_position = $i + 1;
                    $seatTracker->save();
                }




        }
     }


    }



}
