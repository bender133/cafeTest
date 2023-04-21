<?php

declare(strict_types=1);

namespace app\forms;

use yii\base\Model;

class ChefsForm extends Model {

  public $start;

  public $end;

  public $limit;

  public function rules() {
    return [
      [['start', 'end'], 'required'],
      [['start', 'end'], 'date', 'format' => 'php:Y-m-d'],
      [['limit'], 'integer'],
      [
        ['end'],
        'compare',
        'compareAttribute' => 'start',
        'operator' => '>',
        'message' => 'End date should be greater than start date',
      ],
    ];
  }

}