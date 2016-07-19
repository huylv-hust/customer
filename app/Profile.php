<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Author thuanth6589
 * Class Profile
 * @package App
 */
class Profile extends Model
{
    use SoftDeletes;
    protected $table = 'profiles';
    protected $dates = ['deleted_at'];
    private $field = array(
        'email_id',
        'firstname',
        'lastname',
        'address_1',
        'address_2',
        'address_3',
        'address_4',
        'tel',
        'card_number',
        'postcode',
        'birth',
        'gender',
        'status'
    );
    private $result = [
        'success' => 0,
        'validate_error' => 1
    ];
    private $obj;

    public function getNameAttribute()
    {
        return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }
    public function getAddressAttribute()
    {
        $address_1 = '';
        if($this->attributes['address_1']) {
            $tmp = City::find($this->attributes['address_1']);
            $address_1 = $tmp->name;
        }
        $address_2 = '';
        if($this->attributes['address_2']) {
            $tmp = District::find($this->attributes['address_2']);
            $address_2 = $tmp->name . ', ';
        }
        $address_3 = ($this->attributes['address_3'] ? $this->attributes['address_3'] . ', ' : '');
        $address = $address_3 . $address_2 . $address_1;
        return $address;
    }
    protected $appends = ['name','address'];

    public function setData($data = array(), $obj, $action = '')
    {
        $validate = $this->validate($data);
        if (isset($validate['validator'])) {
            return [
                'status' => $this->result['validate_error'],
                'validator' => $validate['validator']
            ];
        }

        if (!$action)
        {
            if ($id = $this->checkCardNumberExisted($data['card_number'], $data['email_id'])) {
                $this->obj = Profile::find($id);
                $this->obj->delete();
            }
        }

        $this->obj = $obj;
        $data['status'] = 1;
        foreach ($this->field as $k => $v) {
            $this->obj->$v = (isset($data[$v]) && $data[$v] !== '') ? trim($data[$v]) : null;
        }
        return [
            'status' => $this->result['success']
        ];
    }

    public function saveData()
    {
        return $this->obj->save();
    }

    public function validate($data)
    {
        $rules = array(
            'firstname' => 'required|max:25',
            'lastname' => 'required|max:25',
            'address_1' => 'required|integer',
            'address_3' => 'max:255',
            'tel' => 'required|max:20|regex:/^[0-9]+$/',
            'card_number' => 'required|max:20|alpha_num',
            'postcode' => 'max:10|regex:/^[0-9]+$/',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return [
                'status' => $this->result['validate_error'],
                'validator' => $validator
            ];
        }
        return [
            'status' => $this->result['success']
        ];
    }

    public function checkCardNumberExisted($card_number, $email_id)
    {
        $data = Profile::where('card_number', $card_number)->where('email_id', $email_id)->first();
        if (!$data) {
            return false;
        }
        return $data->id;
    }

    public function getList($filter = [])
    {
        $query = DB::table($this->table)->select('profiles.*', 'emails.email', 'districts.name as district_name', 'cities.name as city_name');
        $query->leftJoin('emails', 'profiles.email_id', '=', 'emails.id');
        $query->leftJoin('districts', 'profiles.address_2', '=', 'districts.id');
        $query->leftJoin('cities', 'profiles.address_1', '=', 'cities.id');
        if(isset($filter['card_number']) && $filter['card_number'])
        {
            $query->where('card_number', 'like', '%'.$filter['card_number'].'%');
        }

        if(isset($filter['start_date']) && $filter['start_date'])
        {
            $query->where('profiles.created_at', '>=', date('Y-m-d 00:00:00',strtotime($filter['start_date'])));
        }

        if(isset($filter['end_date']) && $filter['end_date'])
        {
            $query->where('profiles.created_at', '<=', date('Y-m-d 23:59:59', strtotime($filter['end_date'])));
        }

        $query->where('profiles.deleted_at', null);

        return $query->paginate(20);
    }
}