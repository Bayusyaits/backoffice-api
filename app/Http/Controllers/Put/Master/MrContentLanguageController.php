<?php

namespace App\Http\Controllers\Put\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\MrContentLanguage;

//use dingo

use Dingo\Api\Routing\Helpers;

use App\Transformers\AppTransformer;
use Response;
use \Illuminate\Http\Response as Res;


class MrContentLanguageController extends Res
{
    //
    public function __construct() {

    }

    use Helpers;
}
