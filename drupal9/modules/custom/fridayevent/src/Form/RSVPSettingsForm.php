<?php

namespace Drupal\fridayevent\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\Request;




class RSVPSettingsForm extends ConfigFormBase{
    public function getFormID() {
        return 'fridayevent_admin_settings';
      }


    protected function getEditableConfigNames() {
        return [
        'fridayevent.settings'
        ];
      }


    public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL) {
        $types = node_type_get_names();
        $config = $this->config('fridayevent.settings');
        $form['fridayevent_types'] = array(
          '#type' => 'checkboxes',
          '#title' => $this->t('The content types to enable fridayevent collection for'),
          '#default_value' => $config->get('allowed_types'),
          '#options' => $types,
          '#description' => t('On the specified node types, an fridayevent option will be available and can be enabled while tht node is being edited.'),
           );
        $form['array_filter'] = array('#type' => 'value', '#value' => TRUE);
        return parent::buildForm($form,$form_state);
      }



      public function submitForm(array &$form, FormStateInterface $form_state) {
        $allowed_types = array_filter($form_state->getValue('fridayevent_types'));
        sort($allowed_types);
        $this->config('fridayevent.settings')
          ->set('allowed_types', $allowed_types)
          ->save();
        parent::submitForm($form, $form_state);
      }
}

