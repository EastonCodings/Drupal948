<?php
/**
 * @file
 * contains\Drupal\sentform\Plugin\Block\sentformBlock
 */
namespace Drupal\sentform\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

class sentformBlock extends BlockBase{
/**
 * {@inheritdoc}
 */
public function build()
{
    return \Drupal::formBuilder()->getForm('Drupal\sentform\Form\sentform');
}
public function blockAccess(AccountInterface $account){
    /**
     * @var \Drupal\node\Entity\Node $node
     */
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->nid->value;
    if(is_numeric($nid)){
        return AccessResult::allowedIfHasPermission($account,'view sentform');
    }
    return AccessResult::forbidden();
}
}