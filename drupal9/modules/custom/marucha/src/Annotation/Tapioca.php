<?php

namespace Drupal\marucha\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Tapioca Annotation object
 * 
 * @Annotation
 */
class Tapioca extends plugin {
    /**
     * The plugin Id
     * 
     * @var string
     */
    public $id;

    /**
     * The human readable name of plugin.
     * 
     * @var \Drupal\Core\Annotation\Translation
     * 
     * @ingroup plugin_translatable
     */
    public $label;

    /**
     * The description of plugin
     * 
     * @var \Drupal\Core\Annotation\Translation
     * 
     * @ingroup plugin_translatable
     */
    public $description;


}