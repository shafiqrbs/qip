<?php

namespace App\Imports;

//use App\Modules\Fileimport\Models\Fileimport;
use App\Modules\Product\Models\ProductFile;
use App\Modules\MasterData\Models\Category;
use App\Modules\MasterData\Models\ProductBrand;
use App\Modules\MasterData\Models\Sizeunit;
use App\Modules\MasterData\Models\ItemUnit;
use Maatwebsite\Excel\Concerns\ToModel;

use Auth;
use Session;

class FileImportImort implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

    }
}
