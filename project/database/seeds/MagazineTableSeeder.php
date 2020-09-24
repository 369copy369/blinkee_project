<?php

use Illuminate\Database\Seeder;

class MagazineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Magazine::class, 250)->create();
    }
}
