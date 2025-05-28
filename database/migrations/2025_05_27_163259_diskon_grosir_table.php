<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('diskon_grosir', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')
              ->constrained('products')
              ->onDelete('cascade');
        $table->integer('minimal_jumlah');
        $table->decimal('persentase_diskon', 5, 2);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('diskon_grosir');
}

};
