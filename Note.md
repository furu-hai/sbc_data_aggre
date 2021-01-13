# Step by step to code this app

## 1. Create DB and Entity (Model)

#### 1.1 Generate files via artisan command
Perform artisan command to create model Contact and its migration
```sh
php artisan make:model Contact --migration --seed --factory
```

It should generate the following files:
- \app\Models\Contact.php
- \database\migrations\2021_01_01_000001_create_contacts_table.php
- \database\factories\ContactFactory.php
- \database\seeders\ContactSeeder.php

#### 1.2 Update DB and Model's files
```php
/* file: \database\migrations\2021_01_01_000001_create_contacts_table.php */
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
```

```php
/* file: \app\Models\Contact.php */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Make email to be primary key
    protected $primaryKey = 'email';

    // Define fields will be filled
    protected $fillable = [
        'email', 'firstName', 'lastName'
    ];
}
```

```php
/* file: \database\factories\ContactFactory.php */
<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName
        ];
    }
}
```


```php
/* file: \database\seeders\ContactSeeder.php */
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Contact::factory(10)->create();
    }
}
```

```php
/* file: \database\seeders\DatabaseSeeder.php */
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContactSeeder::class);
    }
}
```

#### 1.3 Run migration
Perform artisan command and check db for the db tables and fake data
```sh
php artisan migrate --seed
```

## Create a command (batch)
Perform artisan command to create Command (Batch) file
```sh
php artisan make:command AggreData
```

It should create a new file names AggreData inside the folder \app\Console\Commands
