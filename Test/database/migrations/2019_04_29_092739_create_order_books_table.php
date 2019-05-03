<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateOrderBooksTable extends Migration
{

    public function up()
    {
        Schema::create('book_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')
                ->on('orders')->onDelete('cascade');
            $table->integer('book_id')->unsigned()->index();
            $table->foreign('book_id')->references('id')
                ->on('books')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }





    public function down()
    {
        Schema::dropIfExists('book_order');
    }
}