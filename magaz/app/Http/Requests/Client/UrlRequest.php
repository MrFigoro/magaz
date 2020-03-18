<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UrlRequest extends FormRequest
{
	public function rules()
	{
		return [
			'url' => 'required|url|max:255',
		];
	}
}