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
            $table->string('name');
            $table->integer('price');
            $table->integer('stock')->default(0);
            $table->foreignId('product_type_id')->constrained('product_types');
            $table->foreignId('product_status_id')->nullable()->constrained('product_statuses')->nullOnDelete();
            $table->string('image_url');
            $table->boolean('is_active')->default(true);
            $table->string(column: 'created_by');
            $table->string(column: 'updated_by')->nullable();
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
        Schema::dropIfExists('products');
    }
};
