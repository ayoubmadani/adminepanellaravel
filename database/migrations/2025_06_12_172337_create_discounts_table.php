<?php

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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // اسم الفئة
            $table->text('description')->nullable(); // وصف الفئة (اختياري)
            $table->string('discount')->nullable(); //  خصم
            $table->date('datebegin')->nullable(); //  تاريخ بداية (اختياري)
            $table->date('datefin')->nullable(); //  تاريخ النهاية (اختياري)
            $table->tinyInteger('status')->default(0);
            $table->timestamps();                // created_at و updated_at
            $table->unsignedBigInteger('user_id');  //

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
};
