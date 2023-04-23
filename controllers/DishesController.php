<?php

declare(strict_types=1);


namespace app\controllers;

use yii\rest\ActiveController;

class DishesController extends ActiveController {

  public $modelClass = 'app\models\Dishes';

}