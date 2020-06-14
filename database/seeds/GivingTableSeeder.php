<?php

use Illuminate\Database\Seeder;
use App\Models\Giving;

class GivingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //一括削除
      Giving::truncate();

      for ($k = 1; $k < 6; $k++) {
          for ($i = 1; $i < 16; $i++) {
              $input = array("gift", "present", "treat", "donation", "reward");
              $rand_keys = array_rand($input, 1);
              if ($i > 9) {
                $datehead = "2020-05-";
              } else {
                $datehead = "2020-05-0";
              }
              Giving::create([
                'user_id' => $k,
                'giving' => $k * $i * 100,
                'purpose' => $input[$rand_keys],
                'date' => $datehead .$i,
              ]);
          }
      }
    }
}
