<?php
/**
 * @file
 * Contains Drupal\notification_bar\Form\NotificationBarForm.
 */
namespace Drupal\notification_bar\Form;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class NotificationBarForm extends FormBase {
  function getFormId() {
    return "notification_bar_form";
  }

  function buildForm(array $form, FormStateInterface $form_state) {
    $value = \Drupal::state()->get('notification_bar');
    if (!$value) {
      $value = [
        'color' => '#000000',
        'enabled' => false,
        'message' => 'Enter a message',
        'url' => false
      ];
    }

    $form['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enabled'),
      '#default_value' => $value['enabled']
    ];

    $form['message'] = [  
      '#type' => 'textarea',  
      '#title' => $this->t('Message'),  
      '#default_value' => $value['message'],
      '#required' => true
    ];
    
    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL'),
      '#default_value' => $value['url']
    ];

    $form['button_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button text'),
      '#default_value' => $value['button_text']
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  function submitForm(array &$form, FormStateInterface $form_state) {
    $value = [
      'enabled' => $form_state->getValue('enabled'),
      'message' => $form_state->getValue('message'),
      'url' => $form_state->getValue('url'),
      'button_text' => $form_state->getValue('button_text')
    ];
    \Drupal::state()->set('notification_bar', $value);
    drupal_flush_all_caches();
    $this->messenger()->addStatus($this->t('The configuration options have been saved.'));
  }
}