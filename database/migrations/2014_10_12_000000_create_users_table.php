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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('mobile_number')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('referral_code');
            $table->boolean('is_verified')->default(0);
            $table->string('profile_image')->default("images/blank-profile-circle.png");
            $table->string('temporary_token')->nullable();
            $table->string('fcm_token')->nullable();
            $table->foreignUuid('referrer_id')->nullable();
            $table->tinyInteger('login_attempts')->default(5);
            $table->rememberToken();
            $table->boolean("push_notification")->default(1);
            $table->boolean("email_notification")->default(1);
            $table->boolean("sms_notification")->default(1);
            $table->string("delete_reason")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
};
