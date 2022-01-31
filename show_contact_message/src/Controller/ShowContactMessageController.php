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
    $contact_info = \Drupal::database()
      ->select('contact_info', 'n')
      ->fields('n', ['name', 'subject', 'message'])
      ->execute()
      ->fetchAll();
//    dump($contact_info);


    // We'll add some HTML attributes to the link.
    for ($i = 0; $i < count($contact_info); $i++) {
      foreach ($contact_info[$i] as $item => $key) {
        $link_options = [
          'attributes' => [
            'title' => "$item :: ".$key,
          ],
        ];
        $list[] = $link_options;
      }
    }
    $output['links_example'] = [
      '#theme' => 'item_list',
      '#items' => $list,
    ];
    return $output;

  }

}
