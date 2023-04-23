<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQueryInterface;
use yii\db\ActiveRecord;

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
class Orders extends ActiveRecord {

  public const CREATED = 0;

  public const CONFIRMED = 1;

  public const CANCELED = 2;

  /**
   * {@inheritdoc}
   */
  public static function tableName(): string {
    return 'orders';
  }

  /**
   * {@inheritdoc}
   */
  public function rules(): array {
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
  public function attributeLabels(): array {
    return [
      'id' => 'ID',
      'name' => 'Name',
      'user' => 'User',
      'status' => '0 - создан, 2 - исполнен, 3 - отменен',
      'updated_at' => 'Updated At',
      'created_at' => 'Created At',
    ];
  }

  public function getOrderItems(): ActiveQueryInterface {
    return $this->hasMany(OrderItems::class, ['order_id' => 'id']);
  }

}
