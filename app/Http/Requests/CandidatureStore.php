<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidatureStore extends FormRequest
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
        return [
            'rules' => 'bail|required|accepted',
            'type' => 'required|string|max:20',
            'prenom' => 'required|string|max:30',
            'age' => 'required|integer',
            'horaire' => 'required|string|max:255',
            'motivation' => 'required|string|max:200',
            'anciennete' => 'required|string|max:200',
            'presentation' => 'required|string|between:100,500',
            'sanction' => 'required|string|max:200',

        ];
    }
}
