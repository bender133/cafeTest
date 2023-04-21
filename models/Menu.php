<?php

declare(strict_types=1);

namespace app\models;

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
class Menu extends \yii\db\ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'menu';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['chef_id', 'dishes_id', 'quantity'], 'integer'],
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
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'chef_id' => 'Chef ID',
      'dishes_id' => 'Dishes ID',
      'quantity' => 'Quantity',
    ];
  }

  public function getChef() {
    return $this->hasOne(Chefs::class, ['id' => 'chef_id']);
  }

  public function getDishes() {
    return $this->hasOne(Dishes::class, ['id' => 'dishes_id']);
  }

  public function getOrderItems() {
    return $this->hasMany(OrderItems::class, ['menu_id' => 'id']);
  }

  public function decreaseQuantity(int $quantity): bool {
    $this->quantity -= $quantity;

    return $this->save();
  }

  public function hasEnoughQuantity($quantity): bool {
    return $this->quantity >= $quantity;
  }

}
