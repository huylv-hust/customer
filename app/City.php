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

    public function convert_utf8($file)
    {
        $data = file_get_contents($file);
        if (substr($data, 0, 3) == "\xEF\xBB\xBF") {
            $data = str_replace("\xEF\xBB\xBF",'',$data);
        }
        if(mb_detect_encoding($data,'UTF-8',true) === false)
        {
            $encode_ary = array(
                'ASCII',
                'JIS',
                'eucjp-win',
                'sjis-win',
                'EUC-JP',
                'UTF-8',
            );
            $data = mb_convert_encoding($data,'UTF-8',$encode_ary);
        }

        $fp = tmpfile();
        fwrite($fp,$data);
        rewind($fp);
        return $fp;
    }
    
    public function importCsv($file)
    {
        DB::beginTransaction();
        try {
            $city_inserted = [];
            $district_inserted = [];
            $town_inserted = [];

            $delete_district = DB::table('districts')->delete();
            $delete_city = DB::table('cities')->delete();
            $delete_town = DB::table('towns')->delete();

            if (!(isset($delete_city) && isset($delete_district) && isset($delete_town))) {
                DB::rollBack();
                return false;
            }

            $file = $this->convert_utf8($file);
            $title = fgetcsv($file);

            if ($title[0] == 'City' && $title[1] == 'District' && $title[2] == 'Town') {
                while(($info = fgetcsv($file, 10000, ',')) !== false) {
                    $city = new City();
                    $district = new District();
                    $town = new Town();

                    if (!in_array($info[0], $city_inserted)) {
                        $city->setData(['name' => $info[0]], $city);
                        $city->saveData();
                        $city_inserted [$city->id] = $info[0];
                    }

                    if ((isset($district_inserted[$info[0]]) && !in_array($info[1], $district_inserted[$info[0]])) || !isset($district_inserted[$info[0]])) {
                        $city_id = array_search($info[0],$city_inserted);
                        $district->setData(['name' => $info[1], 'city_id' => $city_id], $district);
                        $district->saveData();
                        $district_inserted[$info[0]][$district->id] = $info[1];
                    }

                    if ($info[2] && (!isset($town_inserted[$info[0]]) || !isset($town_inserted[$info[0]][$info[1]]) || !in_array($info[2], $town_inserted[$info[0]][$info[1]]))) {
                        $city_id = array_search($info[0],$city_inserted);
                        $district_id = array_search($info[1],$district_inserted[$info[0]]);
                        $town->setData(['name' => $info[2], 'city_id' => $city_id, 'district_id' => $district_id], $town);
                        if(!$town->saveData()) {
                            DB::rollBack();
                            return false;
                        }
                        $town_inserted[$info[0]][$info[1]][$town->id] = $info[2];
                    }
                }
                DB::commit();
                return true;
            }

            return false;
        } catch(\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

}