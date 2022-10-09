<?php
namespace Drupal\my_module\Controller;
class MyModuleController {
  public function content() {
    #$build['markup']['#attached']['library'][] = 'mymodule/mymodule.libraries.yml';
    return array(
      '#type' => 'markup',
      '#markup' => t('模块')
    );
  }

  // function yourmodule_element_info_alter(array &$types) {
  //     $types['markup']['#attached']['library'][] = 'mymodule/mymodule.libraries.yml';
  // }
}
?>
