<?php

namespace Drupal\alloy_blog\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Blog edit forms.
 *
 * @ingroup alloy_blog
 */
class BlogForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\alloy_blog\Entity\Blog */
    $form = parent::buildForm($form, $form_state);

    if (!$this->entity->isNew()) {
      $form['new_revision'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Create new revision'),
        '#default_value' => FALSE,
        '#weight' => 10,
      ];
    }

    $form['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Published'),
      '#default_value' => $this->entity->isPublished(),
      '#weight' => 11,
    ];

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    // Save as a new revision if requested to do so.
    if (!$form_state->isValueEmpty('new_revision') && $form_state->getValue('new_revision') != FALSE) {
      $entity->setNewRevision();

      // If a new revision is created, save the current user as revision author.
      $entity->setRevisionCreationTime(\Drupal::time()->getRequestTime());
      $entity->setRevisionUserId(\Drupal::currentUser()->id());
    }
    else {
      $entity->setNewRevision(FALSE);
    }

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('Created the %label Blog.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        $this->messenger()->addStatus($this->t('Saved the %label Blog.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.blog.canonical', ['blog' => $entity->id()]);
  }

}
