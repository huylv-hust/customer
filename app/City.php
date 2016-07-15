<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Author thuanth6589
 * Class City
 * @package App
 */
class City extends Model
{
    protected $table = 'cities';
    protected $fields = ['name'];
    private $obj;

    public function getAllCity()
    {
        $tmp = City::all();
        $result[''] = " --- Select City --- ";
        foreach ($tmp as $k => $v) {
            $result[$v->id] = $v->name;
        }
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

    public function getList($filter = [])
    {
        $query = DB::table($this->table);
        if(isset($filter['name']) && $filter['name'])
        {
            $query->where('name', 'like', '%'.$filter['name'].'%');
        }

        return $query->paginate(20);
    }

}