<?php

namespace App\Service;

use App\Entity\Date;
use Doctrine\ORM\EntityManagerInterface;

class DateRequester
{
    public function __construct(
        private DateManager $dateManager,
        private EntityManagerInterface $em
    ) {}

    public function getDate(string $rawDate): Date
    {
        $date = $this->em->getRepository(Date::class)->findOneBy(['raw' => $rawDate]);

        if (!$date) {
            $date = $this->dateManager->createFromRawDate($rawDate);
        } else {
            $this->dateManager->incrementParsedCount($date);
        }

        return $date;
    }
}
