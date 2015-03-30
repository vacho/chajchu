<?php

/**
 * @file
 * Contains photo.page.inc.
 *
 * Photo page callback file for the photo entity.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for photo templates.
 *
 * Default template: photo.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_photo(array &$variables) {
  // Fetch Photo Entity Object.
  $photo = $variables['elements']['#photo'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
