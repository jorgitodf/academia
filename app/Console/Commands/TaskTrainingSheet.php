<?php

namespace App\Console\Commands;

use App\Model\TrainingSheets;
use Illuminate\Console\Command;

class TaskTrainingSheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:trainingsheet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para verificar e atualizar a data de validade de Ficha de Treinamento';

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
        $trainingSheet = new TrainingSheets();
        $ts = $trainingSheet->all();

        $diaAtual = date("Y-m-d");


        foreach ($ts as $value) {

            if (strtotime($diaAtual) > strtotime($value['end_date'])) {

                $t = $trainingSheet->findOrFail($value['id']);
                $t->update(['active' => 'Não']);

            }

        }
    }
}
