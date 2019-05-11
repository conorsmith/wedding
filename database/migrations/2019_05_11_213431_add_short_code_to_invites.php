<?php

use ConorSmith\Wedding\Invite;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use RandomLib\Factory;
use SecurityLib\Strength;

class AddShortCodeToInvites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->text('short_code')
                ->after('access_key');
        });


        $invites = Invite::all();

        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));

        foreach ($invites as $invite) {
            $invite->short_code = $generator->generateString(
                8,
                "23456789ABCDEFGHJKLMNPQRSTUVWXYZ"
            );
            $invite->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
