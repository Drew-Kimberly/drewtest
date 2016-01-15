<?php

namespace Drupal\dino_roar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\dino_roar\Jurassic\RoarGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class RoarController extends ControllerBase
{
    private $roarGenerator;

    public function __construct(RoarGenerator $roarGenerator) {
        $this->roarGenerator = $roarGenerator;
    }

    public function roar($count) {
        $roarGen = new RoarGenerator();

        if ((int) $count > 0) {
            $roar = $this->roarGenerator->createRoar($count);
        }
        else {
            $roar = $this->roarGenerator->createRoar(3);
        }

        return new Response($roar);
    }

    public static function create(ContainerInterface $container)
    {
        $roarGen = $container->get('dino_roar.roar_generator');

        return new static($roarGen);
    }


}