<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Café Juan Valdez Huila',
                'description' => 'Café premium del departamento del Huila, con notas cítricas y achocolatadas',
                'price' => 25000.00,
                'stock' => 50
            ],
            [
                'category_id' => 1,
                'name' => 'Café Oma Nariño',
                'description' => 'Café especial de Nariño, cultivado a gran altura con sabor intenso',
                'price' => 32000.00,
                'stock' => 30
            ],
            [
                'category_id' => 1,
                'name' => 'Café Devoción Colombian Blend',
                'description' => 'Mezcla de cafés colombianos de diferentes regiones',
                'price' => 28000.00,
                'stock' => 40
            ],
            [
                'category_id' => 2,
                'name' => 'Mochila Wayuu Tradicional',
                'description' => 'Mochila tejida a mano por artesanas wayuu con diseños ancestrales',
                'price' => 180000.00,
                'stock' => 15
            ],
            [
                'category_id' => 2,
                'name' => 'Sombrero Vueltiao',
                'description' => 'Sombrero tradicional cordobés tejido en caña flecha',
                'price' => 85000.00,
                'stock' => 25
            ],
            [
                'category_id' => 2,
                'name' => 'Hamaca San Jacinto',
                'description' => 'Hamaca artesanal de San Jacinto, Bolívar, tejida en algodón',
                'price' => 220000.00,
                'stock' => 12
            ],
            [
                'category_id' => 2,
                'name' => 'Cerámica de La Chamba',
                'description' => 'Olla de barro negro tradicional del Tolima para cocinar',
                'price' => 65000.00,
                'stock' => 20
            ],
            [
                'category_id' => 3,
                'name' => 'Arepa Paisa (Paquete x12)',
                'description' => 'Arepas tradicionales antioqueñas, listas para calentar',
                'price' => 8500.00,
                'stock' => 60
            ],
            [
                'category_id' => 3,
                'name' => 'Chicharrón Tolimense',
                'description' => 'Chicharrón artesanal del Tolima, empacado al vacío',
                'price' => 22000.00,
                'stock' => 35
            ],
            [
                'category_id' => 3,
                'name' => 'Bocadillo Veleño',
                'description' => 'Dulce de guayaba tradicional de Vélez, Santander',
                'price' => 12000.00,
                'stock' => 80
            ],
            [
                'category_id' => 3,
                'name' => 'Sancocho Costeño (Sobre)',
                'description' => 'Mezcla de especias para preparar sancocho tradicional de la costa',
                'price' => 6500.00,
                'stock' => 45
            ],
            [
                'category_id' => 4,
                'name' => 'Arequipe de Leche',
                'description' => 'Dulce de leche artesanal, cremoso y tradicional',
                'price' => 15000.00,
                'stock' => 55
            ],
            [
                'category_id' => 4,
                'name' => 'Cocadas Blancas',
                'description' => 'Dulce tradicional de coco, típico de la costa caribe',
                'price' => 8000.00,
                'stock' => 70
            ],
            [
                'category_id' => 4,
                'name' => 'Melcocha Boyacense',
                'description' => 'Dulce tradicional de Boyacá hecho con panela',
                'price' => 5500.00,
                'stock' => 90
            ],
            [
                'category_id' => 4,
                'name' => 'Alfajores de Maicena',
                'description' => 'Galletas rellenas de arequipe, tradicionales del altiplano',
                'price' => 18000.00,
                'stock' => 40
            ],
            [
                'category_id' => 5,
                'name' => 'Aguardiente Antioqueño',
                'description' => 'Licor tradicional colombiano con sabor anisado',
                'price' => 45000.00,
                'stock' => 25
            ],
            [
                'category_id' => 5,
                'name' => 'Chicha de Maíz',
                'description' => 'Bebida fermentada tradicional, baja en alcohol',
                'price' => 8500.00,
                'stock' => 30
            ],
            [
                'category_id' => 5,
                'name' => 'Agua de Panela con Limón',
                'description' => 'Bebida refrescante natural con panela y limón',
                'price' => 4500.00,
                'stock' => 100
            ],
            [
                'category_id' => 5,
                'name' => 'Mazamorra Chiquita',
                'description' => 'Bebida tradicional antioqueña con maíz y leche',
                'price' => 7000.00,
                'stock' => 50
            ],
            [
                'category_id' => 6,
                'name' => 'Ruana de Nobsa',
                'description' => 'Ruana tradicional boyacense tejida en lana de oveja',
                'price' => 125000.00,
                'stock' => 18
            ],
            [
                'category_id' => 6,
                'name' => 'Guayabera Sinuana',
                'description' => 'Camisa tradicional de Sinú, ideal para clima cálido',
                'price' => 85000.00,
                'stock' => 22
            ],
            [
                'category_id' => 6,
                'name' => 'Alpargatas Santandereanas',
                'description' => 'Calzado artesanal en cuero y fique, cómodo y fresco',
                'price' => 55000.00,
                'stock' => 35
            ],
            [
                'category_id' => 7,
                'name' => 'Jabón de Sábila Amazónica',
                'description' => 'Jabón natural con sábila de la región amazónica',
                'price' => 12000.00,
                'stock' => 60
            ],
            [
                'category_id' => 7,
                'name' => 'Aceite de Coco Virgen',
                'description' => 'Aceite de coco extraído en frío de palmas del Chocó',
                'price' => 28000.00,
                'stock' => 40
            ],
            [
                'category_id' => 7,
                'name' => 'Crema de Caracol Regeneradora',
                'description' => 'Crema facial con baba de caracol, producto natural colombiano',
                'price' => 45000.00,
                'stock' => 25
            ],
            [
                'category_id' => 8,
                'name' => 'Achiote en Polvo',
                'description' => 'Colorante natural para dar sabor y color a las comidas',
                'price' => 5500.00,
                'stock' => 75
            ],
            [
                'category_id' => 8,
                'name' => 'Comino Molido Santandereano',
                'description' => 'Comino de alta calidad cultivado en Santander',
                'price' => 8500.00,
                'stock' => 65
            ],
            [
                'category_id' => 8,
                'name' => 'Ají Chombo en Polvo',
                'description' => 'Ají picante molido, típico de la costa caribe',
                'price' => 7000.00,
                'stock' => 55
            ],
            [
                'category_id' => 8,
                'name' => 'Cilantro Cimarrón Seco',
                'description' => 'Hierba aromática seca, esencial en la cocina colombiana',
                'price' => 6000.00,
                'stock' => 70
            ],
            [
                'category_id' => 8,
                'name' => 'Sazonador Caribeño',
                'description' => 'Mezcla de especias típicas de la costa atlántica',
                'price' => 9500.00,
                'stock' => 50
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
