<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
// use BBCode;
use Purifier;

use App\Helpers\BBHelper;
use \Carbon\Carbon;
// use Decoda\Decoda;
// use JBBCode;
// use Thunder\Shortcode\ShortcodeFacade;
// use Thunder\Shortcode\Shortcode\ShortcodeInterface;
// use s9e\TextFormatter\Bundles\Forum as TextFormatter;
// use s93\TextFormatter\Configurator as Configurator;

class Topic extends Model
{
    protected $primaryKey = 'topic_id';

    protected $fillable = [
        'topic_title',
        // 'poster_id',
        // 'topic_views',
        'topic_description',
        'topic_post_edit_count',
        'topic_post_text',
        'topic_cover',
        'topic_ISBN10',
        'topic_ISBN13',
        'topic_pages',
        'publisher_id',
        'topic_download_url',
        'license_id',
        // 'topic_status',
        // 'topic_time',
        // 'topic_post_edit_time',
        'topic_publication_date',
        'topic_published_at',
        'topic_tweeted',
        'topic_status',
        'topic_tla',
        'slug',
    ];

    protected $dates = ['topic_published_at', 'topic_publication_date'];

    // protected $dates = [
    //     'created_at', 
    //     'updated_at', 
    //     'topic_time',
    //     'topic_post_edit_time',
    //     'topic_publication_date', 
    //     'topic_active_time'
    // ];

    // protected $dateFormat = 'U';

    //cleaning up
    public function setTopicTitleAttribute($value) {
        $this->attributes['topic_title'] = Purifier::clean($value);
    }

    public function setTopicDescriptionAttribute($value) {
        $this->attributes['topic_description'] = Purifier::clean($value);
    }

    public function setTopicISBN10Attribute($value) {
        // dd($value);
        $this->attributes['topic_ISBN10'] = Purifier::clean($value);
    }

    public function setTopicISBN13Attribute($value) {
        // dd($value);
        $this->attributes['topic_ISBN13'] = Purifier::clean($value);
    }

    public function setTopicPostTextAttribute($value) {
        $this->attributes['topic_post_text'] = Purifier::clean($value);
    }

    public function setTopicDownloadUrlAttribute($value) {
        $this->attributes['topic_download_url'] = Purifier::clean($value);
    }

    public function setTopicPublishedAtAttribute($date) {
        // dd(Carbon::parse($date));
        $this->attributes['topic_published_at'] = Carbon::parse($date);
    }

    public function setLicenseIdAttribute($value) {
        $this->attributes['license_id'] = trim($value) !== '' ? $value : null;
    }

    public function setPublisherIdAttribute($value) {
        $this->attributes['publisher_id'] = trim($value) !== '' ? $value : null;
    }

    public function scopePublished($query) {
        // if (Auth::check() && Auth::user()->isAdmin()) {
        //     return;
        // }
        if (Auth::check() && Auth::user()->isAdmin()) {
            // dd(Auth::user());
            return;
        }
        $query->where('topic_published_at', '<=', Carbon::now());
    }

    public function scopeAvailable($query) {
        // if (Auth::check() && Auth::user()->isAdmin()) {
        //     return;
        // }
        if (Auth::check() && Auth::user()->isAdmin()) {
            // dd(Auth::user());
            return;
        }
        $query->where('topic_status', '=', 1);
    }

    public function scopeTweeted($query) {
        $query->where('topic_tweeted', '=', 1);
    }

    public function scopeUntweeted($query) {
        $query->where('topic_tweeted', '=', 0);
    }

    public function scopeUnpublished($query) {
        $query->where('topic_published_at', '>', Carbon::now());
    }

    public function getTopicPublishedStatusAttribute() {
        if ($this->topic_published_at > Carbon::now()) {
            // dd($this->topic_published_at);
            return "Unpublished";
        } else {
            // dd($this->topic_published_at);
            return "Published";
        }
    }

    public function getTopicViewsFormattedAttribute() {
        return number_format($this->topic_views);
    }

    public function getTopicPublicationDateFormattedAttribute() {
        if ($this->topic_publication_date) {
            return $this->topic_publication_date->format('d M Y');
        }
    }

    public function getTopicPublishedAtFormattedAttribute() {
        if ($this->topic_published_at) {
            return $this->topic_published_at->format('d M Y h:i:s');
        }
    }

    public function getCreatedAtFormattedAttribute() {
        if ($this->created_at) {
            return $this->created_at->format('d M Y h:i:s');
        }
    }

    public function getUpdatedAtFormattedAttribute() {
        if ($this->updated_at) {
            return $this->updated_at->format('d M Y h:i:s');
        }
    }

    public function getTopicPostTextHtmlAttribute() {
        // $configurator = new \s9e\TextFormatter\Configurator;
        // $configurator->BBCodes->addCustom(
        //     '[quote={ANYTHING}]{TEXT}[/quote]',
        //     '<blockquote><small>{ANYTHING}</small>{TEXT}</blockquote>'
        // );
        // // Get an instance of the parser and the renderer
        // extract($configurator->finalize());

        // Original text
        // $text = "Hello, [i]world[/i] :)\nFind more examples in the [url=https://github.com/s9e/TextFormatter/tree/master/docs/Cookbook]Cookbook[/url].";
        // XML representation, that's what you should store in your database
        // $xml  = TextFormatter::parse($this->topic_post_text);
        // // HTML rendering, that's what you display to the user
        // $html = TextFormatter::render($xml, [
        //     'L_WROTE'   => 'wrote: '
        // ]);
        // return $html;

       // $facade = new ShortcodeFacade();
        // $facade->addHandler('hello', function(ShortcodeInterface $s) {
        //     return sprintf('Hello, %s!', $s->getParameter('name'));
        // });

        // $text = '
        //     <div class="user">[hello name="Thomas"]</div>
        //     <p>Your shortcodes are very good, keep it up!</p>
        //     <div class="user">[hello name="Peter"]</div>
        // ';
        // return $facade->process($this->topic_post_text);

        // $parser = new JBBCode\Parser();
        // $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
        // $parser->addBBCode("quote", '<pre class="code">{param}</pre>', false, false, 1);

        // // $text = "The default codes include: [b]bold[/b], [i]italics[/i], [u]underlining[/u], ";
        // // $text .= "[url=http://jbbcode.com]links[/url], [color=red]color![/color] and more.";

        // $parser->parse(nl2br($this->topic_post_text));

        // return $parser->getAsHtml();

        // $code = new Decoda($this->topic_post_text);
        // $code->defaults();
        // // Or load filters and hooks
        // return $code->parse();        

        // return BBCode::parse($this->topic_post_text);
        // return BBHelper::bb2html($this->topic_post_text, $this->topic_bbcode_uid);
        return BBHelper::phpbb2html(trim($this->topic_post_text));
    }

    public function getTopicTlaHtmlAttribute() {
        return BBHelper::phpbb2html(trim($this->topic_tla));
    }


    // public function getDates() {
    //     return [
    //         'created_at', 
    //         'updated_at', 
    //         'topic_time',
    //         'topic_post_edit_time',
    //         'topic_publication_date', 
    //         'topic_active_time'
    //     ];
    // }
    
    // public function getTopicActiveTimeAttribute($value) {
    //     return date("Y-m-d H:i:s", $value);
    // }

    // public function setTopicActiveTimeAttribute($value) {
    //     $this->attributes['topic_active_time'] = strtotime($value);
    // }

    // public function getTopicPostEditTimeAttribute($value) {
    //     return date("Y-m-d H:i:s", $value);
    // }

    // public function setTopicPostEditTimeAttribute($value) {
    //     // dd($value);
    //     $this->attributes['topic_post_edit_time'] = strtotime($value);
    //     // dd($this->attributes['topic_active_time']);
    //     // $this->attributes['topic_post_edit_time'] = strtotime(date("Y-m-d H:i:s"));
    // }


    // public function setTopicTimeAttribute($value) {
    //     $this->attributes['topic_time'] = Carbon::createFromFormat('U', $value);
    // }

    // public function setTopicPostEditTimeAttribute($value) {
    //     $this->attributes['topic_post_edit_time'] = Carbon::now()->timestamp;
    //     // $this->attributes['topic_post_edit_time'] = Carbon::now();
    // }


    public function forums() {
    	return $this->belongsToMany('App\Forum')->withTimestamps();
    }

    public function getForumListAttribute() {
        return $this->forums->lists('forum_id')->toArray();
    }

    public function authors() {
    	return $this->belongsToMany('App\Author')->withTimestamps();
    }

    public function getAuthorListAttribute() {
        return $this->authors->lists('author_id')->toArray();
    }

    public function license() {
        return $this->belongsTo('App\License', 'license_id', 'license_id');
    }

    public function publisher() {
        return $this->belongsTo('App\Publisher', 'publisher_id', 'publisher_id');
    }

    public static function show($slug, $topic_id)
    {
        $topic = Topic::where([['slug', $slug], ['topic_id', $topic_id]])->firstOrFail();
        $topic->increment('topic_views');
        return $topic;
    }

}
