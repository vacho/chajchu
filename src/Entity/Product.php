<?php

/**
 * @file
 * Contains Drupal\chajchu\Entity\Product.
 */

namespace Drupal\chajchu\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\chajchu\ProductInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Product entity.
 *
 * @ingroup chajchu
 *
 * @ContentEntityType(
 *   id = "product",
 *   label = @Translation("Product entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\chajchu\Entity\Controller\ProductListController",
 *     "views_data" = "Drupal\chajchu\Entity\ProductViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\chajchu\Entity\Form\ProductForm",
 *       "add" = "Drupal\chajchu\Entity\Form\ProductForm",
 *       "edit" = "Drupal\chajchu\Entity\Form\ProductForm",
 *       "delete" = "Drupal\chajchu\Entity\Form\ProductDeleteForm",
 *     },
 *     "access" = "Drupal\chajchu\ProductAccessControlHandler",
 *   },
 *   base_table = "product",
 *   admin_permission = "administer Product entity",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/entity.product.canonical",
 *     "edit-form" = "/entity.product.edit_form",
 *     "delete-form" = "/entity.product.delete_form",
 *     "collection" = "/entity.product.collection"
 *   },
 *   field_ui_base_route = "product.settings"
 * )
 */
class Product extends ContentEntityBase implements ProductInterface {
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
      ->setDescription(t('The ID of the Product entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Product entity.'))
      ->setReadOnly(TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of the Product entity author.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDefaultValueCallback('Drupal\node\Entity\Node::getCurrentUserId')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 50,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 50,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['category'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Category'))
      ->setDescription(t('The ID of the parent.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'category')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
          'label' => 'hidden',
          'type' => 'category',
          'weight' => -9,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'entity_reference_autocomplete',
          'weight' => -9,
          'settings' => array(
              'match_operator' => 'CONTAINS',
              'size' => '60',
              'autocomplete_type' => 'tags',
              'placeholder' => '',
          ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    
    $fields['person'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Person'))
      ->setDescription(t('The ID of the parent.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'person')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
          'label' => 'hidden',
          'type' => 'person',
          'weight' => -8,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'entity_reference_autocomplete',
          'weight' => -8,
          'settings' => array(
              'match_operator' => 'CONTAINS',
              'size' => '60',
              'autocomplete_type' => 'tags',
              'placeholder' => '',
          ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['political_division'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Locality'))
      ->setDescription(t('The locality.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'political_division')
      ->setSetting('handler', 'default')
      ->setDefaultValue(array(2)) //Cochabamba
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
          'label' => 'hidden',
          'type' => 'political_division',
          'weight' => -7,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'entity_reference_autocomplete',
          'weight' => -7,
          'settings' => array(
              'match_operator' => 'CONTAINS',
              'size' => '60',
              'autocomplete_type' => 'tags',
              'placeholder' => '',
          ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['presentation'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Presentation'))
      ->setDescription(t('The presentation.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'presentation')
      ->setSetting('handler', 'default')
      ->setDefaultValue(array(1)) //Normal
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
          'label' => 'hidden',
          'type' => 'presentation',
          'weight' => -6,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'entity_reference_autocomplete',
          'weight' => -6,
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
      ->setDescription(t('The name of the Product entity.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    
    $fields['type'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Type'))
      ->setDescription(t('The type.'))
      ->setSettings(array(
          'allowed_values' => array(
              'Offer' => t('Offer'),
              'Demand' => t('Demand'),
          ),
      ))
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'options_select',
          'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
   
    $fields['detail'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Detail'))
      ->setDescription(t('The detail'))
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'string',
          'weight' => -3,
          'settings' => array(
              'size' => 60,
              'placeholder' => '_' . t('Description'),
          ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
   
    $fields['email'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Email'))
      ->setDescription(t('The email.'))
      ->setSettings(array(
          'default_value' => '',
          'max_length' => 100,
          'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => -2,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'string_textfield',
          'weight' => -2,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    
    $fields['webpage'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Webpage'))
      ->setDescription(t('The webpage.'))
      ->setSettings(array(
          'default_value' => '',
          'max_length' => 100,
          'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => -1,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'string_textfield',
          'weight' => -1,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    
    $fields['facebook'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Facebook'))
      ->setDescription(t('The facebook.'))
      ->setSettings(array(
          'default_value' => '',
          'max_length' => 100,
          'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'string_textfield',
          'weight' => 0,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
      
    $fields['linkedin'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Linkedin'))
      ->setDescription(t('The linkedin.'))
      ->setSettings(array(
          'default_value' => '',
          'max_length' => 100,
          'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => 1,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'string_textfield',
          'weight' => 1,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['twitter'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Twitter'))
      ->setDescription(t('The twitter.'))
      ->setSettings(array(
          'default_value' => '',
          'max_length' => 100,
          'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => 2,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'string_textfield',
          'weight' => 2,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['phone'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Phone'))
      ->setDescription(t('The phone.'))
      ->setSettings(array(
          'default_value' => '',
          'max_length' => 13,
          'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => 3,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'string_textfield',
          'weight' => 3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['cellphone'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Cellphone'))
      ->setDescription(t('The cellphone.'))
      ->setSettings(array(
          'default_value' => '',
          'max_length' => 13,
          'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => 4,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'string_textfield',
          'weight' => 4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['address'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Address'))
      ->setDescription(t('The address.'))
      ->setSettings(array(
          'default_value' => '',
          'max_length' => 255,
          'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
          'label' => 'above',
          'type' => 'string',
          'weight' => 5,
      ))
      ->setDisplayOptions('form', array(
          'type' => 'string_textfield',
          'weight' => 5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    
    //ini datetimetime
    $fields['expire'] = BaseFieldDefinition::create('timestamp')
      ->setLabel(t('Expire'))
      ->setDescription(t('The expire date.'));

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of Product entity.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
