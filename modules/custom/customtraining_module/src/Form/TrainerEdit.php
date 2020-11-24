<?php
/**
 * @file
 * Contains \Drupal\customtraining_module\Form\TrainerEdit
 */
namespace Drupal\customtraining_module\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\user\RegisterForm;

class TrainerEdit extends RegisterForm {
/**
* {@inheritdoc}.
*/
  public function getFormId() {

    return 'trainer_adding';
  }
}
    
