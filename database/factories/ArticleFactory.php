<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fileName = time() . rand(1, 10000) . '.jpg';
        $file = UploadedFile::fake()->image($fileName);
        $target_path = storage_path('app/public/bg_image');
        $file->move($target_path, $fileName);

        return [
            'user_id' => rand(1, 20),
            'title' => $this->faker->sentence(),
            'prefecture_id' => rand(1, 47),
            'city_name' => $this->faker->city(),
            'category_id' => rand(1, 6),
            'body' => $this->faker->paragraph(),
            'bg_img_path' => 'bg_image/' . $fileName,
        ];
    }
}
