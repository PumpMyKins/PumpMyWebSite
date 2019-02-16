<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateNews extends FormRequest
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

        $id = $this->route('news')->id;
        return [
            'title' => [
                'required',
                Rule::unique('news')->where('id', '<>', $id),
                'max:100',
            ],
            'content' => 'required',
            'tag_id' => 'required',
        ];
    }
}
