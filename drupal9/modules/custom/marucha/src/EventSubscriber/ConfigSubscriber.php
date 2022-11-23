<?php

namespace Drupal\marucha\EventSubscriber;


use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Config\ConfigCrudEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;



class ConfigSubscriber implements EventSubscriberInterface {

    public static function getSubscribedEvents() {
        return [
            ConfigEvents::SAVE => 'onConfigSave',
        ];
    }

    public function onConfigSave(ConfigCrudEvent $event) {
        $config = $event->getConfig();
        if($config->getName() == 'core.date_format.long'){
            \Drupal::messenger()->addStatus('設定が保存されました:'.$config->getName());
        }
    }

}