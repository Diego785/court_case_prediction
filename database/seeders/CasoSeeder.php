<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('casos')->insert([
            [
                'nombre' => 'Divorcio de Smith',
                'descripcion' => 'Caso de divorcio entre John Smith y Mary Smith',
                'requerimientos' => 'Acuerdo de división de bienes, acuerdo de custodia de hijos',
                'fecha_inicio' => '2023-01-10',
                'fecha_finalizacion' => '2023-03-20',
                'juez' => 'Juez Anderson',
                'demandante' => 'John Smith',
                'demandado' => 'Mary Smith',
            ],
            [
                'nombre' => 'Caso de Custodia de Menores',
                'descripcion' => 'Caso de custodia de menores entre Jane Doe y Peter Doe',
                'requerimientos' => 'Custodia completa de los hijos, manutención de los hijos',
                'fecha_inicio' => '2023-04-05',
                'fecha_finalizacion' => '2023-08-10',
                'juez' => 'Juez Clark',
                'demandante' => 'Jane Doe',
                'demandado' => 'Peter Doe',
            ],

            [
                'nombre' => 'Caso de Acoso Laboral',
                'descripcion' => 'Demanda por acoso laboral en ABC Inc.',
                'requerimientos' => 'Compensación por daños emocionales, terminación del empleo del acosador',
                'fecha_inicio' => '2023-08-15',
                'fecha_finalizacion' => null,
                'juez' => 'Juez Miller',
                'demandante' => 'Laura Johnson',
                'demandado' => 'ABC Inc.',
            ],
            [
                'nombre' => 'Caso de Violación de Contrato',
                'descripcion' => 'Disputa por incumplimiento de contrato entre XYZ Ltd. y DEF Corp.',
                'requerimientos' => 'Compensación por pérdidas financieras, cumplimiento del contrato',
                'fecha_inicio' => '2023-09-20',
                'fecha_finalizacion' => null,
                'juez' => 'Juez Davis',
                'demandante' => 'XYZ Ltd.',
                'demandado' => 'DEF Corp.',
            ],
            [
                'nombre' => 'Caso de Fraude Empresarial Masivo',
                'descripcion' => 'Un extenso caso de fraude empresarial que involucra a múltiples empresas y partes. El fraude incluye malversación de fondos, falsificación de documentos y evasión de impuestos.',
                'requerimientos' => 'Compensación por daños financieros, investigación exhaustiva, juicio con jurado',
                'fecha_inicio' => '2021-03-10',
                'fecha_finalizacion' => null, // El caso aún no se ha resuelto
                'juez' => 'Juez Thompson',
                'demandante' => 'Inversionistas afectados',
                'demandado' => 'Varias corporaciones y sus ejecutivos',
            ],
            // Add more real cases as needed
        ]);





        // Seeders para actualizaciones del "Caso de Fraude Empresarial" (ID 3)
        DB::table('caso_updates')->insert([
            [
                'caso_id' => 5,
                'descripcion' => 'Se ha descubierto nueva evidencia de malversación de fondos por parte de la empresa demandada XYZ Corporation.',
                'fecha' => '2023-02-20',
                'estado' => 10, // 10% completado
            ],
            [
                'caso_id' => 5,
                'descripcion' => 'Se completó la investigación financiera y se ha presentado una demanda formal contra XYZ Corporation.',
                'fecha' => '2023-03-10',
                'estado' => 15, // 15% completado
            ],
            [
                'caso_id' => 5,
                'descripcion' => 'Se llevó a cabo una audiencia preliminar en la que ambas partes presentaron sus argumentos.',
                'fecha' => '2023-04-05',
                'estado' => 20, // 20% completado
            ],
            [
                'caso_id' => 5,
                'descripcion' => 'El juicio comenzó y se están presentando pruebas tanto del demandante como del demandado.',
                'fecha' => '2023-05-01',
                'estado' => 25, // 25% completado
            ],
            [
                'caso_id' => 5,
                'descripcion' => 'El demandado XYZ Corporation presentó pruebas sólidas en su defensa, cuestionando las acusaciones de ABC Company.',
                'fecha' => '2023-05-15',
                'estado' => 20, // 40% completado (descendiendo)
            ],
            [
                'caso_id' => 5,
                'descripcion' => 'Durante el juicio, el jurado mostró dudas sobre las afirmaciones de ABC Company y solicitó más pruebas.',
                'fecha' => '2023-06-01',
                'estado' => 15, // 35% completado (descendiendo)
            ],
            [
                'caso_id' => 5,
                'descripcion' => 'ABC Company presentó nuevas pruebas sólidas que respaldan su caso, incluyendo documentos financieros y testimonios clave.',
                'fecha' => '2023-06-10',
                'estado' => 25, // 15% completado (aumentando)
            ],
            [
                'caso_id' => 5,
                'descripcion' => 'El tribunal revisó las nuevas pruebas presentadas y encontró méritos en las afirmaciones de ABC Company.',
                'fecha' => '2023-06-12',
                'estado' => 30, // 25% completado (aumentando)
            ],
            [
                'caso_id' => 5,
                'descripcion' => 'Se programó una audiencia para resolver el caso y determinar la responsabilidad de XYZ Corporation en el fraude empresarial.',
                'fecha' => '2023-06-14',
                'estado' => 40, // 40% completado (aumentando)
            ],
            [
                'caso_id' => 5,
                'descripcion' => 'Después de varias semanas de juicio, el jurado llegó a un veredicto parcial en favor del demandante ABC Company.',
                'fecha' => '2023-06-15',
                'estado' => 50, // 45% completado
            ],
            [
                'caso_id' => 5,
                'descripcion' => 'Se celebró una audiencia de sentencia para determinar la compensación final para ABC Company.',
                'fecha' => '2023-07-10',
                'estado' => 70, // 50% completado
            ],



            [
                'caso_id' => 5,
                'descripcion' => 'El tribunal aceptó la solicitud del jurado de revisar más pruebas, lo que prolongó el proceso legal.',
                'fecha' => '2023-07-15',
                'estado' => 65, // 30% completado (descendiendo)
            ],
            // [
            //     'caso_id' => 3,
            //     'descripcion' => 'El jurado finalmente emitió un veredicto en favor de XYZ Corporation, absolviéndolos de las acusaciones de ABC Company.',
            //     'requerimientos' => 'Caso cerrado.',
            //     'fecha' => '2023-08-15',
            //     'estado' => 0, // 0% completado (caso perdido)
            // ],

            // [
            //     'caso_id' => 5,
            //     'descripcion' => 'El tribunal emitió un fallo final y ABC Company recibió una compensación de $2,000,000.',
            //     'fecha' => '2023-08-01',
            //     'estado' => 100, // 100% completado (caso exitoso)
            // ],
        ]);

        DB::table('caso_updates')->insert([
            [
                'caso_id' => 2, // Assuming caso_id is 2 for the "Caso de Custodia de Menores"
                'descripcion' => 'En la primera audiencia, Jane Doe obtuvo una decisión favorable sobre la custodia provisional de los hijos.',
                'fecha' => '2023-05-01',
                'estado' => 50, // 50% completado (increased)
            ],
            [
                'caso_id' => 2,
                'descripcion' => 'La evaluación psicológica de los padres sugiere que la custodia compartida sería lo más beneficioso para los hijos, lo que es un avance positivo para Jane Doe.',
                'fecha' => '2023-06-01',
                'estado' => 45, // 45% completado (decreased)
            ],
            [
                'caso_id' => 2,
                'descripcion' => 'La segunda audiencia no resultó en un acuerdo claro sobre la custodia, disminuyendo el progreso de Jane Doe.',
                'fecha' => '2023-06-15',
                'estado' => 40, // 40% completado (decreased)
            ],
            [
                'caso_id' => 2,
                'descripcion' => 'Los argumentos finales incluyeron disputas acaloradas, lo que generó incertidumbre sobre la custodia, disminuyendo aún más el progreso de Jane Doe.',
                'fecha' => '2023-07-01',
                'estado' => 35, // 35% completado (decreased)
            ],
            [
                'caso_id' => 2,
                'descripcion' => 'El tribunal ordenó una custodia compartida con restricciones que favorecen a Peter Doe, lo que representa un revés para Jane Doe.',
                'fecha' => '2023-08-01',
                'estado' => 30, // 30% completado (decreased)
            ],
            [
                'caso_id' => 2,
                'descripcion' => 'Los detalles finales se resolvieron, pero con condiciones que no satisfacen completamente a Jane Doe, reduciendo aún más el progreso de Jane Doe.',
                'fecha' => '2023-08-10',
                'estado' => 25, // 25% completado (decreased)
            ],
            [
                'caso_id' => 2,
                'descripcion' => 'En una audiencia inesperada, Jane Doe logró un acuerdo beneficioso para la custodia de los hijos.',
                'fecha' => '2023-09-01',
                'estado' => 40, // 40% completado (increased)
            ],
            [
                'caso_id' => 2,
                'descripcion' => 'Sin embargo, nuevos desacuerdos surgieron durante la implementación del acuerdo, reduciendo el progreso nuevamente.',
                'fecha' => '2023-09-15',
                'estado' => 35, // 35% completado (decreased)
            ],
            [
                'caso_id' => 2,
                'descripcion' => 'Finalmente, un fallo del tribunal confirmó la custodia compartida, dejando a ambas partes insatisfechas.',
                'fecha' => '2023-10-01',
                'estado' => 30, // 30% completado (decreased)
            ],
        ]);
        
        // You can continue adding more updates as needed.
        
        
        // You can continue adding more updates as needed.
        
    }
}
