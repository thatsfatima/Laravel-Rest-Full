<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateArticleStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'article' => 'required|array|min:1',
            'article.*.id' => 'required|integer',
            'article.*.quantite' => 'required|integer|min:1',
        ];
    }
}
