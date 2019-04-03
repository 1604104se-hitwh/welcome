<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginPost extends FormRequest
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
        /**如果未通过验证规则，则会自动重定向到之前的位置；
         * 但如果时ajax则会生成一个json响应
         * 所有的验证错误信息会被自动存储到session中；
         * 如果不想验证程序将null视为无效，添加nullable
         */
        return [
            'loginType' => 'bail|required|string',
            'examId' => 'bail|required|string|unique:posts|max:255',
            'perId' => 'bail|required|string',
        ];
    }
}
