<?php

namespace App\Http\Requests;

use App\Library\Services\ArrValidMaker;
use Illuminate\Foundation\Http\FormRequest;

class StoreTest extends FormRequest
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
        $arrValidMaker = new ArrValidMaker();
        $arr = $arrValidMaker->doArr($this->request->all());
        return $arr;
    }
    public function messages()
    {
        $arrValidMaker = new ArrValidMaker();
        return $arrValidMaker->doMessages($this->request->all());
    }
}
