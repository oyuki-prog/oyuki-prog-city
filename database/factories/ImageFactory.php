<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fileName = time() . rand(1, 10000) . '.jpg';
        $file = UploadedFile::fake()->image($fileName);
        $target_path = storage_path('app/public/article_image');
        $file->move($target_path, $fileName);
        return [
            'article_id' => rand(1, 40),
            'img_path' => 'article_image/' . $fileName,
        ];
    }
}
