<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Topic;
use Twitter;
use File;
use Config;

class TopicTweet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'topic:tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tweet todays latest topics';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $topics = Topic::published()
            ->available()
            ->untweeted()
            ->select('topics.topic_id', 'topic_title', 'topic_cover', 'slug', 'topic_tweeted')
            ->orderBy('topic_published_at','desc')
            ->get();

        foreach ($topics as $topic) {
            $topic_title = $topic->topic_title;
            if ($topic->topic_cover) {
                $topic_title = (strlen($topic_title) > 92) ? substr($topic_title,0,89).'...' : $topic_title;
                // dd($topic_title);
                $uploaded_media = Twitter::uploadMedia(['media' => File::get(public_path('/'. Config::get('constants.image_path') .'/'. $topic->topic_cover))]);
                // dd($topic_title . ' ' . route('slug', ['slug' => $topic->slug . '-t' . $topic->topic_id . '.html']));
                $tweet = Twitter::postTweet([
                    'status' => $topic_title . ' ' . route('slug', ['slug' => $topic->slug . '-t' . $topic->topic_id . '.html']), 
                    'media_ids' => $uploaded_media->media_id_string, 
                    'format' => 'json'
                ]);
            } else {
                $topic_title = (strlen($topic_title) > 114) ? substr($topic_title,0,111).'...' : $topic_title;
                $tweet = Twitter::postTweet([
                    'status' => $topic_title . ' ' . route('slug', ['slug' => $topic->slug . '-t' . $topic->topic_id . '.html']), 
                    'format' => 'json'
                ]);
            }
            $topic->topic_tweeted = 1;
            $topic->save();
        }

        return;
    }
}
