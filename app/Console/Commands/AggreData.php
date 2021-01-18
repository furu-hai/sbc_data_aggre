<?php

namespace App\Console\Commands;

use App\Constant\AggreObjectConstant;
use App\Services\DataAggre\ContactService;
use App\Services\DataAggre\DataAggreService;
use Illuminate\Console\Command;

class AggreData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:aggre
                            {object* : The objects will be collectted data}
                            {--schema=* : Specific slave schemas to process}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggregation data';

    protected $dataAgrreService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        DataAggreService $dataAgrreService
    ) {
        parent::__construct();

        $this->dataAgrreService = $dataAgrreService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "Start AggreData!\n";
        $objects = $this->argument('object');
        echo "Objects will be processed:";
        print_r($objects);
        $slaveSchemas = $this->option('schema');
        echo "Schemes will be processed:";
        print_r($slaveSchemas);

        if (!$slaveSchemas || $slaveSchemas[0] == 'all') {
            $slaveSchemas = explode(',', config('aggreschemas.slave_schemas'));
        }

        $masterSchema = config('aggreschemas.master_schemas');

        $aggreObjs = [];
        foreach ($objects as $object) {
            if ($object == AggreObjectConstant::CONTACT) {
                $aggreObjs[] = new ContactService();
            }
        }

        $this->dataAgrreService->transformObjects($masterSchema, $slaveSchemas, ...$aggreObjs);

        echo "End AggreData!\n";

        return 0;
    }
}
