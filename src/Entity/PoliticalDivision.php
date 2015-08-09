<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\PoliticalDivision.
 */

namespace Drupal\chajchu\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\chajchu\PoliticalDivisionInterface;
use Drupal\user\UserInterface;

/**
 * Defines the PoliticalDivision entity.
 *
 * @ingroup chajchu
 *
 * @ContentEntityType(
 *   id = "political_division",
 *   label = @Translation("PoliticalDivision entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\chajchu\Entity\Controller\PoliticalDivisionListController",
 *     "views_data" = "Drupal\chajchu\Entity\PoliticalDivisionViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\chajchu\Entity\Form\PoliticalDivisionForm",
 *       "add" = "Drupal\chajchu\Entity\Form\PoliticalDivisionForm",
 *       "edit" = "Drupal\chajchu\Entity\Form\PoliticalDivisionForm",
 *       "delete" = "Drupal\chajchu\Entity\Form\PoliticalDivisionDeleteForm",
 *     },
 *     "access" = "Drupal\chajchu\PoliticalDivisionAccessControlHandler",
 *   },
 *   base_table = "political_division",
 *   admin_permission = "administer PoliticalDivision entity",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/entity.political_division.canonical",
 *     "edit-form" = "/entity.political_division.edit_form",
 *     "delete-form" = "/entity.political_division.delete_form",
 *     "collection" = "/entity.political_division.collection"
 *   },
 *   field_ui_base_route = "political_division.settings"
 * )
 */
class PoliticalDivision extends ContentEntityBase implements PoliticalDivisionInterface {
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
      ->setDescription(t('The ID of the PoliticalDivision entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the PoliticalDivision entity.'))
      ->setReadOnly(TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of the PoliticalDivision entity author.'))
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
    
    $fields['parent'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Parent'))
      ->setDescription(t('The ID of the parent.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'political_division')
      ->setSetting('handler', 'default')
      // ->setDefaultValueCallback('Drupal\node\Entity\Node::getCurrentUserId')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
          'label' => 'hidden',
          'type' => 'political_division',
          'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'entity_reference_autocomplete',
          'weight' => -5,
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
      ->setDescription(t('The name of the PoliticalDivision entity.'))
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

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of PoliticalDivision entity.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
