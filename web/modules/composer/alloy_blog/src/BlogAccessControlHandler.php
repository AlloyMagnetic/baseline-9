<?php

namespace Drupal\alloy_blog;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Blog entity.
 *
 * @see \Drupal\alloy_blog\Entity\Blog.
 */
class BlogAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\alloy_blog\Entity\BlogInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished blog entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published blog entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit blog entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete blog entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add blog entities');
  }

}
