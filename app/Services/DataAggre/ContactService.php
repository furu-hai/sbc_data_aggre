<?php

namespace App\Services\DataAggre;

use App\Models\Contact;
use App\Utils\DBUtil;

class ContactService implements AggreObjectInterface
{

    public function getDataFromSchema($schema)
    {
        DBUtil::reConnectDB($schema);

        return Contact::select('email', 'firstName', 'lastName')->get();
    }

    public function upsertDataToSchema($data, $schema)
    {
        DBUtil::reConnectDB($schema);

        $data->each(function ($contact, $key) {
            Contact::updateOrCreate($contact->toArray());
        });
    }

    public function transformDataBetweenSchema($slaveScheme, $masterSchema)
    {
        echo "START transform data of Contact from $slaveScheme to $masterSchema\n";
        $data = $this->getDataFromSchema($slaveScheme);
        $this->upsertDataToSchema($data, $masterSchema);
        echo "END transform data of Contact from $slaveScheme to $masterSchema\n";
    }
}
