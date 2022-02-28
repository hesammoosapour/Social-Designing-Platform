<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadingDesignPhotosRequest extends FormRequest
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
            'designer_id' =>  'required','min:1','integer','numeric',
            'tag_id'=>'integer','numeric','min:1'
        ];
    }
}