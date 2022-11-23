<?php
namespace Drupal\sentform\Form;

use Drupal;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Provides an SentDorm Email form
 */
class SentForm extends FormBase{
    public function getFormId()
    {
        return 'sentform_email_form';
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $node=\Drupal::routeMatch()->getParameter('node');
        $nid = $node->nid->value;
        //Name
        $form['name'] = array(
            "#title"=>t('Name'),
            "#type"=>'textfield',
            "#size"=>20,
            '#description'=>t('Enter Your Name.'),
            '#required'=>TRUE,
        );
        //Age
        $form['age']=array(
            "#title"=>t('Age'),
            "#type"=>'textfield',
            "#size"=>20,
            '#description'=>t('Enter Your Age.'),
            '#required'=>TRUE,
        );
        //Emial
        $form['email'] = array(
            '#title'=> t('Email Address'),
            '#type'=>'textfield',
            '#size'=>20,
            '#description'=>t("Enter Your Email Address."),
            '#required'=>TRUE,
        );
        $form['submit'] = array(
            '#type'=>'submit',
            '#value'=>t('Sent'),
        );
        $form['nid']=array(
            '#type'=>'hidden',
            '#value'=>$nid,
        );
        return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $value = $form_state->getValue('email');
        if ($value == !\Drupal::service('email.validator')->isValid($value)){
            $form_state->setErrorByName('email',t('The email address %mail is not valid.',array('%mail'=>$value )));
        }
    //     $value = $form_state->getValue('name');
    //     if($value == !\Drupal::service('name.validator')->isValid($value)){
    //         $form_state->setErrorByName('name',t('The name %name is not valid.',array('%name'=>$value)));
    //     }
    //     $value = $form_state->getValue('age');
    //    if($value == !\Drupal::service('age.validator')->isValid($value)){
    //         $form_state->setErrorByName('age',t('The age %age is not null.',array('%age'=>$value)));
    //    }
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
      $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
      $fields = array(
                'uid' => (int)$user->id(),
                'nid' => $form_state->getValue('nid'),
                'name'=> $form_state->getValue('name'),
                'age' => (int)$form_state->getValue('age'),
                'mail' => $form_state->getValue('email'),
                'created' => time());
            \Drupal::database()
            ->insert('sentform')
            ->fields($fields)
            ->execute();
      \Drupal::messenger()->addStatus(t('You have successfully submitted.'));
    }

}
?>