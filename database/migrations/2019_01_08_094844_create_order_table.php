<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');

            $table->string('copyright_figure', 255)->nullable()
                ->default(null)->comment('著作权人');
            $table->string('serial_number', 20)->nullable()
                ->default(null)->comment('流水号');
            $table->string('software_name', 255)->nullable()
                ->default('软件名称')->comment('软件名称');
            $table->timestamp('deliveried_at')->comment('交件日期');
            $table->integer('work_hours')->nullable()->comment('工作日');
            $table->timestamp('completion_at')->comment('交件日期');

            $table->integer('user_id')->comment('编写人');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');

            $table->timestamps();
            $table->timestamp('deleted_at', '删除时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
