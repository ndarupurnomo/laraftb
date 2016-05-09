<?php 

namespace App\Helpers;

use Illuminate\Http\Request;
use Session;
use \Config as Config;

class BBHelper
{
	static function bb2html($text, $bbcode_uid)
	{
		// (please do not remove credit)
		// original author: Louai Munajim
		// website: http://elouai.com
		// date: 2004/Apr/18
		// minor update by Ndaru on 2016-02-26
		$bbcode = array("<", ">",
			"[list]", "[*]", "[/list]",
			"[img]", "[/img]",
			"[b]", "[/b]",
			"[u]", "[/u]",
			"[i]", "[/i]",
			'[color="', "[/color]",
			"[size=\"", "[/size]",
			"[url=", "[url=\"", "[/url]",
			"[url]",
			"[mail=\"", "[/mail]",
			"[code]", "[/code]",
			// "[quote=\"", 
			"[quote=", "[quote=\"", "[/quote]",
			"[quote]",
			"\"]", "]");
		$htmlcode = array("&lt;", "&gt;",
			"<ul>", "<li>", "</ul>",
			"<img src=\"", "\">",
			"<b>", "</b>",
			"<u>", "</u>",
			"<i>", "</i>",
			"<span style=\"color:", "</span>",
			"<span style=\"font-size:", "</span>",
			"<a href=\"", "<a href=\"", "</a>",
			"<a href=\"",
			"<a href=\"mailto:", "</a>",
			"<code>", "</code>",
			// "<table width=100% bgcolor=lightgray><tr><td bgcolor=white>", 
			"<blockquote>", "<blockquote>", "</blockquote>",
			"<blockquote>",
			"\">", "\">");
		$newtext = str_replace(':'.$bbcode_uid, '', $text);
		$newtext = str_replace($bbcode, $htmlcode, $newtext);
		$newtext = nl2br($newtext); //second pass
		return $newtext;
	}

	static function uploadFile(Request $request, $file_input) {
		$fileName = '';
        if ($request->hasFile($file_input)) {
            if ($request->file($file_input)->isValid()) {
                $fileName = time() . '-' . $request->file($file_input)->getClientOriginalName();
                $request->file($file_input)->move(Config::get('constants.image_path'), $fileName);
                return $fileName;
            }
            else {
                Session::flash('error', 'uploaded file is not valid');
                return redirect()->back();
            }
        }		
	}

	static function phpbb2html($Text)
	{
	    // Replace any html brackets with HTML Entities to prevent executing HTML or script
	    // Don't use strip_tags here because it breaks [url] search by replacing & with amp
	    $Text = str_replace("<", "&lt;", $Text);
	    $Text = str_replace(">", "&gt;", $Text);


	    // Set up the parameters for a URL search string
	    $URLSearchString = ' a-zA-Z0-9\:\/\-\?\&\,\.\=\_\~\#\'\"';
	    // Set up the parameters for a MAIL search string
	    $MAILSearchString = $URLSearchString . " a-zA-Z0-9\.@";

	    //Non BB URL Search
	    //$Text = eregi_replace("([[:alnum:]]+)://([^[:space:]]*)([[:alnum:]#?/&=])", "<a href=\"\\1://\\2\\3\" target=\"_blank\" target=\"_new\">\\1://\\2\\3</a>", $Text);
	    //$Text = eregi_replace("(([a-z0-9_]|\\-|\\.)+@([^[:space:]]*)([[:alnum:]-]))", "<a href=\"mailto:\\1\" target=\"_new\">\\1</a>", $Text);
	    if (substr($Text, 0, 7) == "http://") {
	        $Text = eregi_replace("([[:alnum:]]+)://([^[:space:]]*)([[:alnum:]#?/&=])",
	            "<a href=\"\\1://\\2\\3\">\\1://\\2\\3</a>", $Text);
	        // Convert new line chars to html <br /> tags
	        $Text = nl2br($Text);
	    } else {
	        // Perform URL Search
	        $Text = preg_replace("/\[url\]([$URLSearchString]*)\[\/url\]/",
	            '<a href="$1" target="_blank">$1</a>', $Text);
	        // $Text = preg_replace("(\[url\=([$URLSearchString]*)\](.+?)\[/url\])",
	        $Text = preg_replace("(\[url\=(.+?)\](.+?)\[/url\])",
	            '<a href="$1" target="_blank">$2</a>', $Text);
	        // $Text = preg_replace("(\[url\=([$URLSearchString]*)\]([$URLSearchString]*)\[/url\])", '<a href="$1" target="_blank">$2</a>', $Text);
	        // Convert new line chars to html <br /> tags
	        $Text = nl2br($Text);
	    }
	    // Perform MAIL Search
	    $Text = preg_replace("(\[mail\]([$MAILSearchString]*)\[/mail\])",
	        '<a href="mailto:$1">$1</a>', $Text);
	    $Text = preg_replace("/\[mail\=([$MAILSearchString]*)\](.+?)\[\/mail\]/",
	        '<a href="mailto:$1">$2</a>', $Text);

	    // Check for bold text
	    $Text = preg_replace("(\[b\](.+?)\[\/b])is", '<span class="bold">$1</span>', $Text);

	    // Check for Italics text
	    $Text = preg_replace("(\[i\](.+?)\[\/i\])is", '<span class="italics">$1</span>',
	        $Text);

	    // Check for Underline text
	    $Text = preg_replace("(\[u\](.+?)\[\/u\])is",
	        '<span class="underline">$1</span>', $Text);

	    // Check for strike-through text
	    $Text = preg_replace("(\[s\](.+?)\[\/s\])is",
	        '<span class="strikethrough">$1</span>', $Text);

	    // Check for over-line text
	    $Text = preg_replace("(\[o\](.+?)\[\/o\])is", '<span class="overline">$1</span>',
	        $Text);

	    // Check for colored text
	    $Text = preg_replace("(\[color=(.+?)\](.+?)\[\/color\])is", "<span style=\"color: $1\">$2</span>",
	        $Text);

	    // Check for sized text
	    $Text = preg_replace("(\[size=(.+?)\](.+?)\[\/size\])is", "<span style=\"font-size: $1px\">$2</span>",
	        $Text);

	    // Check for list text
	    $Text = preg_replace("/\[list\](.+?)\[\/list\]/is",
	        '<ul class="listbullet">$1</ul>', $Text);
	    $Text = preg_replace("/\[list=1\](.+?)\[\/list\]/is",
	        '<ul class="listdecimal">$1</ul>', $Text);
	    $Text = preg_replace("/\[list=i\](.+?)\[\/list\]/s",
	        '<ul class="listlowerroman">$1</ul>', $Text);
	    $Text = preg_replace("/\[list=I\](.+?)\[\/list\]/s",
	        '<ul class="listupperroman">$1</ul>', $Text);
	    $Text = preg_replace("/\[list=a\](.+?)\[\/list\]/s",
	        '<ul class="listloweralpha">$1</ul>', $Text);
	    $Text = preg_replace("/\[list=A\](.+?)\[\/list\]/s",
	        '<ul class="listupperalpha">$1</ul>', $Text);
	    $Text = str_replace("[*]", "<li>", $Text);

	    // Check for font change text
	    $Text = preg_replace("(\[font=(.+?)\](.+?)\[\/font\])", "<span style=\"font-family: $1;\">$2</span>",
	        $Text);

	    // Declare the format for [code] layout
	    $CodeLayout = '<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
	                                <tr>
	                                    <td class="quotecodeheader"> Code:</td>
	                                </tr>
	                                <tr>
	                                    <td class="codebody">$1</td>
	                                </tr>
	                           </table>';
	    // Check for [code] text
	    $Text = preg_replace("/\[code\](.+?)\[\/code\]/is", "$CodeLayout", $Text);

	    // Declare the format for [quote] layout
	    $QuoteLayout = '<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
	                                <tr>
	                                    <td class="quotecodeheader"> Quote:</td>
	                                </tr>
	                                <tr>
	                                    <td class="quotebody">$1</td>
	                                </tr>
	                           </table>';

	    // Check for [quote] text
	    // $Text = preg_replace("/\[quote\](.+?)\[\/quote\]/is", "$QuoteLayout", $Text);
	    // $Text = preg_replace("/\[quote\=([$MAILSearchString]*)\](.+?)\[\/quote\]/",
	    //     '<blockquote><small>$1</small>$2</blockquote>', $Text);
	    $Text = preg_replace("(\[quote\](.+?)\[/quote\])is", '<blockquote>$1</blockquote>', $Text);
	    $Text = preg_replace("(\[quote\=\"(.+?)\"\](.+?)\[/quote\])is", '<blockquote><small>$1 wrote:</small><span>$2</span></blockquote>', $Text);

	    // Images
	    // [img]pathtoimage[/img]
	    $Text = preg_replace("/\[img\](.+?)\[\/img\]/", '<img src="$1">', $Text);

	    // [img=widthxheight]image source[/img]
	    $Text = preg_replace("/\[img\=([0-9]*)x([0-9]*)\](.+?)\[\/img\]/",
	        '<img src="$3" height="$2" width="$1">', $Text);

	    return $Text;
	}  

}

?>