<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachmentables', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('attachment_id', false, true);
            $table->bigInteger('attachmentable_id', false, true);
            $table->string('attachmentable_type', 100);

            $table->index(['attachmentable_id', 'attachmentable_type']);

            $table->foreign('attachment_id')
                ->references('id')->on('attachments')
                ->onDelete('cascade');

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
        Schema::dropIfExists('attachmentables');
    }
}
