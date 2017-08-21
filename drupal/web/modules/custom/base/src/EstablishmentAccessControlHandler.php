<?php

namespace Drupal\base;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Establishment entity.
 *
 * @see \Drupal\base\Entity\Establishment.
 */
class EstablishmentAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\base\Entity\EstablishmentInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished establishment entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published establishment entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit establishment entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete establishment entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add establishment entities');
  }

}
