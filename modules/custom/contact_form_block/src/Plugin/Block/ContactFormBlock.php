<?php

namespace Drupal\contact_form_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\contact_form_block\Form\ContactForm;

/**
 * Provides a block with a custom form.
 *
 * @Block(
 *   id = "contact_form_block",
 *   admin_label = @Translation("Contact Form Block"),
 * )
 */
class ContactFormBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The form object.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected FormBuilderInterface $contact_Form;

  /**
   * Constructs a ContactFormBlock.
   *
   * @param array $configuration
   *   The configuration array.
   * @param string $plugin_id
   *   The plugin ID.
   * @param mixed $plugin_definition
   *   The plugin definition.
   * @param \Drupal\Core\Form\FormBuilderInterface $contact_Form
   *   The form builder service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $contact_Form) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->contactForm = $contact_Form;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Return the form render array.
    return \Drupal::formBuilder()->getForm(ContactForm::class);
  //  $build = [
  //     '#theme' => 'contact_form_block',
  //     '#custom_variable' => \Drupal::formBuilder()->getForm(ContactForm::class),
  //   ];
  //   return $build;
  }

}