<?php

use yii\db\Migration;

/**
 * Class m230421_095834_insert_menu
 */
class m230421_095834_insert_menu extends Migration {

  /**
   * {@inheritdoc}
   */
  public function up() {
    $this->batchInsert('menu', ['chef_id', 'dishes_id', 'quantity'], [
      [1, 1, 10],
      [1, 2, 5],
      [1, 3, 8],
      [2, 4, 12],
      [2, 5, 3],
      [3, 6, 7],
      [3, 7, 6],
      [4, 8, 9],
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function down() {
    $this->delete('menu', ['quantity' => [10, 5, 8, 12, 3, 7, 6, 9]]);
  }

}
