<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->date('date');
            $table->integer('total_brutto');
            $table->integer('total_netto');
            $table->timestamps();
        });
    }




    public function down()
    {
        Schema::dropIfExists('orders');
    }
}