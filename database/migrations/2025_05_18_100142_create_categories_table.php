<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Category name like Raw material, Finish goods, etc.
            $table->boolean('is_active')->default(true); // For soft delete
            $table->timestamps();
        });

        // Insert default categories
        DB::table('categories')->insert([
            ['name' => 'Raw material', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Finish goods', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Spares', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Machines', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Others', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
