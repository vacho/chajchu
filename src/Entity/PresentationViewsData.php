<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Presentation.
 */

namespace Drupal\chajchu\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the Presentation entity type.
 */
class PresentationViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['presentation']['table']['base'] = array(
      'field' => 'id',
      'title' => t('Presentation'),
      'help' => t('The presentation entity ID.'),
    );

    return $data;
  }

}
