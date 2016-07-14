<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Author thuanth6589
 * Class City
 * @package App
 */
class City extends Model
{
    protected $table = 'cities';

    public function getAllCity()
    {
        $tmp = City::all();
        $result[''] = " --- Select City --- ";
        foreach ($tmp as $k => $v) {
            $result[$v->id] = $v->name;
        }
        return $result;
    }
}