<?php

namespace App\Services\DataAggre;

use App\Models\Contact;
use App\Util\DBUtil\DBUtil;

class ContactService implements AggreObjectInterface
{

    public function getDataFromSchema($schema) : Contact
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
        $data = $this->getDataFromSchema($slaveScheme);
        $this->upsertDataToSchema($data, $masterSchema);
    }
}
