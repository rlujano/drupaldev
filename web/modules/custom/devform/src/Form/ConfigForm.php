<?php
 
namespace Drupal\devform\Form;
 
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Drupal\Core\Routing;

class ConfigForm extends FormBase {
  public function getFormId(){
    return 'config_devform';
  }
  public function buildForm(array $form, FormStateInterface $form_state){

    $form['code'] = [
      '#type' => 'number',
      '#title' => $this->t('Code'),
      '#weight' => '0',
      '#required' => 'true',
    ];
    
    $form['description'] = [
      '#type' => 'text_format',
      '#format' => 'basic_html',
      '#title' => $this->t('Description'),
      '#weight' => '0',
      '#required' => true,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#button_type' => 'primary',
      '#weight' => '-100',
      '#default_value' => $this->t('Save') ,
    ];

    return $form;
  }

  public function validateForm(array & $form, FormStateInterface $form_state) {
    $field = $form_state->getValues();
  
    $fields["code"] = $field['code'];
    if (!$form_state->getValue('code') || empty($form_state->getValue('code'))) {
            $form_state->setErrorByName('code', $this->t('Provide the code'));
        }  
  }

  public function submitForm(array &$form, FormStateInterface $form_state){
    try{
      $conn = Database::getConnection();
      $field = $form_state->getValues();
      $fields['code'] = intval($field['code']);
      $fields['description'] = json_encode($field['description']);
      // dd(json_encode($fields['description']));
      // dd($fields);
      $conn->insert('devform')->fields($fields)->execute();

      \Drupal::messenger()->addMessage($this->t('The new data has been correctly saved'));
    }catch(Exception $ex){
      \Drupal::logger('devform')->error($ex->getMessage());
    }
  }

}