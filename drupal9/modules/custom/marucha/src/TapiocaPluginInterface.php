<?php

namespace Drupal\marucha;

interface TapiocaPluginInterface {
    /**
     * Provide an order
     * 
     * @return string
     *   say order.
     */
    public function getOrder();

}