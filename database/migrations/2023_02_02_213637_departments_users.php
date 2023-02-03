<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create("departments_users", function (Blueprint $table) {
            $table
                ->bigInteger("user_id")
                ->unsigned()
                ->index();
            $table
                ->bigInteger("department_id")
                ->unsigned()
                ->index();

            $table
                ->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");

            $table
                ->foreign("department_id")
                ->references("id")
                ->on("departments")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists("departments_users");
    }
};
