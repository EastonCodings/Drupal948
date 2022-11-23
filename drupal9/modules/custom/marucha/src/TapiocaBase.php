<?php

namespace Drupal\marucha;

use Drupal\Component\Plugin\PluginBase;

/**
 * Defines a base Tapioca implements;
 */
abstract class TapiocaBase extends PluginBase implements TapiocaPluginInterface {

    /**
     * @{inheriDoc}
     */
    public function getOrder() {
        $label = $this -> pluginDefinition['label'];
        return 'You ordered an ' . $label . ' Enjoy!';
    }
}