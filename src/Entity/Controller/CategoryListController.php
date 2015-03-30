<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Controller\CategoryListController.
 */

namespace Drupal\chajchu\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for Category entity.
 *
 * @ingroup chajchu
 */
class CategoryListController extends EntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('CategoryID');
    $header['name'] = t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\chajchu\Entity\Category */
    $row['id'] = $entity->id();
    $row['name'] = \Drupal::l(
      $this->getLabel($entity),
      new Url(
        'entity.category.edit_form', array(
          'category' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
