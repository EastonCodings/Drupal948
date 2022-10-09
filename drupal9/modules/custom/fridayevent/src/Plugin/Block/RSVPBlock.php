<?php
/**
 * @file
 * Contains \Drupal\fridayevent\Plugin\Block\RSVPBlock
 */
 namespace Drupal\fridayevent\Plugin\Block;

 use Drupal\Core\Block\BlockBase;
 use Drupal\Core\Session\AccountInterface;
 use Drupal\Core\Access\AccessResult;


 /**
 * Provides a 'RSVP' List Block
 *
 * @Block(
 *   id = "rsvp_block",
 *   admin_label = @Translation("RSVP Block"),
 *   category = @Translation("Blocks")
 * )
 */
class RSVPBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return \Drupal::formBuilder()->getForm('Drupal\fridayevent\Form\RSVPForm');
    }

  /**
   * {@inheritdoc}
   */
  public function blockAccess(AccountInterface $account) {
    /** @var \Drupal\node\Entity\Node $node */
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->nid->value;
    /** @var \Drupal\fridayevent\EnablerService $enabler */
    if(is_numeric($nid) || $nid == null) {
        return AccessResult::allowedIfHasPermission($account, 'view fridayevent');
    }
    return AccessResult::forbidden();
  }

}

