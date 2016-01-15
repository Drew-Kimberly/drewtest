<?php

namespace Drupal\dino_roar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\dino_roar\Jurassic\RoarGenerator;
use Symfony\Component\HttpFoundation\Response;

class RoarController extends ControllerBase
{
    public function roar($count) {
        $roarGen = new RoarGenerator();

        if ((int) $count > 0) {
            $roar = $roarGen->createRoar($count);
        }
        else {
            $roar = $roarGen->createRoar(3);
        }

        return new Response($roar);
    }
}