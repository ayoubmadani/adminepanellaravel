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
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');                     // اسم المنتج
                $table->string('brand')->nullable();                    // الماركة
                $table->string('codebar')->nullable();                  // code bar
                $table->text('description')->nullable();                // description
                $table->text('image')->nullable();                // description
                $table->string('tags')->nullable();                      // tag
                $table->tinyInteger('status')->default(0);
                $table->unsignedBigInteger('category_id')->nullable();  // مفتاح خارجي للفئة
                $table->unsignedBigInteger('discount_id')->nullable();  // مفتاح خارجي للفئة
                $table->unsignedBigInteger('user_id');  //
                $table->decimal('price', 10, 2)->nullable();            // السعر (مثال: 199.99)
                $table->decimal('buyprice', 10, 2)->nullable();            // السعر (مثال: 199.99)
                $table->integer('stock');                   // الكمية المتوفرة
                $table->timestamps();

                // المفتاح الخارجي يربط كل منتج بفئة
                $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
                $table->foreign('discount_id')->references('id')->on('discounts')->nullOnDelete();
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
            Schema::dropIfExists('products');
        }
    };
