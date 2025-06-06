<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Café',
                'description' => 'Café colombiano de las mejores regiones cafeteras del país'
            ],
            [
                'name' => 'Artesanías',
                'description' => 'Productos artesanales hechos a mano por artesanos colombianos'
            ],
            [
                'name' => 'Alimentos Típicos',
                'description' => 'Comida tradicional y productos alimenticios colombianos'
            ],
            [
                'name' => 'Dulces y Postres',
                'description' => 'Dulces tradicionales y postres típicos de Colombia'
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Bebidas tradicionales y refrescos colombianos'
            ],
            [
                'name' => 'Textiles',
                'description' => 'Productos textiles y ropa tradicional colombiana'
            ],
            [
                'name' => 'Cuidado Personal',
                'description' => 'Productos naturales para el cuidado personal con ingredientes colombianos'
            ],
            [
                'name' => 'Especias y Condimentos',
                'description' => 'Especias, hierbas y condimentos típicos de la cocina colombiana'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
