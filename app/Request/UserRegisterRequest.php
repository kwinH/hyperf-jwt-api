<?php
/**
 * Project: hyperf-jwt-api.
 * Author: Kwin
 * QQ:284843370
 * Email:kwinwong@hotmail.com
 */

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mobile' => 'required',
            'password' => 'required'
        ];
    }


    public function messages(): array
    {
        return [
            'mobile.required' => '手机号必填',
            'password.required' => '密码必填',
        ];
    }
}