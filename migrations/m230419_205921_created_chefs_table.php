<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{chefs}}`.
 */
class m230419_205921_created_chefs_table extends Migration {

  /**
   * {@inheritdoc}
   */
  public function safeUp() {
    $this->createTable('{{chefs}}', [
        'id' => $this->primaryKey(),
        'name' => $this->string(24)->unique(),
        'active' => $this->tinyInteger(1)->defaultValue(1),
      ]
    );

    $this->createIndex(
      'idx_chefs_name',
      'chefs',
      'name'
    );

    $this->createIndex(
      'idx_chefs_active',
      'chefs',
      'active'
    );
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown() {
    $this->dropTable('{{chefs}}');
  }

}
