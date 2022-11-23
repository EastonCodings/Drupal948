<?php

namespace Drupal\marucha\Plugin\Tapioca;

use Drupal\marucha\TapiocaBase;

/**
 * Provides tapioca milk tea plugin.
 * 
 * @Tapioca(
 *  id = "tapioca_milk_tea",
 *  label = "Tapioca Milk Tea",
 *  description = "This is best recoomended drink."
 * )
 */
class TapiocaMilkTea extends TapiocaBase{

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        $label = $this -> pluginDefinition['label'];
        return 'あなたの注文した商品はこちらです：' . $label;
    }

}