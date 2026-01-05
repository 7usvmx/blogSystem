<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      // ['name' => 'Technology', 'slug' => 'technology'],
      // ['name' => 'Business', 'slug' => 'business'],
      // ['name' => 'Health', 'slug' => 'health'],
      ['name' => 'Education', 'slug' => 'education'],
      ['name' => 'Travel', 'slug' => 'travel'],
      ['name' => 'Food', 'slug' => 'food'],
      ['name' => 'Entertainment', 'slug' => 'entertainment'],
    ];

    foreach ($categories as $category) {
      Category::create($category);
    }
  }
}
