<?php
// database/migrations/xxxx_xx_xx_create_favorite_teams_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('favorite_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('football_data_id');
            $table->integer('transfermarkt_id');
            $table->string('team_name')->nullable();
            $table->string('team_logo')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorite_teams');
    }
}
