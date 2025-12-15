<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            [
                'codigo' => 'PROD001',
                'nombre' => 'Estetoscopio Diagnóstico',
                'precio' => 89.99,
                'descripcion' => 'Estetoscopio de doble tubo con diafragma y campana para auscultación precisa',
                'imagen' => 'lh-1765832188.jpeg',
                'marca' => 'Hartmann',
                'categoria' => 'Atención primaria',
            ],
            [
                'codigo' => 'PROD002',
                'nombre' => 'Tensiómetro Digital',
                'precio' => 45.50,
                'descripcion' => 'Monitor de presión arterial digital automático con memoria de lecturas',
                'imagen' => 'nx-1765832104.jfif',
                'marca' => 'Omron Healthcare',
                'categoria' => 'Diagnóstico por imágenes',
            ],
            [
                'codigo' => 'PROD003',
                'nombre' => 'Termómetro Infrarrojo',
                'precio' => 32.00,
                'descripcion' => 'Termómetro infrarrojo sin contacto, lectura en 1 segundo',
                'imagen' => 'cg-1765832033.jpg',
                'marca' => 'Roche Diagnostics',
                'categoria' => 'Atención primaria',
            ],
            [
                'codigo' => 'PROD004',
                'nombre' => 'Oxímetro de Pulso',
                'precio' => 55.00,
                'descripcion' => 'Monitor de saturación de oxígeno con pantalla LED',
                'imagen' => 'nm-1765831981.png',
                'marca' => 'Abbott Diagnostics',
                'categoria' => 'Sensorial',
            ],
            [
                'codigo' => 'PROD005',
                'nombre' => 'Lámpara Exploración LED',
                'precio' => 125.00,
                'descripcion' => 'Lámpara médica LED de alta intensidad para consultorios',
                'imagen' => 'il-1765831854.jpg',
                'marca' => 'Thermo Fisher Scientific',
                'categoria' => 'Hospitalización',
            ],
            [
                'codigo' => 'PROD006',
                'nombre' => 'Kit Vendajes Estériles',
                'precio' => 28.50,
                'descripcion' => 'Juego completo de vendajes estériles de diferentes tamaños',
                'imagen' => 'gh-1765831784.png',
                'marca' => 'B. Braun',
                'categoria' => 'Enfermería',
            ],
            [
                'codigo' => 'PROD007',
                'nombre' => 'Guantes Médicos Nitrilo',
                'precio' => 15.00,
                'descripcion' => 'Caja de 100 guantes de nitrilo desechables, talla única',
                'imagen' => 'vk-1765831696.jpg',
                'marca' => 'Abbott Diagnostics',
                'categoria' => 'Enfermería',
            ],
            [
                'codigo' => 'PROD008',
                'nombre' => 'Bata Quirúrgica',
                'precio' => 35.00,
                'descripcion' => 'Bata médica quirúrgica reutilizable en algodón',
                'imagen' => 'u7-1765831648.png',
                'marca' => 'Bio-Rad Laboratories',
                'categoria' => 'Esterilización',
            ],
            [
                'codigo' => 'PROD009',
                'nombre' => 'Mascarilla N95',
                'precio' => 8.50,
                'descripcion' => 'Caja de 50 mascarillas N95 certificadas',
                'imagen' => '5x-Counterfeit_3M_N95_Particulate_Respirator.jpg',
                'marca' => 'Roche Diagnostics',
                'categoria' => 'Respiratorio',
            ],
            [
                'codigo' => 'PROD010',
                'nombre' => 'Alcohol al 70%',
                'precio' => 12.00,
                'descripcion' => 'Botella de 500ml de alcohol para desinfección',
                'imagen' => 'ar-ALCOHOL 70%.png',
                'marca' => 'B. Braun',
                'categoria' => 'Farmacéutico',
            ],
            [
                'codigo' => 'PROD011',
                'nombre' => 'Jeringas Estériles',
                'precio' => 22.00,
                'descripcion' => 'Caja de 100 jeringas desechables estériles',
                'imagen' => 'ka-Jeringa Esteril.jpg',
                'marca' => 'Medtronic',
                'categoria' => 'Banco de sangre',
            ],
            [
                'codigo' => 'PROD012',
                'nombre' => 'Algodón Médico',
                'precio' => 18.50,
                'descripcion' => 'Rollo de algodón médico de alta calidad',
                'imagen' => 'w8-Algodon-Medico.png',
                'marca' => 'Stryker',
                'categoria' => 'Atención primaria',
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
