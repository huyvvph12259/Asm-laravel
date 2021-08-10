<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imgPath = $this->faker->image(storage_path('app/public/uploads/brands'), $width = 640, $height = 480, 'cats', false);
        return [
            'name'=>$this->faker->name(),
            'address'=>$this->faker->address(),
            'image'=>"uploads/brands/" .$imgPath,
        ];
    }
}
