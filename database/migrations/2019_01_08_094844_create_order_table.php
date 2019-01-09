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

            $table->string('copyright_figure', 255)->nullable()->comment('著作权人');
            $table->string('serial_number', 20)->nullable()->comment('流水号');
            $table->string('software_name', 255)->nullable()->comment('软件名称');
            $table->timestamp('deliveried_at')->comment('交件日期');
            $table->timestamp('out_at')->nullable()->comment('出证件日期');
            $table->integer('work_hours')->nullable()->comment('工作日');

            $table->decimal('price', 6, 2)->comment('价格');

            $table->integer('user_id')->unsigned()->index()->comment('编写人');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

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
