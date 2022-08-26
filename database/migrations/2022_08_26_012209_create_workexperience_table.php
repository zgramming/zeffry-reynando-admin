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
        Schema::create(Constant::TABLE_WORK_EXPERIENCE, function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger('job_id')->nullable();
            $table->string("company_code")->unique();
            $table->string("company_name");
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->longText("description")->nullable();
            $table->text("company_image")->nullable();
            $table->timestamps();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign("created_by")->references("id")->on(Constant::TABLE_APP_USER)->cascadeOnDelete();
            $table->foreign("updated_by")->references("id")->on(Constant::TABLE_APP_USER)->cascadeOnDelete();
            $table->foreign("job_id")->references("id")->on(Constant::TABLE_MST_DATA)->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Constant::TABLE_WORK_EXPERIENCE);
    }
};
