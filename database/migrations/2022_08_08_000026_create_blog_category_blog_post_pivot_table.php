<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoryBlogPostPivotTable extends Migration
{
    public function up()
    {
        Schema::create('blog_category_blog_post', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_post_id');
            $table->foreign('blog_post_id', 'blog_post_id_fk_7098882')->references('id')->on('blog_posts')->onDelete('cascade');
            $table->unsignedBigInteger('blog_category_id');
            $table->foreign('blog_category_id', 'blog_category_id_fk_7098882')->references('id')->on('blog_categories')->onDelete('cascade');
        });
    }
}
