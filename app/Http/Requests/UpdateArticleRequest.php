<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateArticleRequest extends Request
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
            //
        ];
    }

    public function allFiles()
    {
        $files = parent::allFiles();

        return $this->removeEmptyValueFromArray($files);
    }

    private function removeEmptyValueFromArray($array)
    {
        return array_dot_reverse(array_filter(array_dot($array)));
    }
}
