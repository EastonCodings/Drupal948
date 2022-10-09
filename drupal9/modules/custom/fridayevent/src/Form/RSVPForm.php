<?php

namespace Drupal\fridayevent\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RSVPForm extends FormBase {
    public function getFormId()
    {
        return 'fridayevent_email_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $node = \Drupal::routeMatch()->getParameter('node');
        $nid = $node->nid->value;
        $form['name'] = array(
            '#title' => t('Name'),
            '#type' => 'textfield',
            '#size' => 25,
            '#description' => t('Please enter the name'),
            '#required' => TRUE,
        );
        $form['age'] = array(
            '#title' => t('Age'),
            '#type' => 'textfield',
            '#size' => 25,
            '#description' => t('Please enter the age'),
            '#required' => TRUE,
        );
        $form['email'] = array(
            '#title' => t('Email Address'),
            '#type' => 'textfield',
            '#size' => 25,
            '#description' => t('Please enter the email'),
            '#required' => TRUE,
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => t('FridayEvent'),
        );
        $form['nid'] = array(
            '#type' => 'hidden',
            '#value' => $nid,
        );
        return $form;
    }

    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $value = $form_state->getValue('email');
        if($value == !\Drupal::service('email.validator')->isValid($value)){
            $form_state->setErrorByName('email',t('the email address %mail is not valid.', array('%mail' => $value)));
        }
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
        // db_insert('revplist')
        //   ->fields(array(
        //     'mail' => $form_state->getValue('email'),
        //     'nid' => $form_state->getValue('nid'),
        //     'uid' => $user->id(),
        //     'created' => time(),
        //   ))->execute();
        // $fields = array(
        //     'id' => '',
        //     'uid' => $user->id(),
        //     'nid' => $form_state->getValue('nid'),
        //     'mail' => $form_state->getValue('email'),
        //     'created' => time());
        $str = $form_state->getValue('name') . $form_state->getValue('age') .
               $form_state->getValue('email');
        $randStr = str_shuffle($str);
        $rands= substr($randStr,-3);
        // echo $rands;
        $t = time();
        $dt = date("Y-m-d H:i" , $t);

        $fields = array(
            'id' => $randStr,
            'uid' => $user->id(),
            // 'nid' => $form_state->getValue('nid'),
            'nid' => $rands,
            'name' => $form_state->getValue('name'),
            'age' => $form_state->getValue('age'),
            'mail' => $form_state->getValue('email'),
            'created' => $dt);
        \Drupal::database()
        ->insert('fridayevent')
        ->fields($fields)
        ->execute();
        \Drupal::messenger()->addStatus(t('This is a successful record.'));
    }
}