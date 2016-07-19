<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Author thuanth6589
 * Class City
 * @package App
 */
class Town extends Model
{
    protected $table = 'towns';
    protected $fields = ['city_id', 'district_id', 'name'];
    private $obj;

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

    public function getList($filter = [])
    {
        $query = DB::table($this->table)->select('towns.*', 'districts.name as district_name', 'cities.name as city_name');
        $query->leftJoin('districts', 'towns.district_id', '=', 'districts.id');
        $query->leftJoin('cities', 'towns.city_id', '=', 'cities.id');
        if (isset($filter['name']) && $filter['name']) {
            $query->where('towns.name', 'like', '%' . $filter['name'] . '%');
        }

        if (isset($filter['district_id']) && $filter['district_id']) {
            $query->where('towns.district_id', '=', $filter['district_id']);
        }

        if (isset($filter['city_id']) && $filter['city_id']) {
            $query->where('towns.city_id', '=', $filter['city_id']);
        }

        return $query->paginate(20);
    }

    public function getTownByDistrict($district_id)
    {
        $result = [];
        $tmp = Town::where('district_id', $district_id)->get(['id', 'name']);
        foreach ($tmp as $k => $v) {
            $result[$v->id] = $v->name;
        }
        return $result;
    }

}