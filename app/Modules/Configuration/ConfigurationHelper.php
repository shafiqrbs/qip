<?php

namespace App\Modules\Configuration;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\Route;
use App\Modules\Configuration\Models\Configuration;

use App;


class ConfigurationHelper
{
    public static function Language()
    {
        $data = Configuration::where('status','1')->where('id',1)->first();
        $language = $data->language;

        App::setLocale($language);
        session()->put('locale', $language);
//        dd($language,session()->get('locale'));
    }


}
