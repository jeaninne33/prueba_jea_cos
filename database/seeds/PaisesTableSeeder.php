<?php

use Illuminate\Database\Seeder;

class PaisesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('paises')->delete();
        
        \DB::table('paises')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'COLOMBIA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'VENEZUELA',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}