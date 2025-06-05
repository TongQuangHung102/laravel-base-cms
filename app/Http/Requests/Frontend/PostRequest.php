<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // max 2MB
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.string' => 'Tiêu đề phải là một chuỗi văn bản.',
            'title.max' => 'Tiêu đề không được vượt quá :max ký tự.',
            'content.required' => 'Nội dung không được để trống.',
            'content.string' => 'Nội dung phải là một chuỗi văn bản.',
            'thumbnail.image' => 'Ảnh đại diện phải là một tệp hình ảnh.',
            'thumbnail.mimes' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg, gif, svg.',
            'thumbnail.max' => 'Ảnh đại diện không được lớn hơn :max KB.',
        ];
    }
}
