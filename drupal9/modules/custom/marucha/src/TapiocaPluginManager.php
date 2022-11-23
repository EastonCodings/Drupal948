<?php

namespace Drupal\marucha;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Manages tapioca plugins.
 */
class TapiocaPluginManager extends DefaultPluginManager {
    /**
     * @param \Traversable $namespaces
     * 
     * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
     * 
     * @param \Drupal\Core\Extendsion\ModuleHandlerInterface $module_handler
     */
    public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
        parent::__construct('Plugin/Tapioca', $namespaces, $module_handler, 'Drupal\marucha\TapiocaPluginInterface', 'Drupal\marucha\Annotation\Tapioca');
        $this -> alterInfo('tapioca_info');
        $this -> setCacheBackend($cache_backend, 'tapioca_plugins');
    }
}