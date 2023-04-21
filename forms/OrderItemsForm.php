<?php

declare(strict_types=1);

namespace app\forms;

use app\models\Menu;
use app\models\Orders;
use Yii;
use yii\base\Model;

class OrderItemsForm extends Model {

  public $order_id;

  public $menu_id;

  public $quantity;

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['order_id', 'menu_id', 'quantity'], 'required'],
      [['order_id', 'menu_id', 'quantity'], 'integer'],
      //      [ можно так провалидировать
      //        'quantity',
      //        function ($attribute) {
      //          $menu = Menu::findOne($this->menu_id);
      //          if (!$menu->hasEnoughQuantity($this->quantity)) {
      //            $this->addError($attribute, 'Not enough items');
      //          }
      //        },
      //      ],
      [
        ['order_id'],
        'exist',
        'skipOnError' => true,
        'targetClass' => Orders::class,
        'targetAttribute' => ['order_id' => 'id'],
      ],
      [
        ['menu_id'],
        'exist',
        'skipOnError' => true,
        'targetClass' => Menu::class,
        'targetAttribute' => ['menu_id' => 'id'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'order_id' => 'Order ID',
      'menu_id' => 'Menu ID',
      'quantity' => 'Quantity',
    ];
  }

}
