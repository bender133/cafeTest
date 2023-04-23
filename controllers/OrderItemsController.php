<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Menu;
use app\models\OrderItems;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class OrderItemsController extends Controller {

  /**
   * @throws \yii\base\Exception
   */
  public function actionPost() {

    $orderItems = new OrderItems();
    $orderItems->load(\Yii::$app->request->post(), '');

    if (!$orderItems->validate()) {
      throw new BadRequestHttpException('Invalid request parameters');
    }


    $menu = Menu::findOne($orderItems->menu_id);
    $transaction = Menu::getDb()->beginTransaction();

    if ($menu === null) {
      throw new BadRequestHttpException('Invalid request parameters');
    }

    try {
      if (!$menu->hasEnoughQuantity($orderItems->quantity)) {
        throw new \yii\base\Exception('An insufficient amount');
      }

      $menu->decreaseQuantity((int) $orderItems->quantity);

      if (!$orderItems->save($orderItems->attributes) || !$menu->save()) {
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