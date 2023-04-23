<?php

declare(strict_types=1);

namespace app\forms;

use yii\base\Model;

class ChefsForm extends Model {

  public string $start;

  public string $end;

  public int $limit = 5;

  public function rules(): array {
    return [
      [['start', 'end'], 'required'],
      [['start', 'end'], 'date', 'format' => 'php:Y-m-d'],
      [['limit'], 'integer'],
      [['limit'], 'integer', 'max' => 100],
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