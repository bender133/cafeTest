<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{menu}}`.
 */
class m230419_210725_created_menu_table extends Migration {

  /**
   * {@inheritdoc}
   */
  public function safeUp() {
    $this->createTable('{{menu}}', [
      'id' => $this->primaryKey(),
      'chef_id' => $this->integer(),
      'dishes_id' => $this->integer(),
      'quantity' => $this->integer()->defaultValue(0),
    ]);

    $this->addForeignKey(
      'fk_menu_chef_id',
      'menu',
      'chef_id',
      'chefs',
      'id',
      'SET NULL'
    );

    $this->addForeignKey(
      'fk_dishes_id',
      'menu',
      'dishes_id',
      'dishes',
      'id',
      'SET NULL'
    );
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown() {
    $this->dropTable('{{menu}}');
  }

}
