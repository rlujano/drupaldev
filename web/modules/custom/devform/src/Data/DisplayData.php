<?php

namespace Drupal\devform\Data;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

/**
 * Class DisplayTableController.
 *
 * @package Drupal\devform\Controller
 */
class DisplayData extends ControllerBase {
  /**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */
  public function display() {
    
    $query = \Drupal::database()->select('devform', 'd');
    $query->fields('d', ['id','code', 'description']);
    $results = $query->execute()->fetchAll();
    $rows=array();
    // dd($results);
    
    foreach($results as $data){
        // $delete = Url::fromUserInput('/mydata/form/delete/'.$data->id);
        // $edit   = Url::fromUserInput('/mydata/form/mydata?num='.$data->id);

      //print the data from table
             $rows[] = array(
            'id' => $data->id,
                'code' => $data->code,
                'description' => json_decode($data->description, true),
                //  \Drupal::l('Delete', $delete),
                //  \Drupal::l('Edit', $edit),
            );

    }
   // dump($rows);
    // return $results;
    

    // dd($datalist);
    return array(
      '#theme' => 'data_list',
      '#items' => $rows,
      '#title' => 'All data list'
    );

  }

}