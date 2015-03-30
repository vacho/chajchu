<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Photo.
 */

namespace Drupal\chajchu\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the Photo entity type.
 */
class PhotoViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['photo']['table']['base'] = array(
      'field' => 'id',
      'title' => t('Photo'),
      'help' => t('The photo entity ID.'),
    );

    return $data;
  }

}
