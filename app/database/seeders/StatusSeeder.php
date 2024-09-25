<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        Status::create(['name' => 'pending']);
        Status::create(['name' => 'approved']);
        Status::create(['name' => 'declined']);
    }
}
