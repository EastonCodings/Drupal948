<?php
/**
* @file
* Contains \Drupal\student\Form\StudentForm
*/

namespace Drupal\student\Form;


use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Provides an student email form.
*/

class StudentForm extends FormBase {
	/**
	 * (@inheritdoc)
	 */
	public function getFormId() {
		return 'student_email_form';
	}
	/**
	* (@inheritdoc)
	*/
	public function buildForm(array $form, FormStateInterface $form_state) {
		$node = \Drupal::routeMatch()->getParameter('node');
		$nid  = $node->nid->value;
		$form['name']  = array(
			'#title' => t('Name'),
			'#type' => 'textfield',
			'#size' => 20,
			'#description' => t("input your name."),
			'#required' => TRUE );

		$form['age']  = array(
			'#title' => t('Age'),
			'#type' => 'textfield',
			'#size' => 25,
			'#description' => t("We'll send updates to the mail address you provide."),
			'#required' => TRUE );	

		$form['email']  = array(
									  '#title' => t('Email Address'),
									  '#type' => 'textfield',
									  '#size' => 25,
									  '#description' => t("We'll send updates to the mail address you provide."),
									  '#required' => TRUE );
  	$form['submit'] = array(
									  '#type' => 'submit',
									  '#value' => t('submit'));
		$form['nid']    = array(
									  '#type' => 'hidden',
									  '#value' => $nid);
    return $form;

	}
	
	/**
	  * (@inheritdoc)
	  */
  public function validateForm(array &$form,FormStateInterface $form_state) {
   $value = $form_state->getValue('email');
	  if($value == !\Drupal::service('email.validator')->isValid($value)) {
	   	$form_state->setErrorByName('email', t('The email address %mail is not valid.', array('%mail' => $value)));
	   	return;
	   }
// 	   $node = \Drupal::routeMatch()->getParameter('node');
// 	   // Check if mail already is set for this node
// 	   $select = Database::getConnection()->select('studentlist', 'r');
// 	   $select->fields('r', array('nid'));
// 	   $select->condition('nid', $node->id());
// 	   $select->condition('mail', $value);
// 	   $results = $select->execute();
// 	   if(!empty($results->fetchCol())) {
// 	   	// We found a id with this node id and email
// 	   	$form_state->setErrorByName('email', t('The address %mail is already subscribed to this list.', array('%mail' => $value )));
// 	   }
  }

	/**
	  * (@inheritdoc)
	  */
	  public function submitForm(array &$form, FormStateInterface $form_state)
	  {
		 $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
		 $fields = array(
			 'name' => $form_state->getValue('name'),
			 'age' => (int)$form_state->getValue('age'),
			 'mail' => $form_state->getValue('email'),
			 'uid' => (int)$user->id(),
			 'nid' => $form_state->getValue('nid'),
			 'created' => time());
		  \Drupal::database()
		  ->insert('student')
		  ->fields($fields)
		  ->execute();
		  \Drupal::messenger()->addStatus(t('success insert data'));
	  }
}