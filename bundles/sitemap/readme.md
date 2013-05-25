# [laravel-sitemap](http://roumen.me/projects/laravel-sitemap) bundle

A simple sitemap generator for Laravel.


## Installation

Install using the Artian CLI:

	php artisan bundle:install sitemap

then edit ``application/bundles.php`` to autoload sitemap:

```php
'sitemap' => array('auto' => true)
```

## Example: Dynamic sitemap

```php
Route::get('sitemap', function(){

    $sitemap = new Sitemap();

    // set item's url, date, priority, freq
    $sitemap->add(URL::to(), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
    $sitemap->add(URL::to('page'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

    $posts = DB::table('posts')->order_by('created', 'desc')->get();
    foreach ($posts as $post)
    {
        $sitemap->add($post->slug, $post->modified, $post->priority, $post->freq);
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');

});
```

## Example: Artisan task to store sitemap in a file

Go to and edit ``bundles/sitemap/tasks/generate.php`` or create new custom task in your application folder

Then add a sitemap in your run() method as you normally would, but use store() instead of render()

```php
public function run($arguments)
{
    $sitemap = new Sitemap();

    // set item's url, date, priority, freq
    $sitemap->add(URL::to(), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
    $sitemap->add(URL::to('page'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

    $posts = DB::table('posts')->order_by('created', 'desc')->get();
    foreach ($posts as $post)
    {
        $sitemap->add($post->slug, $post->modified, $post->priority, $post->freq);
    }

    // generate your sitemap and store it to a file
    $sitemap->store('xml','sitemap');

    // some custom cli message (optional)
    echo 'done.';
});
```
Now you can use artisan to execute this task

``php artisan sitemap::generate``

Optionally you could set your crontab to update this sitemap periodically