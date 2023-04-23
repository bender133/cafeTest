<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chefs".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $active
 *
 * @property Dishes[] $dishes
 * @property Menu[] $menu
 */
class Chefs extends ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName(): string {
    return 'chefs';
  }

  /**
   * {@inheritdoc}
   */
  public function rules(): array {
    return [
      [['active'], 'integer'],
      [['name'], 'required'],
      [['name'], 'string', 'max' => 24],
      [['name'], 'unique'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels(): array {
    return [
      'id' => 'ID',
      'name' => 'Name',
      'active' => 'Active',
    ];
  }

  public function getDishes(): ActiveQueryInterface {
    return $this->hasMany(Dishes::class, ['chef_id' => 'id']);
  }

  public function getMenu(): ActiveQueryInterface {
    return $this->hasMany(Menu::class, ['chef_id' => 'id']);
  }

}
