<?php
/**
* @file
* contains \Drupal\student\Plugin\Block\StudentBlock
*/
namespace Drupal\student\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
  * Provides an 'Student' List Block
  * @Block(
  *   id = "Student_block",
  *   admin_label = @Translation("Student Block"),
  * )
  */

Class StudentBlock extends BlockBase {
	/**
	  * {@inheritdoc}
	  */
		public function build() {
			return array('#markup' => $this ->t('my student block'));
		}
}