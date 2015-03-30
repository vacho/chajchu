<?php

/**
 * @file
 * Contains category.page.inc.
 *
 * Category page callback file for the category entity.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for category templates.
 *
 * Default template: category.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_category(array &$variables) {
  // Fetch Category Entity Object.
  $category = $variables['elements']['#category'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
