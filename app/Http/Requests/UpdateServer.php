<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateServer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        $id = $this->route('server')->id;
        return [
            'name' => ['required',
                       Rule::unique('servers')->where('id','<>',$id),
            ],
            'short_description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ip' => 'required',
            'description' => 'required',
            'open_date' => 'required|date',
        ];
    }
}
