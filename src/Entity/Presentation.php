<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Presentation.
 */

namespace Drupal\chajchu\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\chajchu\PresentationInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Presentation entity.
 *
 * @ingroup chajchu
 *
 * @ContentEntityType(
 *   id = "presentation",
 *   label = @Translation("Presentation entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\chajchu\Entity\Controller\PresentationListController",
 *     "views_data" = "Drupal\chajchu\Entity\PresentationViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\chajchu\Entity\Form\PresentationForm",
 *       "add" = "Drupal\chajchu\Entity\Form\PresentationForm",
 *       "edit" = "Drupal\chajchu\Entity\Form\PresentationForm",
 *       "delete" = "Drupal\chajchu\Entity\Form\PresentationDeleteForm",
 *     },
 *     "access" = "Drupal\chajchu\PresentationAccessControlHandler",
 *   },
 *   base_table = "presentation",
 *   admin_permission = "administer Presentation entity",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/entity.presentation.canonical",
 *     "edit-form" = "/entity.presentation.edit_form",
 *     "delete-form" = "/entity.presentation.delete_form",
 *     "collection" = "/entity.presentation.collection"
 *   },
 *   field_ui_base_route = "presentation.settings"
 * )
 */
class Presentation extends ContentEntityBase implements PresentationInterface {
  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getChangedTime() {
    return $this->get('changed')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Presentation entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Presentation entity.'))
      ->setReadOnly(TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of the Presentation entity author.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDefaultValueCallback('Drupal\node\Entity\Node::getCurrentUserId')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Presentation entity.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    
    $fields['highlighted'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Highlighted'))
      ->setDescription(t('Highlighted'))
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => -3
      ))
      ->setDisplayOptions('form', array(
          'type' => 'boolean',
          'weight' => -3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['weight'] = BaseFieldDefinition::create('integer')
    ->setLabel(t('Weight'))
    ->setDescription(t('The weight'))
    ->setSettings(array(
        'default_value' => 1,
        'max_length' => 2,
        'max' => 10,
        'min' => 1,
        'prefix' => '',
        'suffix' => '',
        'text_processing' => 0,
    ))
    ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'integer',
        'weight' => -2,
    ))
    ->setDisplayOptions('form', array(
        'type' => 'integer',
        'weight' => -2,
    ))
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayConfigurable('view', TRUE);

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of Presentation entity.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
