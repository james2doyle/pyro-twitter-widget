pyro-twitter-widget
===================

A twitter widget for PyroCMS. Supports oAuth v1.1 API. It uses [J7mbo/twitter-api-php](https://github.com/J7mbo/twitter-api-php) for the oAuth and Twitter calls.

##### Widget Form

![form.png](https://raw.github.com/james2doyle/pyro-twitter-widget/master/form.png)

##### API Choices

![restchoices.png](https://raw.github.com/james2doyle/pyro-twitter-widget/master/restchoices.png)

### Supported REST API Endpoints

* statuses/mentions_timeline
* statuses/user_timeline
* statuses/home_timeline
* statuses/retweets_of_me
* favorites/list

### Usage

1. Create a [Twitter App](https://dev.twitter.com/apps)
2. Install the widget (add to addons/shared_addons/widgets or addons/default/widgets) and run `git submodule init`
3. Enter in all your information
4. Choose your API target
5. Add your username
6. Add to your page

### Tweet Properties

Here are the results of a "My Timeline" tweet object:

```php
stdClass Object(
    [created_at] => Fri Aug 02 15:45:54 +0000 2013
    [id] => 363324789118603264
    [id_str] => 363324789118603264
    [text] => haha this is funny. The Hipster Logo Design Guide&nbsp;<a target="_blank" href="http://t.co/eYwlKmbsjf">http://t.co/eYwlKmbsjf</a>
    [source] => <a href="https://chrome.google.com/webstore/detail/ikknnkomiokeodcdkknnhgjmncfiefmn" rel="nofollow">Notifier for Chrome</a>
    [truncated] =>
    [in_reply_to_status_id] =>
    [in_reply_to_status_id_str] =>
    [in_reply_to_user_id] =>
    [in_reply_to_user_id_str] =>
    [in_reply_to_screen_name] =>
    [user] => stdClass Object(
            [id] => 320266583
            [id_str] => 320266583
            [name] => James Doyle
            [screen_name] => james2doyle
            [location] => London, Canada
            [description] => Web Developer • Technophile • People Watcher • Paleo Eater • Movie Goer • Bike Lover • TV Enjoyer • Director at @WARPAINTMedia
            [url] => http://t.co/cMaztGMk1v
            [entities] => stdClass Object(
                    [url] => stdClass Object(
                            [urls] => Array(
                                    [0] => stdClass Object(
                                            [url] => http://t.co/cMaztGMk1v
                                            [expanded_url] => http://ohdoylerules.com
                                            [display_url] => ohdoylerules.com
                                            [indices] => Array(
                                                    [0] => 0
                                                    [1] => 22
                                                )
                                        )
                                )
                        )
                    [description] => stdClass Object(
                            [urls] => Array(
                                )
                        )
                )
            [protected] =>
            [followers_count] => 176
            [friends_count] => 440
            [listed_count] => 14
            [created_at] => Sun Jun 19 16:16:19 +0000 2011
            [favourites_count] => 5
            [utc_offset] => -14400
            [time_zone] => Eastern Time (US &amp; Canada)
            [geo_enabled] =>
            [verified] =>
            [statuses_count] => 742
            [lang] => en
            [contributors_enabled] =>
            [is_translator] =>
            [profile_background_color] => FFFFFF
            [profile_background_image_url] => http://a0.twimg.com/profile_background_images/776577586/5998b26a2430febb9e6ea8f0b5a1e9ee.png
            [profile_background_image_url_https] => https://si0.twimg.com/profile_background_images/776577586/5998b26a2430febb9e6ea8f0b5a1e9ee.png
            [profile_background_tile] => 1
            [profile_image_url] => http://a0.twimg.com/profile_images/378800000119818419/75e06cffcd02d3ca6ae4ce68076e42e4_normal.png
            [profile_image_url_https] => https://si0.twimg.com/profile_images/378800000119818419/75e06cffcd02d3ca6ae4ce68076e42e4_normal.png
            [profile_banner_url] => https://pbs.twimg.com/profile_banners/320266583/1365780780
            [profile_link_color] => 338AD6
            [profile_sidebar_border_color] => FFFFFF
            [profile_sidebar_fill_color] => 121212
            [profile_text_color] => FFFFFF
            [profile_use_background_image] => 1
            [default_profile] =>
            [default_profile_image] =>
            [following] =>
            [follow_request_sent] =>
            [notifications] =>
        )
    [geo] =>
    [coordinates] =>
    [place] =>
    [contributors] =>
    [retweet_count] => 0
    [favorite_count] => 0
    [entities] => stdClass Object(
            [hashtags] => Array(
                )

            [symbols] => Array(
                )

            [urls] => Array(
                    [0] => stdClass Object(
                            [url] => http://t.co/eYwlKmbsjf
                            [expanded_url] => http://www.hipsterlogo.com/
                            [display_url] => hipsterlogo.com
                            [indices] => Array(
                                    [0] => 50
                                    [1] => 72
                                )
                        )
                )
            [user_mentions] => Array(
                )
        )
    [favorited] =>
    [retweeted] =>
    [possibly_sensitive] =>
    [lang] => en
    [timeago] => 4 hours ago
)
```

### Styling

Here is the basic display. You can overide this view in your theme or just customize the default one.

```html
<div class="pyro-twitter-widget">
  {{ tweets }}
    <span class="timeago">{{ timeago }}</span>
    <span class="tweet-text">{{ text }}</span>
  {{ /tweets }}
</div>
```

#### Helper Function Sources

*_parse_tweet function*

[Parsing Twitter with RegExp](http://saturnboy.com/2010/02/parsing-twitter-with-regexp/)

*_timeago function*

[Convert twitter created_at time format to ago format](http://webcodingeasy.com/PHP/Convert-twitter-createdat-time-format-to-ago-format)