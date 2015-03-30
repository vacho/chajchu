<?php

/**
 * @file
 * Contains Drupal\account\PoliticalDivisionAccessController.
 */

namespace Drupal\chajchu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the PoliticalDivision entity.
 *
 * @see \Drupal\chajchu\Entity\PoliticalDivision.
 */
class PoliticalDivisionAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view PoliticalDivision entity');

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit PoliticalDivision entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete PoliticalDivision entity');
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
