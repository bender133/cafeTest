<?php

declare(strict_types=1);

namespace app\models;

/**
 * This is the model class for table "dishes".
 *
 * @property int $id
 * @property int|null $chef_id
 * @property string|null $name
 * @property int|null $active
 *
 * @property Chefs $chefs
 * @property Menu[] $menu
 */
class Dishes extends \yii\db\ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'dishes';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['chef_id', 'active'], 'integer'],
      [['name'], 'string', 'max' => 32],
      [['name'], 'unique'],
      [
        ['chef_id'],
        'exist',
        'skipOnError' => true,
        'targetClass' => Chefs::class,
        'targetAttribute' => ['chef_id' => 'id'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'chef_id' => 'Chef ID',
      'name' => 'Name',
      'active' => 'Active',
    ];
  }

  public function getChefs() {
    return $this->hasOne(Chefs::class, ['id' => 'chef_id']);
  }

  public function getMenu() {
    return $this->hasMany(Menu::class, ['dishes_id' => 'id']);
  }

}
