<?php
declare(strict_types=1);

namespace ConorSmith\Wedding;

use RuntimeException;

final class SiteMode
{
    private const SETTINGS = [
        'conorandsteph' => [
            'contact_address'    => "wedding@conorandsteph.com",
            'names'              => "Conor & Steph",
            'html_encoded_names' => "Conor &amp; Steph",
        ],
        'stephandconor' => [
            'contact_address'    => "wedding@stephandconor.com",
            'names'              => "Steph & Conor",
            'html_encoded_names' => "Steph &amp; Conor",
        ],
    ];

    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        if (!array_key_exists($value, self::SETTINGS)) {
            throw new RuntimeException("'{$value}' is not a valid site mode");
        }

        $this->value = $value;
    }

    public function getContactAddress(): string
    {
        return self::SETTINGS[$this->value]['contact_address'];
    }

    public function getNames(): string
    {
        return self::SETTINGS[$this->value]['names'];
    }

    public function getHtmlEncodedNames(): string
    {
        return self::SETTINGS[$this->value]['html_encoded_names'];
    }
}
