<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Product.
 */

namespace Drupal\chajchu\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the Product entity type.
 */
class ProductViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['product']['table']['base'] = array(
      'field' => 'id',
      'title' => t('Product'),
      'help' => t('The product entity ID.'),
    );

    return $data;
  }

}
