<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TopicRequest extends Request
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
            'topic_title' => 'required',
            'topic_description' => 'required',
            'topic_post_text' => 'required',
            'topic_published_at' => 'required',
            'topic_download_url' => 'required',
            'forum_list' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'topic_title' => 'Title',
            'topic_description' => 'Short Description',
            'topic_post_text' => 'Description',
            'topic_published_at' => 'Date for Scheduled Publication',
            'topic_download_url' => 'Download URL ',
            'forum_list' => 'Sub-Categories',
        ];
    }

}
