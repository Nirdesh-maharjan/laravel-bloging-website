<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // General
            $table->string('site_name')->default('MyBlog');
            $table->string('tagline')->nullable();

            // Branding
            $table->string('logo_path')->nullable();
            $table->string('accent_color')->default('#7c5cff'); // UI accent

            // Posts
            $table->unsignedInteger('posts_per_page')->default(10);
            $table->boolean('allow_guest_posts')->default(false);

            // Comments
            $table->boolean('comments_enabled')->default(false);
            $table->boolean('comments_require_approval')->default(true);

            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 200)->nullable();

            // Social links
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
