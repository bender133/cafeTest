<?php

declare(strict_types=1);

namespace app\controllers;

use app\forms\OrderItemsForm;
use app\models\Menu;
use app\models\OrderItems;
use yii\web\BadRequestHttpException;

class OrderItemsController extends \yii\rest\ActiveController {

  public $modelClass = 'app\models\OrderItems';

  /**
   * @throws \yii\base\Exception
   */
  public function actionPost() {

    $itemsForm = new OrderItemsForm();
    $itemsForm->load(['OrderItemsForm' => \Yii::$app->request->post()]);

    if (!$itemsForm->validate()) {
      throw new BadRequestHttpException('Invalid request parameters');
    }

    $orderItems = new OrderItems();
    $menu = Menu::findOne($itemsForm->menu_id);
    $transaction = Menu::getDb()->beginTransaction();

    if ($menu === null) {
      throw new BadRequestHttpException('Invalid request parameters');
    }

    try {
      if (!$menu->hasEnoughQuantity($itemsForm->quantity)) {
        throw new \yii\base\Exception('An insufficient amount');
      }

      if (!$orderItems->addOrderItems($itemsForm->attributes) || !$menu->decreaseQuantity((int) $itemsForm->quantity)) {
        throw new \yii\base\Exception('Invalid data');
      }

      $transaction?->commit();
      return $orderItems;

    } catch (\Exception $e) {
      $transaction?->rollBack();
      throw $e;
    }
  }

}