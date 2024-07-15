<?php

namespace App\Database\Migrations;

use App\Libraries\Eloquent;
use CodeIgniter\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class InitMigration extends Migration
{
    public function up()
    {
        Eloquent::schema()->create("auth_jwt", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid('user_id')
                ->constrained("users")
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text("access_token");
            $table->string("refresh_token");
            $table->timestamps();
        });

        Eloquent::schema()->create("diseases", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("code");
            $table->string("name");
            $table->string("description")->nullable();
            $table->timestamps();
        });

        Eloquent::schema()->create("symptoms", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("code");
            $table->string("name");
            $table->string("description")->nullable();
            $table->timestamps();
        });

        Eloquent::schema()->create("rules", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid('symptom_id')
                ->constrained("symptoms")
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->uuid('effect_id');
            $table->enum("effect_type", ["disease", "symptom"]);
            $table->timestamps();
        });
    }

    public function down()
    {
        Eloquent::schema()->dropIfExists('auth_jwt');
        Eloquent::schema()->dropIfExists('diseases');
        Eloquent::schema()->dropIfExists('symptoms');
        Eloquent::schema()->dropIfExists('rules');
    }
}
