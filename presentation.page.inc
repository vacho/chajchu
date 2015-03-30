<?php

/**
 * @file
 * Contains presentation.page.inc.
 *
 * Presentation page callback file for the presentation entity.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for presentation templates.
 *
 * Default template: presentation.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_presentation(array &$variables) {
  // Fetch Presentation Entity Object.
  $presentation = $variables['elements']['#presentation'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
