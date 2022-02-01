<?php

namespace Drupal\show_contact_message\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Controller\ControllerBase;


/**
 *
 * @Block(
 *   id = "custom_block_test",
 *   admin_label = @Translation("Show messages"),
 *   category = @Translation("Custom Block"),
 * )
 */
class CustomBlock extends BlockBase
{

  /**
   * {@inheritdoc}
   */
  public function build()
  {

    $contact_info = \Drupal::database()
      ->select('contact_info', 'n')
      ->fields('n', ['name', 'subject', 'message'])
      ->orderBy('n.id', 'DESC')
      ->range(0, 10)
      ->execute()
      ->fetchAll();

    for ($i = 0; $i < count($contact_info); $i++) {
      foreach ($contact_info[$i] as $item => $key) {
        $some_array[] = [
            'class' => $item.$i,
            'label' => $key,
        ];
      }
      $some_array_table[] = $some_array;
      unset($some_array);

    }
    return [
      '#theme' => 'custom-block',
      '#social_info' => $some_array_table,
    ];

  }

}


// kamel

/*

<?php

namespace Drupal\social\Plugin\Block;

use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Core\Block\BlockBase;

/**

 *
 * @Block(
 *   id = "custom_block",
 *   admin_label = @Translation("Custom block"),
 *   category = @Translation("Custom Block"),
 * )
 */
//class CustomBlock extends BlockBase {
//
//  /**
//   * {@inheritdoc}
//   */
//  public function build() {
//    $list = array();
//    function add_social_links($url,$link_options,$text,&$list){
//      $url = Url::fromUri($url);
//      $url->setOptions($link_options);
//      $link = Link::fromTextAndUrl($text, $url);
//      $list[] = $link;
//    }
//    add_social_links("https://facebook.com",[
//      'attributes' => [
//        'target' => 'fb_blank',
//        'title' => 'Link to Facebook page',
//      ],
//    ],"Facebook",$list);
//
//    add_social_links("https://instagram.com",[
//      'attributes' => [
//        'target' => 'instagram_blank',
//        'title' => 'Link to Instagram page',
//      ],
//    ],"Instagram",$list);
//    add_social_links("https://vk.com",[],"VK",$list);
//
//    $output['my_links_page'] = [
//      '#theme' => 'item_list',
//      '#items' => $list,
//      '#title' => $this->t('Social Media Links'),
//    ];
//
//    return $output;
//
//  }
//
//}
//*/
//

