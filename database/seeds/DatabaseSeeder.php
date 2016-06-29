<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(AdminTableSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(ArticleTableSeeder::class);
         $this->call(ArticleCatTableSeeder::class);
         $this->call(CategoryTableSeeder::class);
         $this->call(BrandTableSeeder::class);
         $this->call(GoodsTableSeeder::class);
         $this->call(GoodsImageTableSeeder::class);
         $this->call(RoleTableSeeder::class);
    }
}
