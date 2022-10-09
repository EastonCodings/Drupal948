<?php

namespace Drupal\my_second_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class MySecondModuleController extends ControllerBase {

    public function showContent() {
        return [
            '#type' => 'markup',
            '#markup' => \Drupal::config('my_second_module.settings')->get('terms_and_conditions')['value'],
            '#cache' => [
                'tags' => ['MY_CUSTOM_UNIQUE_TAG'],
            ],
        ];
    }
}