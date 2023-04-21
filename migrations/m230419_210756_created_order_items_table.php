<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{order_items}}`.
 */
class m230419_210756_created_order_items_table extends Migration {

  /**
   * {@inheritdoc}
   */
  public function safeUp() {
    $this->createTable('{{order_items}}', [
      'id' => $this->primaryKey(),
      'order_id' => $this->integer()->notNull(),
      'menu_id' => $this->integer()->notNull(),
      'quantity' => $this->integer()->defaultValue(0),
      'created_at' => $this->timestamp()
        ->defaultExpression('CURRENT_TIMESTAMP'),
      'updated_at' => $this->timestamp()
        ->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
    ]);

    $this->addForeignKey(
      'fk_menu_id',
      'order_items',
      'menu_id',
      'menu',
      'id',
      'CASCADE'
    );

    $this->addForeignKey(
      'fk_order_id',
      'order_items',
      'order_id',
      'orders',
      'id',
      'CASCADE'
    );
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown() {
    $this->dropTable('{{order_items}}');
  }

}
