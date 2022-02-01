<?php

namespace Drupal\show_contact_message\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Markup;

/**
 * An example controller.
 */
class ShowContactMessageController extends ControllerBase
{

  /**
   * {@inheritdoc}
   */
  public function content()
  {

    $output['links_example'] = [
      '#theme' => 'item_list',
      '#items' => "",
    ];
    return $output;

  }

}
