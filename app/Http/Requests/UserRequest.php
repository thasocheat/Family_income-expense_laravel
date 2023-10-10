<?php

namespace App\Http\Requests;

use App\Helpers\Qs;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    protected $user;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $store =  [
            'name' => 'required|string|min:6|max:150',
            'password' => 'required|string|min:3|max:50',
            'user_type' => 'required',
            'dob' => 'required',
            'gender' => 'required|string',
            'phone' => 'sometimes|nullable|string|min:6|max:20',
            'email' => 'required|nullable|email|max:100|unique:users',
            'username' => 'required|nullable|string|min:6|max:150|unique:users',
            'photo' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
            'address' => 'required|string|min:6|max:120',
        ];
        $update =  [
            'name' => 'required|string|min:6|max:150',
            'gender' => 'required|string',
            'dob' => 'required',
            'phone' => 'sometimes|nullable|string|min:6|max:20',
            'phone2' => 'sometimes|nullable|string|min:6|max:20',
            'email' => 'sometimes|nullable|email|max:100|unique:users,id,'.$this->user,
            // 'email' => [
            //     'sometimes',
            //     'nullable',
            //     'alpha_dash',
            //     'max:100,'
            //     .$this->user,
            //     Rule::unique('users')->ignore($this->route('id')),
            //     // 'unique:users,email'
            // ],
            'username' => 'sometimes|nullable|string|min:3|max:150|unique:users,username,' . $this->route('id'),

            'photo' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
            'address' => 'required|string|min:6|max:120',
        ];
        return ($this->method() === 'POST') ? $store : $update;
    }


    protected function getValidatorInstance()
    {
        if($this->method() === 'POST'){
            $input = $this->all();

            $input['user_type'] = Qs::decodeHash($input['user_type']);

            $this->getInputSource()->replace($input);

        }

        if($this->method() === 'PUT'){
            $id = $this->route('id');
            $this->user = Qs::decodeHash($id);
        }

        return parent::getValidatorInstance();

    }
}
