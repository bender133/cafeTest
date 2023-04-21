<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{orders}}`.
 */
class m230419_210746_created_orders_table extends Migration {

  /**
   * {@inheritdoc}
   */
  public function safeUp() {
    $this->createTable('{{orders}}', [
      'id' => $this->primaryKey(),
      'name' => $this->string(32)->notNull(),
      'user' => $this->string(32)->notNull(),
      'status' => $this->smallInteger()
        ->notNull()
        ->defaultValue(0)
        ->comment('0 - создан, 2 - исполнен, 3 - отменен'),
      'updated_at' => $this->timestamp()
        ->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
      'created_at' => $this->timestamp()
        ->defaultExpression('CURRENT_TIMESTAMP'),
    ]);

    $this->createIndex('idx_orders_status', 'orders', 'status');
    $this->createIndex('idx_orders_date', 'orders', 'updated_at');
    $this->createIndex('idx_orders_user', 'orders', 'user');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown() {
    $this->dropTable('{{orders}}');
  }

}
