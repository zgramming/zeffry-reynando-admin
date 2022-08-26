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
        Schema::create(Constant::TABLE_PORTFOLIO, function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("type_application")->nullable();
            $table->unsignedInteger("main_technology_id")->nullable();
            $table->string("title");
            $table->string("title_slug");
            $table->text("short_description");
            $table->longText("full_description");
            $table->text("banner_image")->nullable();
            $table->text("github_url")->nullable();
            $table->text("web_url")->nullable();
            $table->text("google_playstore_url")->nullable();
            $table->text("app_store_url")->nullable();
            $table->timestamps();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign("created_by")->references("id")->on(Constant::TABLE_APP_USER)->cascadeOnDelete();
            $table->foreign("updated_by")->references("id")->on(Constant::TABLE_APP_USER)->cascadeOnDelete();
            $table->foreign("type_application")->references("id")->on(Constant::TABLE_MST_DATA)->nullOnDelete();
            $table->foreign("main_technology_id")->references("id")->on(Constant::TABLE_MST_DATA)->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Constant::TABLE_PORTFOLIO);
    }
};
