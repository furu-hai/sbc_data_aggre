<?php

namespace App\Services\DataAggre;

interface AggreObjectInterface
{
    public function getDataFromSchema($schema);

    public function upsertDataToSchema($data, $schema);

    public function transformDataBetweenSchema($slaveScheme, $masterSchema);
}
