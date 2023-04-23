<?php

declare(strict_types=1);

namespace app\controllers;

use app\forms\ChefsForm;
use app\models\Chefs;
use app\models\Orders;
use Yii;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class ChefsController extends Controller {

  public function actionPopular() {
    $form = new ChefsForm();
    $form->load(['ChefsForm' => Yii::$app->request->get()]);

    if (!$form->validate()) {
      throw new BadRequestHttpException('Invalid request parameters');
    }

    $query = Chefs::find()
      ->select([
        'chefs.id',
        'chefs.name',
        'SUM(order_items.quantity) as total_orders',
      ])
      ->from('order_items')
      ->join('JOIN', 'orders', 'order_items.order_id = orders.id')
      ->join('JOIN', 'menu', 'order_items.menu_id = menu.id')
      ->join('JOIN', 'chefs', 'menu.chef_id = chefs.id')
      ->where([
        'orders.status' => Orders::CONFIRMED,
      ])
      ->andWhere([
        'between',
        'orders.updated_at',
        $form->start,
        $form->end,
      ])
      ->groupBy([
        'chefs.id',
        'chefs.name',
      ])
      ->orderBy(['total_orders' => SORT_DESC])
      ->limit($form->limit);

    return $query->asArray()->all();
  }

}
