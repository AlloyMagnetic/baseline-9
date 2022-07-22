<?php

namespace Drupal\notification_bar\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Lorem ipsum block with which you can generate dummy text anywhere.
 *
 * @Block(
 *   id = "notification_bar_block",
 *   admin_label = @Translation("Notification Bar block"),
 * )
 */
class NotificationBarBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $notification_bar = \Drupal::state()->get('notification_bar');
    if (!$notification_bar || !$notification_bar['enabled'] || !$notification_bar['message']) {
      return;
    }

    $build['content'] = [
      '#theme' => 'notification_bar',
      '#message' => $notification_bar['message'],
      '#url' => $notification_bar['url'],
      '#button_text' => $notification_bar['button_text']
    ];
    return $build;
  }
}