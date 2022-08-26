<?php

use App\Constant\Constant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('example', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->text('name');
            $table->text('description');
            $table->integer("job_desk")->nullable();
            $table->date('birth_date');
            $table->double('current_money');
            $table->text('profile_image')->nullable();
            /// Jangan lupa di casting di model menjadi array
            $table->json('hobby')->nullable();
            $table->enum('status', ['active', 'not_active', 'none'])->nullable()->default('none');

            $table->timestamps();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign("created_by")->references("id")->on(Constant::TABLE_APP_USER)->cascadeOnDelete();
            $table->foreign("updated_by")->references("id")->on(Constant::TABLE_APP_USER)->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('example');
    }
};
