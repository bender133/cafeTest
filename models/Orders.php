<?php

declare(strict_types=1);

namespace app\models;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $name
 * @property string $user
 * @property int $status 0 - создан, 2 - исполнен, 3 - отменен
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property OrderItems[] $orderItems
 */
class Orders extends \yii\db\ActiveRecord {

  public const CREATED = 0;

  public const CONFIRMED = 1;

  public const CANCELED = 2;

  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'orders';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['name', 'user'], 'required'],
      [['status'], 'integer'],
      [['updated_at', 'created_at'], 'safe'],
      [['name', 'user'], 'string', 'max' => 32],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'name' => 'Name',
      'user' => 'User',
      'status' => '0 - создан, 2 - исполнен, 3 - отменен',
      'updated_at' => 'Updated At',
      'created_at' => 'Created At',
    ];
  }

  public function getOrderItems() {
    return $this->hasMany(OrderItems::class, ['order_id' => 'id']);
  }

  public function confirmOrder(int $orderId) {
    $order = self::findOne($orderId);
    if ($order !== null) {
      $order->status = self::CONFIRMED;
      return $order->save();
    }

    throw new \yii\web\NotFoundHttpException('Order not found');
  }

}
