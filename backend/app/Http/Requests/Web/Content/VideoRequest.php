<?php

namespace App\Http\Requests\Web\Content;

use App\Http\Requests\BaseFormRequest;

class VideoRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function store()
    {
        return [
            'category_id' => 'required|integer',
            'title.uz' => 'required|string|max:255',
            'title.*' => ['nullable','string','max:255'],
            'description.*' => ['nullable','string','max:255'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video' => 'required|file|mimes:mp4|max:307200',
        ];
    }

    public function update()
    {
        return [
            'category_id' => 'required|integer',
            'title.uz' => 'required|string|max:255',
            'title.*' => ['nullable','string','max:255'],
            'description.*' => ['nullable','string','max:255'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            // 'video' => 'required|file|mimes:mp4|max:307200',
            'status' => 'required|integer',
        ];
    }
}
