<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreProjectRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:projects',
            'slug' => 'string',
            'description' => 'string|required',
            'project_url' => 'url:http,https|required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'is_published' => 'string|required',
            'type_id' => 'string|nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Il campo titolo è obbligatorio',
            'description.required' => 'Il campo decsrizione è obbligatorio',
            'project_url.required' => 'Il campo url progetto è obbligatorio',
            'image.image' => 'il file inserito non è un\'immagine',
            'type_id.exists' => 'Tipologia non valida',
            'technologies.exists' => 'Tecnologia errata',
        ];
    }
}
