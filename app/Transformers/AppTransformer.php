<?php

namespace App\Transformers;

use Logaretm\Transformers\Transformer;

class AppTransformer extends Transformer
{

    /**
     * @param $item
     * @return mixed
     */
    public function getTransformation($item)
    {
        return [
            'mcm_id' => $item
        ];
    }
}