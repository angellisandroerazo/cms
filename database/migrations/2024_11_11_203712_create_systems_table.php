<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('name_site');
            $table->string('logo');
            $table->string('favicon');

            $table->string('landing_image');
            $table->string('landing_title');
            $table->text('landing_body');

            $table->boolean('about')->default(false);
            $table->string('about_title')->nullable();
            $table->text('about_body')->nullable();

            $table->boolean('contact')->default(false);
            $table->string('contact_title')->nullable();
            $table->text('contact_body')->nullable();

            $table->boolean('linkedin')->default(false);
            $table->string('linkedin_link')->nullable();

            $table->boolean('facebook')->default(false);
            $table->string('facebook_link')->nullable();

            $table->boolean('x')->default(false);
            $table->string('x_link')->nullable();

            $table->boolean('youtube')->default(false);
            $table->string('youtube_link')->nullable();

            $table->boolean('instagram')->default(false);
            $table->string('instagram_link')->nullable();

            $table->boolean('has_email')->default(false);
            $table->string('e_mail')->nullable();

            $table->boolean('has_phone')->default(false);
            $table->string('phone')->nullable();

            $table->boolean('has_direction')->default(false);
            $table->string('direction')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system');
    }
};
