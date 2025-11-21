<?php

use App\Enums\Feature\FeatureStatus;
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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default(FeatureStatus::Proposed->value);
            $table->string('type')->default('Feature');
            $table->text('description');
            $table->smallInteger('effort_in_days')->unsigned()->default(0);
            $table->smallInteger('priority')->unsigned()->default(0);
            $table->decimal('cost', 10, 2)->default(0.00);
            $table->date('target_delivery_date')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
