<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;/*身分驗證通常為TRUE*/
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()/*欄位規則*/
    {
        return [
        'title' => 'required',/*required表示必須有值 num表示必須為數字*/
        'content' => 'required',
        'files.*' => 'nullable|mimes:jpeg,bmp,png,pdf,odt|max:5120',

            
        ];
    }

    public function attributes()//中文化
    {
    return [
        'title' => '標題',
        'content' => '內容',
    ];
    }

    public function messages()//顯示錯誤訊息的內容
    {
    return [
        'title.required' => ':attribute 不可空白',
        'content.required' => ':attribute 不可空白',
    ];
    }

    }
