<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int|null $chef_id
 * @property int|null $dishes_id
 * @property int|null $quantity
 *
 * @property Chefs $chef
 * @property Dishes $dishes
 * @property OrderItems[] $orderItems
 */
class Menu extends ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName(): string {
    return 'menu';
  }

  /**
   * {@inheritdoc}
   */
  public function rules(): array {
    return [
      [['chef_id', 'dishes_id', 'quantity'], 'integer'],
      [['chef_id', 'dishes_id'], 'required'],
      [
        ['dishes_id'],
        'exist',
        'skipOnError' => true,
        'targetClass' => Dishes::class,
        'targetAttribute' => ['dishes_id' => 'id'],
      ],
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
      'dishes_id' => 'Dishes ID',
      'quantity' => 'Quantity',
    ];
  }

  public function getChef(): ActiveQueryInterface {
    return $this->hasOne(Chefs::class, ['id' => 'chef_id']);
  }

  public function getDishes(): ActiveQueryInterface {
    return $this->hasOne(Dishes::class, ['id' => 'dishes_id']);
  }

  public function getOrderItems(): ActiveQueryInterface {
    return $this->hasMany(OrderItems::class, ['menu_id' => 'id']);
  }

  public function decreaseQuantity(int $quantity): void {
    $this->quantity -= $quantity;
  }

  public function hasEnoughQuantity(int $quantity): bool {
    return $this->quantity >= $quantity;
  }

}
