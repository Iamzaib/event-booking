<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostBlogTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('blog_post_blog_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_post_id');
            $table->foreign('blog_post_id', 'blog_post_id_fk_7098883')->references('id')->on('blog_posts')->onDelete('cascade');
            $table->unsignedBigInteger('blog_tag_id');
            $table->foreign('blog_tag_id', 'blog_tag_id_fk_7098883')->references('id')->on('blog_tags')->onDelete('cascade');
        });
    }
}
