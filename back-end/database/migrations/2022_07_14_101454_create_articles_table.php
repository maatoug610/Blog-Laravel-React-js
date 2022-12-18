<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->string('description');
            $table->string('image')->nullable(); // can be null
            $table->boolean('isdraft')->default(true);
            $table->boolean('ischecked')->default(false);
            $table->integer('read_number')->default(0);
            $table->DateTime('last_read_at')->nullable();
            $table->softDeletes(); // deleted at
            $table->integer('deleted_by')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
