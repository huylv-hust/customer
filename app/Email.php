<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * Author thuanth6589
 * Class Email
 * @package App
 */
class Email extends Model
{
    protected $table = 'emails';
    private $result = [
        'success' => 0,
        'validate_error' => 1
    ];
    private $obj;
    private $field = array(
        'email',
    );

    public function setData($data = array(), $obj)
    {
        $validate = $this->validate($data);
        if(isset($validate['validator'])) {
            return [
                'status' => $this->result['validate_error'],
                'validator' => $validate['validator']
            ];
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
        if($id = $this->checkEmailExisted($this->obj->email)) {
            $this->obj->id = $id;
            return true;
        }
        return $this->obj->save();
    }

    public function validate($data) {
        $rules = array(
            'email' => 'required|email',
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

    public function checkEmailExisted($email)
    {
        $data = Email::where('email', $email)->first();
        if (!$data) {
            return false;
        }
        return $data->id;
    }
}