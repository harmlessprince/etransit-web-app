<?php


namespace App\Classes;
use Exception;
use App\Models\NyscHub;
use App\Models\Terminal;
use Illuminate\Support\Facades\DB;


class NyscRepo
{
    public static function addHub($location_id, $terminal_name=null,$terminal_address = null)
    {
        try{
            DB::beginTransaction();
            $hub = NyscHub::create([
                'location_id' => $location_id
            ]);
            if($hub && $terminal_name && $terminal_address){
                Terminal::create([
                        'terminal_name' => $terminal_name,
                        'terminal_address' => $terminal_address,
                        'tenant_id' => session()->get('tenant_id'),
                        'destination_id' => $location_id
                    ]);
            }
            DB::commit();

        }catch(Exception $e){
            return $e;
        }

        return true;
    }
}
