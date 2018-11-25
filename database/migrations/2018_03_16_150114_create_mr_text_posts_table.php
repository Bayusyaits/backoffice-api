<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrTextPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mr_text_posts', function (Blueprint $table) {
            $table->increments('mtp_id');
            $table->string('mtp_dm_id');
            $table->string('mtp_initial',20);
            $table->string('mtp_caption_id',255);
            $table->string('mtp_caption_en',255);
            $table->text('mtp_content_id');
            $table->text('mtp_content_en');
            $table->integer('mtp_is_parent');
            $table->integer('mtp_parent_id');
            $table->integer('mtp_show');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mr_text_posts');
    }
}
