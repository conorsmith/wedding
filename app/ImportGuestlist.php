<?php

namespace ConorSmith\Wedding;

use Ramsey\Uuid\Uuid;
use RandomLib\Factory;
use Sabre\Xml\Service;
use SecurityLib\Strength;
use TheIconic\NameParser\Parser;

final class ImportGuestlist
{
    public function __invoke(string $path): void
    {
        $rows = $this->readSpreadsheet($path);

        $this->truncateTables();

        $this->createGuestsFromSpreadsheetRows($rows);

        $this->generateInvites();
    }

    private function createGuestsFromSpreadsheetRows(array $rows): void
    {
        $parser = new Parser();

        foreach ($rows as $row) {
            $name = $parser->parse($row[0]);

            $guest = new Guest;
            $guest->id = Uuid::uuid4();
            $guest->first_name = $name->getFirstname();
            $guest->last_name = $name->getLastname();
            $guest->email = $row[2] ?? "";
            $guest->phone = $row[3] ?? "";
            $guest->address = $row[4] ?? "";
            $guest->save();
        }
    }

    private function generateInvites(): void
    {
        $guests = Guest::all();

        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));

        foreach ($guests as $guest) {
            $invite = new Invite([
                'id'         => Uuid::uuid4(),
                'guest_a'    => $guest->id,
                'note'       => "",
                'access_key' => $generator->generateString(
                    256,
                    "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
                ),
            ]);
            $invite->save();
        }
    }

    private function truncateTables(): void
    {
        Guest::query()->delete();
        Relationship::query()->delete();
        Invite::query()->delete();
    }

    private function readSpreadsheet(string $path): array
    {
        $contents = file_get_contents($path);

        $service = new Service;
        $result = $service->parse($contents);

        $rows = array_map(
            function (array $row) {
                return array_map(
                    function (array $cell) {
                        return $cell['value'][0]['value'];
                    },
                    $row['value']
                );
            },
            array_slice($result[4]['value'][0]['value'], 9)
        );

        array_shift($rows);

        return $rows;
    }
}
