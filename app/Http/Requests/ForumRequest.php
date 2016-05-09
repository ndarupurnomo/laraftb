<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ForumRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'forum_name' => 'required',
            'forum_desc' => 'required',
            'forum_order' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'forum_name' => 'Sub-Category Name',
            'forum_desc' => 'Description',
            'forum_order' => 'Order',
        ];
    }

}
