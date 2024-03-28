<?php

use App\Models\Type;
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
        Schema::table('projects', function (Blueprint $table) {

            $table->foreignIdFor(Type::class)->after('id')->nullable()->constrained()->nullOnDelete();
            //! EQUIVALENTE DI:
            //$table->foreignId('type_id')->after('id')->nullable()->constrained()->nullOnDelete();
            //! EQUIVALENTE DI: 
            // $table->unsignedBigInteger('type_id')->nullable()->after('id');
            // $table->foreign('type_id')->references('id')->on('types')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeignIdFor(Type::class);

            //! EQUIVALENTE DI: 
            // $table->dropForeign('projects_type_id_foreign');

            $table->dropColumn('type_id');
        });
    }
};
