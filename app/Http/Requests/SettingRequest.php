<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     *{
 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'site_name'=>['required' , 'string', 'min:2', 'max:60'],
            'email'=>['required', 'email'],
            'facebook'=>['required', 'string'],
            'twitter'=>['required', 'string'],
            'instagram'=>['required', 'string'],
            'youtube'=>['required', 'string'],
            'country'=>['required', 'string', 'max:30'],
            'city'=>['required', 'string', 'max:30'],
            'street'=>['required', 'string', 'max:70'],
            'phone'=>['required', 'numeric'],
            'small_desc'=>['required', 'string', 'max:160'],
            'logo'=>['nullable', 'image','mimes:jpg,jpeg,png,gif,webp' ],
            'favicon'=>['nullable', 'image','mimes:jpg,jpeg,png,gif,webp'],



            
        ];
    }
}
