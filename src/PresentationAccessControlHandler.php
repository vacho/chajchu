<?php

/**
 * @file
 * Contains Drupal\account\PresentationAccessController.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Presentation entity.
 *
 * @see \Drupal\chajchu\Entity\Presentation.
 */
class PresentationAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view Presentation entity');

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit Presentation entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete Presentation entity');
    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add Bar entity');
  }

}
