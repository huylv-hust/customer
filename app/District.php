<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Author thuanth6589
 * Class City
 * @package App
 */
class District extends Model
{
    protected $table = 'districts';

    public function getDistrict($city_id)
    {
        $result = [];
        $tmp = District::where('city_id', $city_id)->get(['id','name']);
        foreach ($tmp as $k => $v) {
            $result[$v->id] = $v->name;
        }
        return $result;
    }
}