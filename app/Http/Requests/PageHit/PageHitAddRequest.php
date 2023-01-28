<?php

namespace App\Http\Requests\PageHit;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class PageHitAddRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ip_address' => [
                'nullable',
                'string',
                'ip',
            ],
            'page_id' => [
                'required',
                'numeric',
            ],
            'visited_at' => [
                'required',
                'date',
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $default_values = [
            'visited_at' => new Carbon('now'),
            'ip_address' => $this->ip(),
        ];
        $this->merge($default_values);
    }

}
