<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker; 
use App\Models\Admin\Project; 

// library to use Laravel Helper
use Illuminate\Support\Str; 

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++){
            $newProject = new Project();
            $newProject->title = $faker->sentence(2);
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->description = $faker->text(300);
            $newProject->image = $faker->imageUrl(640, 480, 'animals', true);
            $newProject->link = $faker->sentence(20);
            $newProject->save();
        }
    }
}
