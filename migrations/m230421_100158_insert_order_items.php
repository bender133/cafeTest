<?php

use yii\db\Migration;

/**
 * Class m230421_100158_insert_order_items
 */
class m230421_100158_insert_order_items extends Migration {

  /**
   * {@inheritdoc}
   */
  public function up() {
    $this->batchInsert('order_items', ['order_id', 'menu_id', 'quantity'], [
      [1, 1, 3],
      [1, 2, 1],
      [2, 3, 2],
      [3, 4, 4],
      [3, 5, 3],
      [3, 6, 1],
      [4, 7, 2],
      [4, 8, 1],
      [4, 1, 2],
      [5, 2, 1],
      [5, 3, 2],
      [5, 4, 1],
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function down() {
    $this->delete('order_items', [
      'quantity' => [
        3,
        1,
        2,
        4,
        3,
        1,
        2,
        1,
        2,
        1,
        2,
        1,
      ],
    ]);
  }

}
