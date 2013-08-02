<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Twitter feed widget
 *
 * @author 		James Doyle
 * @website		http://ohdoylerules.com
 * @package 	Warpaint
 * @subpackage 	Pyro
 * @copyright 	MIT
 */
class Widget_TwitterWidget extends Widgets
{


	/**
	 * The widget title
	 *
	 * @var array
	 */
	public $title = 'Twitter';

	/**
	 * The translations for the widget description
	 *
	 * @var array
	 */
	public $description = array(
		'en' => 'Add a twitter feed to your website'
		// ,
		// 'el' => 'Δημιουργήστε περιοχές με δικό σας κώδικα HTML',
		// 'br' => 'Permite criar blocos de HTML customizados',
		// 'pt' => 'Permite criar blocos de HTML customizados',
		// 'nl' => 'Maak blokken met maatwerk HTML',
		// 'ru' => 'Создание HTML-блоков с произвольным содержимым',
		// 'id' => 'Membuat blok HTML apapun',
		// 'fi' => 'Luo lohkoja omasta HTML koodista',
		// 'fr' => 'Créez des blocs HTML personnalisés',
		);

	/**
	 * The author of the widget
	 *
	 * @var string
	 */
	public $author = 'James Doyle';

	/**
	 * The author's website.
	 *
	 * @var string
	 */
	public $website = 'http://ohdoylerules.com/';

	/**
	 * The version of the widget
	 *
	 * @var string
	 */
	public $version = '1.0';

	/**
	 * The fields for customizing the options of the widget.
	 *
	 * @var array
	 */
	public $fields = array(
		array(
			'field' => 'consumer_key',
			'label' => 'Consumer Key',
			'rules' => 'required'
			),
		array(
			'field' => 'consumer_secret',
			'label' => 'Consumer Secret',
			'rules' => 'required'
			),
		array(
			'field' => 'oauth_access_token',
			'label' => 'oAuth Access Token',
			'rules' => 'required'
			),
		array(
			'field' => 'oauth_access_token_secret',
			'label' => 'oAuth Access Token Secret',
			'rules' => 'required'
			),
		array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'required'
			),
		array(
			'field' => 'limit',
			'label' => 'Return Limit',
			'rules' => 'required'
			),
		array(
			'field' => 'rest_choice',
			'label' => 'Rest Choice',
			'rules' => ''
			),
		);

	public function form($options) {
		$rest_choice = array(
			"statuses/mentions_timeline" => "Mentions",
			"statuses/user_timeline" => "My Timeline",
			"statuses/home_timeline" => "Home Timeline",
			"statuses/retweets_of_me" => "My Retweets",
			"followers/" => "List Of Followers",
			"favorites/list" => "Your Favourites"
			);
		return array('rest_choice' => $rest_choice, 'options' => $options);
	}

	public function save($options)
	{
		if(empty($options['limit'])){
			$options['limit'] = 20;
		} elseif ($options['limit'] == 0) {
			$options['limit'] = 1;
		}
		return $options;
	}

	private function _timeago($a) {
		// source http://goo.gl/weAjh4
		// get current timestampt
		$b = strtotime("now");
		// get timestamp when tweet created
		$c = strtotime($a);
		// get difference
		$d = $b - $c;
		// calculate different time values
		$minute = 60;
		$hour = $minute * 60; $day = $hour * 24; $week = $day * 7;
		if(is_numeric($d) && $d > 0) {
			// if less then 3 seconds
			if($d < 3) return "right now";
			// if less then minute
			if($d < $minute) return floor($d) . " seconds ago";
			// if less then 2 minutes
			if($d < $minute * 2) return "about 1 minute ago";
			// if less then hour
			if($d < $hour) return floor($d / $minute) . " minutes ago";
			// if less then 2 hours
			if($d < $hour * 2) return "about 1 hour ago";
			// if less then day
			if($d < $day) return floor($d / $hour) . " hours ago";
			// if more then day, but less then 2 days
			if($d > $day && $d < $day * 2) return "yesterday";
			// if less then year
			if($d < $day * 365) return floor($d / $day) . " days ago";
			// else return more than a year
			return "over a year ago";
		}
	}

	private function _parse_tweet($text) {
		// source http://goo.gl/S2rDdc
		$text = preg_replace(
			'@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@',
			'<a target="_blank" href="$1">$1</a>',
			$text);
		$text = preg_replace(
			'/@(\w+)/',
			'<a target="_blank" title="@$1" href="http://twitter.com/$1">@$1</a>',
			$text);
		$text = preg_replace(
			'/\s+#(\w+)/',
			' <a target="_blank" title="#$1" href="http://search.twitter.com/search?q=%23$1">#$1</a>',
			$text);
		return $text;
	}

	/**
	 * The main function of the widget.
	 *
	 * @param array $options The options for displaying an HTML widget.
	 * @return array
	 */
	public function run($options) {
		// Store the feed items
		// ini_set('display_errors', 1);
		$settings = array(
			'oauth_access_token' => $options['oauth_access_token'],
			'oauth_access_token_secret' => $options['oauth_access_token_secret'],
			'consumer_key' => $options['consumer_key'],
			'consumer_secret' => $options['consumer_secret']
			);
		require_once('lib/twitter-api-php/TwitterAPIExchange.php');
		$url = 'https://api.twitter.com/1.1/'.$options['rest_choice'].'.json';
		$getfield = '?screen_name='.$options['username'];
		$requestMethod = 'GET';
		$twitter = new TwitterAPIExchange($settings);
		$tweets = $twitter->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
		->performRequest();
		$tweets = json_decode($tweets);
		$tweets = array_slice($tweets, 0, $options['limit']);
		foreach ($tweets as $tweet) {
			$tweet->timeago = $this->_timeago($tweet->created_at);
			$tweet->text = $this->_parse_tweet($tweet->text);
		}
		return array('options' => $options, 'tweets' => $tweets);
	}

}