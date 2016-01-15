<?php

namespace Drupal\dino_roar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class RoarController extends ControllerBase
{
    public function roar() {
        return new Response("roaaaarrrr!");
    }
}