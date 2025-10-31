<?php

namespace App\Controller;

use App\Repository\DateRepository;
use App\Service\DateRequester;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/date')]
class DateController
{
    #[Route('/parse', methods: ['POST'])]
    public function parse(Request $request, DateRequester $dateRequester, ValidatorInterface $validator): JsonResponse
    {
        $rawDate = $request->getPayload()->get('date');

        $errors = $validator->validate($rawDate, [
            new NotBlank()
        ]);

        if ($errors->count()) {
            throw new UnprocessableEntityHttpException('date is required');
        }

        try {
            return new JsonResponse(['parsed' => $dateRequester->getDate($rawDate)->getParsed()]);
        } catch (\DateMalformedStringException $e) {
            throw new UnprocessableEntityHttpException('date is not valid', $e);
        }
    }

    #[Route('/', methods: ['GET'])]
    public function list(DateRepository $dateRepository, NormalizerInterface $normalizer): JsonResponse
    {
        return new JsonResponse($normalizer->normalize($dateRepository->findAll(), 'json'));
    }
}
