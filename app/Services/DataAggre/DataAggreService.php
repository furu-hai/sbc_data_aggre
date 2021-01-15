<?php

namespace App\Services\DataAggre;

class DataAgrreService
{
    private string $slaveScheme;
    private string $masterSchema;
    private array $aggreObjs;

    public function __construct(
        string $slaveScheme,
        string $masterSchema,
        AggreObjectInterface ...$aggreObjs
    ) {
        $this->slaveScheme = $slaveScheme;
        $this->masterSchema = $masterSchema;
        $this->aggreObjs = $aggreObjs;
    }

    public function transformObjects()
    {
        foreach($this->aggreObjs as $aggreObj) $this->transformObject($aggreObj);

    }

    private function transformObject(AggreObjectInterface $aggreObj)
    {
        $aggreObj->transformDataBetweenSchema($this->slaveScheme, $this->masterSchema);
    }
}
