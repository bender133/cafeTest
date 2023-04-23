<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

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
class Dishes extends ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName(): string {
    return 'dishes';
  }

  /**
   * {@inheritdoc}
   */
  public function rules(): array {
    return [
      [['chef_id', 'active'], 'integer'],
      [['chef_id', 'name'], 'required'],
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
  public function attributeLabels(): array {
    return [
      'id' => 'ID',
      'chef_id' => 'Chef ID',
      'name' => 'Name',
      'active' => 'Active',
    ];
  }

  public function getChefs(): ActiveQueryInterface {
    return $this->hasOne(Chefs::class, ['id' => 'chef_id']);
  }

  public function getMenu(): ActiveQueryInterface {
    return $this->hasMany(Menu::class, ['dishes_id' => 'id']);
  }

}
