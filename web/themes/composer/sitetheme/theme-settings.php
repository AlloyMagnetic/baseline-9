<?php

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Theme\ThemeSettings;
use Drupal\system\Form\ThemeSettingsForm;
use Drupal\Core\Form;

function sitetheme_form_system_theme_settings_alter(&$form, Drupal\Core\Form\FormStateInterface $form_state) {
  $form['baseline_settings'] = [
    '#type' => 'vertical_tabs',
    '#attached' => ['library' => ['bootstrap/theme-settings']],
    '#prefix' => '<h2><small>Baseline Settings</small></h2>',
    '#weight' => -19,
  ];
  $form['baseline_navbar'] = [
    '#type' => 'details',
    '#group' => 'baseline_settings',
    '#title' => t('Navbar'),
    '#open' => TRUE,
  ];
  $form['baseline_navbar']['phone_cta_text'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone CTA Text'),
    '#default_value' => theme_get_setting('phone_cta_text', 'sitetheme'),
    '#description' => t('Ex: Call us today'),
  );
  $form['baseline_navbar']['phone_number'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone Number'),
    '#default_value' => theme_get_setting('phone_number', 'sitetheme'),
    '#description' => t('A formatted phone number. Ex: (555) 555-5555'),
  );
  $form['baseline_navbar']['navbar_layout'] = array(
    '#type' => 'select',
    '#title' => t('Main Navigation Layout'),
    '#required' => TRUE,
    '#options' => [
      'nav_inline' => t('Inline nav'),
      'nav_below' => t('Nav below masthead'),
    ],
    '#default_value' => theme_get_setting('navbar_layout', 'sitetheme') ?: 'nav_inline',
  );
}
