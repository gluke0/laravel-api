<?php

namespace Database\Seeders;

use App\Models\Admin\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['CSS', 'HTML', 'Laravel', 'JavaScript', 'Vue', 'Vite', 'PHP', ];

        foreach($technologies as $language){
            $new_technology = new Technology();
            $new_technology->name = $language;
            $new_technology->slug = Str::slug($new_technology->name, '-');
            $new_technology->save();
        }
    }
}
