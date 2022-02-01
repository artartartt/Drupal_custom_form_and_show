<?php

namespace Drupal\contact_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Drupal\Core\Routing;

/**
 * Provides the form for adding countries.
 */
class ContactForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contact_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' =>  '',
    ];
    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Subject'),
      '#required' => TRUE,
      '#maxlength' => 50,
      '#default_value' =>  '',
    ];
    $form['message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Message'),
      '#required' => TRUE,
      '#maxlength' => 200,
      '#default_value' =>  '',
    ];


    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#button_type' => 'primary',
      '#default_value' => $this->t('Save') ,
    ];

    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array & $form, FormStateInterface $form_state) {
    $field = $form_state->getValues();

    $fields["name"] = $field['name'];
    if (!$form_state->getValue('name') || empty($form_state->getValue('name'))) {
      $form_state->setErrorByName('fname', $this->t('Error Name'));
    }
    if (!$form_state->getValue('subject') || empty($form_state->getValue('subject'))) {
      $form_state->setErrorByName('subject', $this->t('Error subject'));
    }
    if (!$form_state->getValue('message') || empty($form_state->getValue('message'))) {
      $form_state->setErrorByName('message', $this->t('Error Message'));
    }


  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array & $form, FormStateInterface $form_state) {

    try{
      $conn = Database::getConnection();

      $field = $form_state->getValues();

      $fields["name"] = $field['name'];
      $fields["subject"] = $field['subject'];
      $fields["message"] = $field['message'];

      $conn->insert('contact_info')
        ->fields($fields)->execute();
      \Drupal::messenger()->addMessage($this->t('The Student data has been succesfully saved'));

    } catch(Exception $ex){
      \Drupal::logger('contact_form')->error($ex->getMessage());
    }

  }


}
