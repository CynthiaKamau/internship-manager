<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = 'categories';


        $data = array(
            array('category_name' => 'Learning',  'status' => '1', 'user_id' => '1' ),
            array('category_name' => 'Development',  'status' => '1', 'user_id' => '2' ),
            array('category_name' => 'Assesment',  'status' => '1', 'user_id' => '1' ),
            array('category_name' => 'General',  'status' => '1', 'user_id' => '2' ),
            array('category_name' => 'Prorocol',  'status' => '1', 'user_id' => '1' )
        );

        DB::table($tableName)->insert($data);

    }
}
