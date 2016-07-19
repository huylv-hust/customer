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
	protected $fields = ['city_id','name'];
	private $obj;

    public function getDistrict($filter = [])
    {
        $query = DB::table($this->table);

		if(isset($filter['city_id']) && $filter['city_id']) {
            $query->where('city_id', '=', $filter['city_id']);
        }

		if(isset($filter['name']) && $filter['name']) {
            $query->where('name', 'like', '%'.$filter['name'].'%');
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


}