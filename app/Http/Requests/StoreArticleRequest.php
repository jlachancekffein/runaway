<?php

namespace App\Http\Requests;

class StoreArticleRequest extends Request
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
        $rules = [
            'status' => 'required|in:draft,approved',
            'section' => 'required|in:blog,lookbook',
        ];

        foreach (config('app.available_locales') as $language) {
            $rules["$language.title"] = 'required';
            $rules["$language.image"] = 'required';
        }

        return $rules;
    }
}
