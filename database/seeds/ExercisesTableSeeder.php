<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExercisesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercises')->insert([
            ['name' => 'Rosca bíceps direta com barra', 'group_exercise_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Rosca bíceps direta com barra e pegada ampla', 'group_exercise_id' => 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Rosca bíceps direta com halteres', 'group_exercise_id' => 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Rosca bíceps martelo em pé com halteres', 'group_exercise_id' => 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Rosca bíceps em pé na barra EZ', 'group_exercise_id' => 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Rosca bíceps no cabo e usando a corda', 'group_exercise_id' => 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Rosca bíceps com halteres no banco inclinado', 'group_exercise_id' => 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Rosca bíceps martelo no banco inclinado com halteres', 'group_exercise_id' => 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Rosca bíceps apoiado no banco Scott e com a barra EZ', 'group_exercise_id' => 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Rosca bíceps concentrada unilateral com halter', 'group_exercise_id' => 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Barra fixa (chinup)', 'group_exercise_id' => 1,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Desenvolvimento de ombros com halteres', 'group_exercise_id' => 2,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Desenvolvimento de ombros com barra', 'group_exercise_id' => 2,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Desenvolvimento Arnold para ombros', 'group_exercise_id' => 2,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Elevação lateral de ombros com halteres', 'group_exercise_id' => 2,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Crucifixo invertido com halteres', 'group_exercise_id' => 2,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Flexão hindu', 'group_exercise_id' => 2,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Remada alta em pé com halteres', 'group_exercise_id' => 2,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Remada alta no cabo', 'group_exercise_id' => 2,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Remada alta no Smith', 'group_exercise_id' => 2,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Voador invertido na máquina', 'group_exercise_id' => 2,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Agachamento no Smith', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Step', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Afundo matriz', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Agachamento sumô', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdução em pé', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Agachamento guiado', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Agachamento taça', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Agachamento com barra (pernas afastadas)', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Agachamento hack', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Agachamento com halteres', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Agachamento frontal', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Avanço com barra', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Leg press', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Extensor de pernas', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Leg press 45º', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Cadeira adutora', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Mesa flexora', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Glúteo no cabo', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Extensão de pernas', 'group_exercise_id' => 3,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Supino com barra e com pegada fechada', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Mergulho na máquina (dip machine)', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Extensão de tríceps com halter sobre a cabeça e sentado', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Tríceps na polia (tríceps pulley) com barra reta', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Extensão de tríceps com halter sobre a cabeça', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Tríceps testa com barra reta', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Tríceps na polia (tríceps pulley) com barra reta e a pegada inversa', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Mergulho com o peso do corpo', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Coice com halter (dumbbell kickback)', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Flexão de braço com pegada fechada', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Mergulho nas paralelas', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Tríceps na máquina', 'group_exercise_id' => 4,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdominal invertido	', 'group_exercise_id' => 5,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdominal invertido unilateral', 'group_exercise_id' => 5,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdominal clássico', 'group_exercise_id' => 5,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdominal com apoio', 'group_exercise_id' => 5,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdominal com carga', 'group_exercise_id' => 5,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdominal com as pernas elevadas', 'group_exercise_id' => 5,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdominal supra e infra', 'group_exercise_id' => 5,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdominal grupado na bola suíça', 'group_exercise_id' => 5,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdominal invertido com a bola suíça', 'group_exercise_id' => 5,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Abdominal com rotação', 'group_exercise_id' => 5,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        ]);
    }
}
