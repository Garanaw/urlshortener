<?php declare(strict_types = 1);

namespace App\Http\Requests\Url;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'long_url' => [
                'required',
                'url'
            ],
            'keyword' => [
                'nullable',
                'string',
                'unique:urls,keyword'
            ],
            'private' => [
                'sometimes',
                'in:0,1'
            ],
            'description' => [
                'nullable',
                'string',
                'max:140'
            ]
        ];
    }
}
