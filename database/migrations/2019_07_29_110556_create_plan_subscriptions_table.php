<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('plan_id');
            $table->foreign('plan_id')->
                references('id')->
                on('plans')->
                onDelete('cascade');
            $table->bigInteger('user_id');
            $table->foreign('user_id')->
                references('id')->
                on('users')->
                onDelete('cascade');
            $table->decimal('charging_price', 8, 2)->nullable();
            $table->boolean('is_recurring')->default(true);
            $table->enum('payment_method', ['paypal'])->nullable()->default(null);
            $table->boolean('is_paid')->default(false);
            $table->timestamp('starts_on')->nullable();
            $table->timestamp('expires_on')->nullable();
            $table->timestamp('cancelled_on')->nullable();
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
        Schema::dropIfExists('plan_subscriptions');
    }
}
