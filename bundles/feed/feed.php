<?php
/**
 * Feed generator class for laravel-feed bundle.
 *
 * @author Roumen Damianoff <roumen@dawebs.com>
 * @version 1.3
 * @link http://roumen.me/projects/laravel-feed
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */

class Feed
{

    public $items = array();
    public $title = 'My feed title';
    public $description = 'My feed description';
    public $link;
    public $site_link;
    public $pubdate;
    public $lang;
    public $charset = 'utf-8';
    public $ctype = 'application/atom+xml';
    public $generator = 'laravel-feed';


    /**
     * Add new item to $items array
     *
     * @param string $title
     * @param string $author
     * @param string $link
     * @param string $pubdate
     * @param string $description
     *
     * @return void
     */
    public function add($title, $author, $link, $pubdate, $description)
    {
        $this->items[] = array(
            'title' => $title,
            'author' => $author,
            'link' => $link,
            'pubdate' => $pubdate,
            'description' => $description,
        );
    }


    /**
     * Returns aggregated feed with all items from $items array
     *
     * @param string $format (options: 'atom', 'rss')
     *
     * @return view
     */
    public function render($format = 'atom')
    {
        if (empty($this->lang)) $this->lang = Config::get('application.language');
        if (empty($this->link)) $this->link = Config::get('application.url');
        if (empty($this->pubdate)) $this->pubdate = date('D, d M Y H:i:s O');
        if ($format == 'rss') $this->ctype = 'text/xml';

        $channel = array(
            'title'=>$this->title,
            'description'=>$this->description,
            'link'=>$this->link,
            'site_link' => $this->site_link,
            'pubdate'=>$this->pubdate,
            'lang'=>$this->lang,
            'generator' => $this->generator,
        );
        return Response::make(Response::view('feed::'.$format, array('items' => $this->items, 'channel' => $channel) ), 200, array('Content-Type' => $this->ctype.'; charset='.$this->charset));
    }

}