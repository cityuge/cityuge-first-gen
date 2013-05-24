# [laravel-feed](http://roumen.me/projects/laravel-feed) bundle

A simple feed generator for Laravel.


## Installation

Install using the Artian CLI:

	php artisan bundle:install feed

then edit ``application/bundles.php`` to autoload feed:

```php
'feed' => array('auto' => true)
```

## Example

```php
Route::get('feed', function(){

    // creating rss feed with our most recent 20 posts
    $posts = DB::table('posts')->order_by('created', 'desc')->take(20)->get();

    $feed = new Feed();

    // set your feed's title, description, link, pubdate and language
    $feed->title = 'Your title';
    $feed->description = 'Your description';
    $feed->link = URL::to('feed');
    $feed->pubdate = $posts[0]->created;
    $feed->lang = 'en';

    foreach ($posts as $post)
    {
        // set item's title, author, url, pubdate and description
        $feed->add($post->title, $post->author, URL::to($post->slug), $post->created, $post->description);
    }

    // show your feed (options: 'atom' (recommended) or 'rss')
    return $feed->render('atom');

});
```