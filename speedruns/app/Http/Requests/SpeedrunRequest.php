<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeedrunRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'game_id' => 'required|exists:games,id',
            'category_id' => 'required|exists:categories,id',
            'run_time' => [
                'required',
                'regex:/^\d{1,2}:[0-5][0-9]:[0-5][0-9]$/',
            ],
            'video_url' => 'nullable|url',
            'date' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
        ];
    }

}
