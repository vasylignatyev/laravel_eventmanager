<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * @param $attrArray array
     * @return BaseModel
     */
    public function setAttrs(array $attrArray)
    {
        foreach ($attrArray as $key => $value)
        {
            if ($value) {
                $this->setAttribute($key, $value);
            }
        }
        return $this;
    }
}
