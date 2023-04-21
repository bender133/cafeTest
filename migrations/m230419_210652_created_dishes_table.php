<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%d_dishes}}`.
 */
class m230419_210652_created_dishes_table extends Migration {

  /**
   * {@inheritdoc}
   */
  public function safeUp() {
    $this->createTable('{{dishes}}', [
      'id' => $this->primaryKey(),
      'chef_id' => $this->integer(),
      'name' => $this->string(32)->unique(),
      'active' => $this->tinyInteger(1)->defaultValue(1),
    ]);

    $this->addForeignKey(
      'fk_dishes_chef_id',
      'dishes',
      'chef_id',
      'chefs',
      'id',
      'SET NULL'
    );

    $this->createIndex(
      'idx_dishes_name',
      'dishes',
      'name'
    );

    $this->createIndex(
      'idx_dishes_active',
      'dishes',
      'active'
    );
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown() {
    $this->dropTable('{{dishes}}');
  }

}
