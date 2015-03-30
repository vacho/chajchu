<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Category.
 */

namespace Drupal\chajchu\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the Category entity type.
 */
class CategoryViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['category']['table']['base'] = array(
      'field' => 'id',
      'title' => t('Category'),
      'help' => t('The category entity ID.'),
    );

    return $data;
  }

}
