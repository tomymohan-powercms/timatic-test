<?php
/**
 * @file
 * Contains \Drupal\customtraining_module\Form\UserAddForm
 */
namespace Drupal\customtraining_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

class UserAddForm extends FormBase {
/**
* {@inheritdoc}.
*/
  public function getFormId() {

    return 'user_add_form';
  }

  /**
  * {@inheritdoc}.
  */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $roles = \Drupal::currentUser()->getRoles();
    $options = []; 
    if (in_array('trainer', $roles)) {
      $options = ['trainee' => 'Trainee'];
    }
    else {
      $options = ['trainee' => 'Trainee', 'trainer' => 'Trainer'];
    }
    $form['mail'] = [
      '#type' => 'textfield',
      '#title' => t('Email'),
      "#placeholder" => t('Enter emil address'),
    ];
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => t('Name'),
      "#placeholder" => t('Enter Username'),
    ];

    $form['roles'] = [
      '#type' => 'radios',
      '#title' => t('Roles'),
      '#options' => $options,
      '#required' => TRUE,
    ];
    
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Invite'),
      '#button_type' => 'primary',
    ];
    
    $form['actions']['cancel'] = [
      '#type' => 'submit',
      '#value' => $this->t('Cancel'),
      '#button_type' => 'primary',
      '#attributes' => [
        'onClick' => 'javascript:window.history.go(-1); return false;'
      ],
    ];
   
    return $form;
  }

/**
  * {@inheritdoc}
  */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    $mail = $form_state->getValue('mail');
    if (!valid_email_address($mail)) {
      $form_state->setErrorByName('mail', $this->t('The email address appears to be invalid.')); 
    }

    $ids = \Drupal::entityQuery('user')
        ->condition('mail', $mail)
        ->range(0, 1)
        ->execute(); 
        if(!empty($ids)) {

      $form_state->setErrorByName('mail', $this->t('Email already exist. PLease try another.')); 
    }
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    $mail = $form_state->getValue('mail');
    $role = $form_state->getValue('roles');
    $name = $form_state->getValue('name');


    $user = User::create([   
      'mail' => $mail,
      'roles' => $role,
      'name' => $name
      ]);
    $user -> save();
     drupal_set_message("Successfully added user.");
  }
}
    
