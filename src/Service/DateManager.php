<?php

namespace App\Service;

use App\Entity\Date;

class DateManager
{
    public function __construct(private DateParser $dateParser) {}

    public function createFromRawDate(string $rawDate): Date
    {
        $date = new Date();

        $date->setRaw($rawDate);
        $date->setParsed($this->dateParser->parse($rawDate));
        $date->setParsedCount(1);

        return $date;
    }
}
