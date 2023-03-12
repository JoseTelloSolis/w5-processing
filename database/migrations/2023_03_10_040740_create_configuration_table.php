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
        Schema::create('configuration', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('instagram');
            $table->string('facebook');
            $table->string('linkedin');
            $table->timestamps();
        });
        
        // Insert default admin user
        DB::table('configuration')->insert(
            array(
                'logo' => '/assets_admin/img/logo.png',
                'instagram' => '',
                'facebook' => '',
                'linkedin' => ''
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
        Schema::dropIfExists('configuration');
    }
};
