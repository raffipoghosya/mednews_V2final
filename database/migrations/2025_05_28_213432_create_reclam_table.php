<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamTable extends Migration
{
    public function up()
    {
        Schema::create('reclam', function (Blueprint $table) {
            $table->id();
            $table->string('href');
            $table->enum('page', ['index', 'interview', 'news', 'single']);
            $table->enum('position', [
                'top',          // բոլոր էջերի վերև
                'bottom',       // բոլոր էջերի ներքև
                'right_top',    // բացված նորության աջ անկյուն վերև
                'right_bottom', // բացված նորության աջ անկյուն ներքև
                'bottom_large'  // բացված նորության ներքև (1312x371)
            ]);
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reclam');
    }
}
