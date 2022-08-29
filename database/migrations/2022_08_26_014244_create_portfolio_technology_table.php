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
        Schema::create(Constant::TABLE_PORTFOLIO_TECHNOLOGY, function (Blueprint $table) {
            $table->uuid("id");

            $table->unsignedInteger("portfolio_id")->nullable();
            $table->unsignedInteger("technology_id")->nullable();
            $table->timestamps();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign("portfolio_id")->references("id")->on(Constant::TABLE_PORTFOLIO)->cascadeOnDelete();
            $table->foreign("technology_id")->references("id")->on(Constant::TABLE_MST_DATA)->cascadeOnDelete();
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
        Schema::dropIfExists(Constant::TABLE_PORTFOLIO_TECHNOLOGY);
    }
};
