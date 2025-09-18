<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->catchPhrase(),
            'description' => fake()->realText(),
            'price' => random_int(1, 99999),
            'featured_photo' => $this->generateRandomNoiseImage(),
        ];
    }

    private function generateRandomNoiseImage(int $height = 600, int $width = 600): string
    {
        $imageResource = imagecreatetruecolor($height, $width);
        $red = random_int(0, 255);
        $green = random_int(0, 255);
        $blue = random_int(0, 255);
        $color = imagecolorallocate($imageResource, $red, $green, $blue);

        $totalPoints = [];
        $length = random_int(3, 20);
        for ($n = 0; $n < $length; $n++) {
            $totalPoints[] = random_int(0, $height);
            $totalPoints[] = random_int(0, $width);
        }
        imagefilledpolygon($imageResource, $totalPoints, $color);
        $fileName = fake()->uuid() . '.jpg';
        $filePath = storage_path("app/public/images/{$fileName}");
        imagejpeg($imageResource, $filePath);
        imagedestroy($imageResource);
        return $fileName;
    }
}
