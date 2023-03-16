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
        Schema::create('home', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->string('title_section1');
            $table->longText('text_section1');
            $table->string('image_section1');
            $table->string('title_section2');
            $table->longText('text_section2');
            $table->string('subtitle1_section2');
            $table->longText('text1_section2');
            $table->string('image1_section2');
            $table->string('subtitle2_section2');
            $table->longText('text2_section2');
            $table->string('image2_section2');
            $table->string('subtitle3_section2');
            $table->longText('text3_section2');
            $table->string('image3_section2');
            $table->string('title_section3');
            $table->timestamps();
        });

        DB::table('home')->insert(
            array(
                'image' => '/img/portada.png',
                'title' => '',
                'title_section1' => '',
                'text_section1' => '',
                'image_section1' => '/img/about.png',
                'title_section2' => '',
                'text_section2' => '',
                'subtitle1_section2' => '',
                'text1_section2' => '',
                'image1_section2' => '/img/consulting.png',
                'subtitle2_section2' => '',
                'text2_section2' => '',
                'image2_section2' => '/img/montaje.png',
                'subtitle3_section2' => '',
                'text3_section2' => '',
                'image3_section2' => '/img/support.png',
                'title_section3' => ''
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home');
    }
};
