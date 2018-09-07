<?php

namespace App\Modules\Articles\Requests;

use App\Modules\Base\BaseFormRequest;

class CreateArticleRequest extends BaseFormRequest
{ 
    /**
     * Transform the error message into JSON
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $errors)
    {
        return response()->json($errors, 422);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required','min:10'],
            'content' => ['required', 'min:10'],
            'thumb'=>['required', 'file', 'image:png,jpeg,jpg,gif']
        ];
    }
}
