<?php

namespace App\Console\Commands;

use App\Model\PhysicalEvaluationForm;
use Illuminate\Console\Command;

class TaskPhysicalEvaluationForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:physicalevaluationform';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para verificar e atualizar a data de validade do Formulário de Avaliação Física';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fef = new PhysicalEvaluationForm();
        $ts = $fef->all();

        $diaAtual = date("Y-m-d");

        foreach ($ts as $value) {

            if (strtotime($diaAtual) > strtotime($value['revaluation'])) {

                $t = $fef->findOrFail($value['id']);
                $t->update(['active' => 'Não']);

            }

        }
    }
}
