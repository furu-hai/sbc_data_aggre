<?php

namespace App\Console\Commands;

use App\Models\Contact;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
     * @return int
     */
    public function handle()
    {
        echo "Start AggreData!\n";
        $objects = $this->argument('object');
        echo "Objects will be processed:";
        print_r($objects);
        $schemas = $this->option('schema');
        echo "Schemes will be processed:";
        print_r($schemas);

        $masterSchema = config('aggreschemas.master_schemas');
        $slaveSchemas = explode(',', config('aggreschemas.slave_schemas'));



        foreach ($schemas as $slaveSchema) {
            if (!in_array($slaveSchema, $slaveSchemas)) {
                echo "The provided schema [$slaveSchema] is not existed in the configuration!\n";
                continue;
            } else {
                echo "Collect data from schema [$slaveSchema]...\n";
            }


            /*
            config(['database.connections.pgsql.schema' => $slaveSchema]);
            DB::reconnect('pgsql');

            $contacts = Contact::select('email', 'firstName', 'lastName')->get();

            config(['database.connections.pgsql.schema' => $masterSchema]);
            DB::reconnect('pgsql');

            $contacts->each(function ($contact, $key) {
                Contact::updateOrCreate($contact->toArray());
            });
            */

        }

        echo "End AggreData!\n";

        return 0;
    }
}
