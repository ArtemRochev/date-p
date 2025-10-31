<?php

namespace App\Service;

class DateParser
{
    public function parse(string $rawDate): string
    {
        $dateTime = new \DateTime($rawDate);

        $century = ceil($dateTime->format('Y') / 100);

        return sprintf('%sth %s', $century, $dateTime->format('Y F d l'));
    }
}
