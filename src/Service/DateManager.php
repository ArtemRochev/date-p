<?php

namespace App\Service;

use App\Entity\Date;
use Doctrine\ORM\EntityManagerInterface;

class DateManager
{
    public function __construct(
        private DateParser $dateParser,
        private EntityManagerInterface $em
    ) {}

    public function createFromRawDate(string $rawDate): Date
    {
        $date = new Date();

        $date->setRaw($rawDate);
        $date->setParsed($this->dateParser->parse($rawDate));
        $date->setParsedCount(1);

        $this->em->persist($date);
        $this->em->flush();

        return $date;
    }

    public function incrementParsedCount(Date $date): void
    {
        $date->setParsedCount($date->getParsedCount() + 1);

        $this->em->persist($date);
        $this->em->flush();
    }
}
