<?php

use ConorSmith\Wedding\Guest;
use ConorSmith\Wedding\Invite;
use Illuminate\Database\Migrations\Migration;
use Ramsey\Uuid\Uuid;
use RandomLib\Factory;
use SecurityLib\Strength;

class GenerateInvites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $guests = Guest::all();

        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));

        foreach ($guests as $guest) {
            $invite = new Invite([
                'id' => Uuid::uuid4(),
                'guest_a' => $guest->id,
                'note' => "",
                'access_key' => $generator->generateString(
                    256,
                    "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
                ),
            ]);
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
