<?php

namespace ConorSmith\Wedding;

use Ramsey\Uuid\Uuid;
use Sabre\Xml\Service;
use TheIconic\NameParser\Parser;

final class ImportGuestlist
{
    public function __invoke(string $path): void
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

        Guest::query()->delete();

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
}
