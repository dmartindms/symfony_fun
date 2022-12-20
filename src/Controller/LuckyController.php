<?php

namespace App\Controller;

use App\Contracts\NumberGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    #[Route('/lucky/number', name: 'app_lucky_number')]
    public function number(NumberGeneratorInterface $generator): Response
    {
//        dd(get_class($generator));
        $number = $generator->randomInt();

        return $this->render('lucky/index.html.twig', [
            'number' => $number,
        ]);
    }
}
