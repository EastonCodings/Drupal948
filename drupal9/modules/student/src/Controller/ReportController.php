<?php
/**
	* @file
	* Contains \Drupal\student\Controller\ReportController;
	*/

namespace Drupal\student\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

/**
  * Controller for student List Report
  */
 class ReportController extends ControllerBase {

 	/**
 	  * Get all students for all nodes.
 	  * @return array
 	  */
 	   protected function load() {
      $select = Database::getConnection()->select('student', 's');
      $select->addField('s', 'name');
      $select->addField('s', 'age');
      $select->addField('s', 'mail','email');

      $entries = $select->execute()->fetchAll(\PDO::FETCH_ASSOC);
      // \Drupal::messenger()->addStatus( $select, $entries);
      return $entries;
 	  }

 	  /**
 	    *  Create the Report page.
 	    *
 	    * @return array
 	    * Render array for report output.
 	    *
 	    */
 	   public function report() {
      $content = array();

      $content['message'] = array( 
       '#markup' => $this->t('Below is a list of students.'));
        $header = array( t('Name'), t('Age'), t('Email'));
      $rows = array();

      foreach ($entires = $this->load() as $entry ) {
      	// Sanitize each entry
      	$rows[] = array_map('Drupal\Component\Utility\SafeMarkup::checkPlain', $entry);
      }

      $content['table'] = array(
         '#type' => 'table',
         '#header' => $header,
         '#rows' => $rows,
         '#empty' => t('No Entires Available.'),
      );

      // Don't Catche this page.
     $content['#cache']['max-age'] = 0;
     return $content;

 	   }



 }
