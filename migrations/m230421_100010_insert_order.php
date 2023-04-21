<?php

use app\models\Orders;
use yii\db\Migration;

/**
 * Class m230421_100010_insert_order
 */
class m230421_100010_insert_order extends Migration {

  /**
   * {@inheritdoc}
   */
  public function up() {
    $this->batchInsert('orders', ['name', 'user', 'status'], [
      ['Order 1', 'User 1', Orders::CONFIRMED],
      ['Order 2', 'User 2', Orders::CONFIRMED],
      ['Order 3', 'User 3', Orders::CONFIRMED],
      ['Order 4', 'User 4', Orders::CONFIRMED],
      ['Order 5', 'User 5', Orders::CONFIRMED],
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function down() {
    $this->delete('orders', [
      'name' => [
        'Order 1',
        'Order 2',
        'Order 3',
        'Order 4',
        'Order 5',
      ],
    ]);
  }

}
