<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Terminal;

class TerminalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Terminal::create([
            'terminal_name' => 'Ikeja Terminal',
            'terminal_address' => '2 Church Street Ikeja '
        ]);
        Terminal::create([
            'terminal_name' => 'Lekki Terminal',
            'terminal_address' => '2 Church Street Ikeja '
        ]);
        Terminal::create([
            'terminal_name' => 'Apapa Terminal',
            'terminal_address' => '2 Church Street Ikeja '
        ]);
        Terminal::create([
            'terminal_name' => 'Ajah Terminal',
            'terminal_address' => '2 Church Street Ikeja '
        ]);
        Terminal::create([
            'terminal_name' => 'Agege Terminal',
            'terminal_address' => '2 Church Street Ikeja '
        ]);
        Terminal::create([
            'terminal_name' => 'Berger Terminal',
            'terminal_address' => '2 Church Street Ikeja '
        ]);
    }
}
