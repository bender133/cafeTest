<?php

declare(strict_types=1);

namespace app\models;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int $menu_id
 * @property int|null $quantity
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Menu $menu
 * @property Orders $order
 */
class OrderItems extends \yii\db\ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'order_items';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['order_id', 'menu_id', 'quantity'], 'required'],
      [['order_id', 'menu_id', 'quantity'], 'integer'],
      [['created_at', 'updated_at'], 'safe'],
      [
        ['menu_id'],
        'exist',
        'skipOnError' => true,
        'targetClass' => Menu::class,
        'targetAttribute' => ['menu_id' => 'id'],
      ],
      [
        ['order_id'],
        'exist',
        'skipOnError' => true,
        'targetClass' => Orders::class,
        'targetAttribute' => ['order_id' => 'id'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'order_id' => 'Order ID',
      'menu_id' => 'Menu ID',
      'quantity' => 'Quantity',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  public function getMenu() {
    return $this->hasOne(Menu::class, ['id' => 'menu_id']);
  }

  public function getOrder() {
    return $this->hasOne(Orders::class, ['id' => 'order_id']);
  }

  public function addOrderItems(array $params): bool {
    $this->menu_id = $params['menu_id'];
    $this->order_id = $params['order_id'];
    $this->quantity = $params['quantity'];
    return $this->save();
  }

}
