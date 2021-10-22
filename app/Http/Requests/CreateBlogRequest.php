<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateBlogRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

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
            'title' => ['required', 'min:3', 'max:254'],
            'slug' => ['unique:blog_blogs,slug'],
            'tags' => ['required'],
        ];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function messages()
    {
        return [
            'title.required' => 'A valid title is required!',
            'title.min' => 'A valid title is required!',
            'title.max' => 'Title must be under 255 characters!',
            'slug.unique' => 'This title has already been used!',
            'tags.required' => 'Specify at least one tag!',
        ];
    }
}
