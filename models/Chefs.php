<?php

declare(strict_types=1);

namespace app\models;

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
class Chefs extends \yii\db\ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'chefs';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['active'], 'integer'],
      [['name'], 'string', 'max' => 24],
      [['name'], 'unique'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'name' => 'Name',
      'active' => 'Active',
    ];
  }

  public function getDishes() {
    return $this->hasMany(Dishes::class, ['chef_id' => 'id']);
  }

  public function getMenu() {
    return $this->hasMany(Menu::class, ['chef_id' => 'id']);
  }

}
