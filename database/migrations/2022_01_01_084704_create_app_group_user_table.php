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
        Schema::create(Constant::TABLE_APP_GROUP_USER, function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 50)->unique();
            $table->string('name', 100);
            $table->enum('status', ['active', 'not_active', 'none']);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists(Constant::TABLE_APP_GROUP_USER);
    }
};
