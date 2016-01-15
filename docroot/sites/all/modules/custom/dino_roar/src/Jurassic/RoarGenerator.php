<?php

namespace Drupal\dino_roar\Jurassic;

class RoarGenerator
{
    public function createRoar($length) {
        return 'R'.str_repeat('o', $length).'arr!';
    }
}