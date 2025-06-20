<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountProductTable extends Migration
{
    public function up()
    {
        Schema::create('discount_product', function (Blueprint $table) {
            $table->id();

            // لا تكرر الأعمدة - استخدم فقط foreignId مع constrained
            $table->foreignId('discount_id')->constrained('discounts')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discount_product');
    }
}

