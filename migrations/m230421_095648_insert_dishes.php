<?php

use yii\db\Migration;

/**
 * Class m230421_095648_insert_dishes
 */
class m230421_095648_insert_dishes extends Migration {

  /**
   * {@inheritdoc}
   */
  public function up() {
    $this->batchInsert('dishes', ['chef_id', 'name', 'active'], [
      [1, 'Spaghetti Carbonara', 1],
      [1, 'Margherita Pizza', 1],
      [2, 'Beef Wellington', 1],
      [2, 'Lobster Bisque', 0],
      [3, 'Fish and Chips', 1],
      [3, 'Shepherd\'s Pie', 1],
      [4, 'Pad Thai', 1],
      [4, 'Green Curry', 0],
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function down() {
    $this->delete('dishes', [
      'name' => [
        'Spaghetti Carbonara',
        'Margherita Pizza',
        'Beef Wellington',
        'Lobster Bisque',
        'Fish and Chips',
        'Shepherd\'s Pie',
        'Pad Thai',
        'Green Curry',
      ],
    ]);
  }

}
