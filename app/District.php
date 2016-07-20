<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Author thuanth6589
 * Class City
 * @package App
 */
class District extends Model
{
    protected $table = 'districts';
    protected $fields = ['city_id', 'name'];
    private $obj;

    public function getDistrict($filter = [])
    {
        $query = DB::table($this->table)->select('districts.*', 'cities.name as city_name');
        $query->leftJoin('cities', 'cities.id', '=', 'districts.city_id');

        if (isset($filter['city_id']) && $filter['city_id']) {
            $query->where('districts.city_id', '=', $filter['city_id']);
        }

        if (isset($filter['name']) && $filter['name']) {
            $query->where('districts.name', 'like', '%' . $filter['name'] . '%');
        }

        return $query->paginate(20);

        return $result;
    }

    public function setData($data = array(), $obj)
    {
        $this->obj = $obj;
        foreach ($this->fields as $k => $v) {
            $this->obj->$v = isset($data[$v]) && $data[$v] !== '' ? trim($data[$v]) : null;
        }
    }

    public function saveData()
    {
        return $this->obj->save();
    }

    public function getDistricts($city_id)
    {
        $result = [];
        $tmp = District::where('city_id', $city_id)->get(['id', 'name']);
        foreach ($tmp as $k => $v) {
            $result[$v->id] = $v->name;
        }
        return $result;
    }
}