<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $creating = $this->isMethod('post');

        return [
            'name' => [$creating ? 'required' : 'sometimes', 'string', 'min:2', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'workload' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:65535'],
        ];
    }
}
