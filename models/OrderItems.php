<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

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
class OrderItems extends ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName(): string {
    return 'order_items';
  }

  /**
   * {@inheritdoc}
   */
  public function rules(): array {
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
  public function attributeLabels(): array {
    return [
      'id' => 'ID',
      'order_id' => 'Order ID',
      'menu_id' => 'Menu ID',
      'quantity' => 'Quantity',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ];
  }

  public function getMenu(): ActiveQueryInterface {
    return $this->hasOne(Menu::class, ['id' => 'menu_id']);
  }

  public function getOrder(): ActiveQueryInterface {
    return $this->hasOne(Orders::class, ['id' => 'order_id']);
  }

}
