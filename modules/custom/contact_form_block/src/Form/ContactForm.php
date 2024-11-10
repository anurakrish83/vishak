<?php

namespace Drupal\contact_form_block\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Contact Form.
 */
class ContactForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contact_form_block_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#placeholder' => 'First Name',
    ];

    $form['phone'] = [
      '#type' => 'textfield',
      '#placeholder' => 'Phone Number',
    ];

    $form['email'] = [
      '#type' => 'email',
      '#placeholder' => 'Email Address',
    ];

    $form['address'] = [
      '#type' => 'textarea',
      '#placeholder' => 'Address Location',
    ];

    $form['time'] = [
      '#type' => 'textarea',
      '#placeholder' => 'Select Time',
    ];

    $form['date'] = [
      '#type' => 'date',
      '#placeholder' => 'mm/dd/yyyy',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send Request'),
    ];

    return $form;
  }

  /**
 * {@inheritdoc}
 */
public function validateForm(array &$form, FormStateInterface $form_state) {
  parent::validateForm($form, $form_state);

  // Validate the appointment time format.
  $time = $form_state->getValue('time');
  $first_name = $form_state->getValue('name');
  $email = $form_state->getValue('email');
  if($first_name == '') {
    $form_state->setErrorByName('name', $this->t('Please enter a Name'));
  }
  if($email == '') {
    $form_state->setErrorByName('email', $this->t('Please enter a email'));
  }
  if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $time)) {
    $form_state->setErrorByName('time', $this->t('Please enter a valid time in HH:MM format.'));
  }
}

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Process form data here, such as sending an email or saving to database.
    $name = $form_state->getValue('name');
    $email = $form_state->getValue('email');
    $phone = $form_state->getValue('phone');
    $address = $form_state->getValue('address');
    $time = $form_state->getValue('time');
    $date = $form_state->getValue('date');

    // Display a message to the user.
    $this->messenger()->addMessage($this->t('Thank you @name, your message has been sent!', ['@name' => $name]));
  }

}