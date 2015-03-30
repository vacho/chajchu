<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Person.
 */

namespace Drupal\chajchu\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the Person entity type.
 */
class PersonViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['person']['table']['base'] = array(
      'field' => 'id',
      'title' => t('Person'),
      'help' => t('The person entity ID.'),
    );

    return $data;
  }

}
