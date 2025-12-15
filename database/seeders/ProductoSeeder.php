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
                'imagen' => 'estetoscopio-diagnostico-1765835858.jpeg',
                'marca' => 'Hartmann',
                'categoria' => 'Atención primaria',
            ],
            [
                'codigo' => 'PROD002',
                'nombre' => 'Tensiómetro Digital',
                'precio' => 45.50,
                'descripcion' => 'Monitor de presión arterial digital automático con memoria de lecturas',
                'imagen' => 'tensiometro-digital-1765835858.jfif',
                'marca' => 'Omron Healthcare',
                'categoria' => 'Diagnóstico por imágenes',
            ],
            [
                'codigo' => 'PROD003',
                'nombre' => 'Termómetro Infrarrojo',
                'precio' => 32.00,
                'descripcion' => 'Termómetro infrarrojo sin contacto, lectura en 1 segundo',
                'imagen' => 'termometro-infrarrojo-1765835858.jpg',
                'marca' => 'Roche Diagnostics',
                'categoria' => 'Atención primaria',
            ],
            [
                'codigo' => 'PROD004',
                'nombre' => 'Oxímetro de Pulso',
                'precio' => 55.00,
                'descripcion' => 'Monitor de saturación de oxígeno con pantalla LED',
                'imagen' => 'oximetro-de-pulso-1765835858.png',
                'marca' => 'Abbott Diagnostics',
                'categoria' => 'Sensorial',
            ],
            [
                'codigo' => 'PROD005',
                'nombre' => 'Lámpara Exploración LED',
                'precio' => 125.00,
                'descripcion' => 'Lámpara médica LED de alta intensidad para consultorios',
                'imagen' => 'lampara-exploracion-led-1765835858.jpg',
                'marca' => 'Thermo Fisher Scientific',
                'categoria' => 'Hospitalización',
            ],
            [
                'codigo' => 'PROD006',
                'nombre' => 'Kit Vendajes Estériles',
                'precio' => 28.50,
                'descripcion' => 'Juego completo de vendajes estériles de diferentes tamaños',
                'imagen' => 'kit-vendajes-esteriles-1765835858.png',
                'marca' => 'B. Braun',
                'categoria' => 'Enfermería',
            ],
            [
                'codigo' => 'PROD007',
                'nombre' => 'Guantes Médicos Nitrilo',
                'precio' => 15.00,
                'descripcion' => 'Caja de 100 guantes de nitrilo desechables, talla única',
                'imagen' => 'guantes-medicos-nitrilo-1765835858.jpg',
                'marca' => 'Abbott Diagnostics',
                'categoria' => 'Enfermería',
            ],
            [
                'codigo' => 'PROD008',
                'nombre' => 'Bata Quirúrgica',
                'precio' => 35.00,
                'descripcion' => 'Bata médica quirúrgica reutilizable en algodón',
                'imagen' => 'bata-quirurgica-1765835858.png',
                'marca' => 'Bio-Rad Laboratories',
                'categoria' => 'Esterilización',
            ],
            [
                'codigo' => 'PROD009',
                'nombre' => 'Mascarilla N95',
                'precio' => 8.50,
                'descripcion' => 'Caja de 50 mascarillas N95 certificadas',
                'imagen' => 'mascarilla-n95-1765835858.jpg',
                'marca' => 'Roche Diagnostics',
                'categoria' => 'Respiratorio',
            ],
            [
                'codigo' => 'PROD010',
                'nombre' => 'Alcohol al 70%',
                'precio' => 12.00,
                'descripcion' => 'Botella de 500ml de alcohol para desinfección',
                'imagen' => 'alcohol-al-70-1765835858.png',
                'marca' => 'B. Braun',
                'categoria' => 'Farmacéutico',
            ],
            [
                'codigo' => 'PROD011',
                'nombre' => 'Jeringas Estériles',
                'precio' => 22.00,
                'descripcion' => 'Caja de 100 jeringas desechables estériles',
                'imagen' => 'jeringas-esteriles-1765835858.jpg',
                'marca' => 'Medtronic',
                'categoria' => 'Banco de sangre',
            ],
            [
                'codigo' => 'PROD012',
                'nombre' => 'Algodón Médico',
                'precio' => 18.50,
                'descripcion' => 'Rollo de algodón médico de alta calidad',
                'imagen' => 'algodon-medico-1765835858.png',
                'marca' => 'Stryker',
                'categoria' => 'Atención primaria',
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
