<?php
/**
 * @file
 * Contains \Drupal\fridayevent\Controller\ReportController.
 */
namespace Drupal\fridayevent\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

/**
 * Controller for FridayEvent Module Report
*/
class ReportController extends ControllerBase {

  /**
   * Gets all FridayEvent for all nodes.
   *
   * @return array
   */
  protected function load() {
    $select = Database::getConnection()->select('fridayevent', 'r');
      // Join the users table, so we can get the entry creator's username.
    $select->join('users_field_data', 'u', 'r.uid = u.uid');
      // Join the node table, so we can get the event's name.
    $select->join('node_field_data', 'n', 'r.nid = n.nid');
    // Select these specific fields for the output.
    $select->addField('u', 'name', 'username');
    $select->addField('n', 'title');
    $select->addField('r', 'name');
    $select->addField('r', 'age');
    $select->addField('r', 'mail');
    $entries = $select->execute()->fetchAll(\PDO::FETCH_ASSOC);
    return $entries;
  }

  /**
   * Creates the report page.
   *
   * @return array
   *  Render array for report output.
   */
  public function report() {
    $content = array();
    $content['message'] = array(
      '#markup' => $this->t('Below is a list of all Event FridayEvent including username, email address and the name of the event they will be attending.'),
    );
    $headers = array(
      t('Name'),
      t('Event'),
      t('Email'),
    );
    $rows = array();
    foreach ($entries = $this->load() as $entry) {
      // Sanitize each entry.
      $rows[] = array_map('Drupal\Component\Utility\SafeMarkup::checkPlain', $entry);
    }
    $content['table'] = array(
      '#type' => 'table',
      '#header' => $headers,
      '#rows' => $rows,
      '#empty' => t('No entries available.'),
    );
    // Don't cache this page.
    $content['#cache']['max-age'] = 0;
    return $content;
  }

}
