<?php

use yii\db\Migration;

/**
 * Class m230421_095337_insert_shefs
 */
class m230421_095337_insert_shefs extends Migration {

  public function up() {
    $this->batchInsert('chefs', ['name', 'active'], [
      ['John', 1],
      ['Jane', 1],
      ['Bob', 1],
      ['Alice', 1],
    ]);
  }

  public function down() {
    $this->delete('chefs', ['name' => ['John', 'Jane', 'Bob', 'Alice']]);
  }

}
