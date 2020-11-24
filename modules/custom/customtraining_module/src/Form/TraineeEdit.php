<?php
/**
 * @file
 * Contains \Drupal\customtraining_module\Form\TraineeEdit
 */
namespace Drupal\customtraining_module\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\user\RegisterForm;

class TraineeEdit extends RegisterForm {
/**
* {@inheritdoc}.
*/
  public function getFormId() {

    return 'trainee_adding';
  }
}
    
