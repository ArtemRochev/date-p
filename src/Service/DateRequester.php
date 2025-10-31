<?php

namespace App\Service;

use App\Entity\Date;
use Doctrine\ORM\EntityManagerInterface;

class DateRequester
{
    public function __construct(
        private EntityManagerInterface $em,
        private DateManager $dateManager
    ) {}

    public function getDate(string $rawDate): Date
    {
        $date = $this->em->getRepository(Date::class)->findOneBy(['raw' => $rawDate]);

        if (!$date) {
            $date = $this->dateManager->createFromRawDate($rawDate);
        } else {
            $date->setParsedCount($date->getParsedCount() + 1);
        }

        $this->em->persist($date);
        $this->em->flush();

        return $date;
    }
}
