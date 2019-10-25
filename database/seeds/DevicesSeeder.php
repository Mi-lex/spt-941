<?php

use Illuminate\Database\Seeder;

class DevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devicesAmount = 10;

        foreach (range(1, $devicesAmount) as $int) {
            factory(App\Device::class)->create(
                [
                    'device_address' => $int + 1
                ]
            );
        }
    }
}