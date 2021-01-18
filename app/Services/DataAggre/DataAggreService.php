<?php

namespace App\Services\DataAggre;

use Exception;

class DataAggreService
{
    public function __construct()
    {

    }

    public function transformObjects(
        string $masterSchema,
        array $slaveSchemes,
        AggreObjectInterface ...$aggreObjs
    ) {
        if ($masterSchema == null || $slaveSchemes == null || !count($slaveSchemes) || $aggreObjs == null || !count($aggreObjs)) {
            return null;
        }

        foreach ($aggreObjs as $aggreObj) {
            try {
                foreach($slaveSchemes as $slaveSchema) $this->transformObject($masterSchema, $slaveSchema, $aggreObj);
            } catch (Exception $e) {

            }
        }
    }

    private function transformObject(
        string $masterSchema,
        string $slaveSchemey,
        AggreObjectInterface $aggreObj
    ) {
        $aggreObj->transformDataBetweenSchema($slaveSchemey, $masterSchema);
    }
}
