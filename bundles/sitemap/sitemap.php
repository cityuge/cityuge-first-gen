<?php
/**
 * Sitemap class for laravel-sitemap bundle.
 *
 * @author Roumen Damianoff <roumen@dawebs.com>
 * @version 1.3
 * @link http://roumen.me/projects/laravel-sitemap
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */

class Sitemap
{

    public $items = array();
    public $title;
    public $link;


    /**
     * Add new sitemap item to $items array
     *
     * @param string $loc
     * @param string $lastmod
     * @param string $priority
     * @param string $freq
     * @param string $title
     *
     * @return void
     */
    public function add($loc, $lastmod = null, $priority = '0.50', $freq = 'monthly', $title = null)
    {
        $this->items[] = array(
            'loc' => $loc,
            'lastmod' => $lastmod,
            'priority' => $priority,
            'freq' => $freq,
            'title'=> $title
        );
    }


    /**
     * Returns document with all sitemap items from $items array
     *
     * @param string $format (options: xml, html, txt, ror-rss, ror-rdf)
     *
     * @return View
     */
    public function render($format = 'xml')
    {
        if (empty($this->link)) $this->link = Config::get('application.url');
        if (empty($this->title)) $this->title = 'Sitemap for ' . $this->link;

        $channel = array(
            'title' => $this->title,
            'link' => $this->link
        );

        switch ($format)
        {
            case 'ror-rss':
                return Response::make(Response::view('sitemap::ror-rss', array('items' => $this->items, 'channel' => $channel)), 200, array('Content-Type' => 'text/rss+xml; charset=utf-8'));
                break;
            case 'ror-rdf':
                return Response::make(Response::view('sitemap::ror-rdf', array('items' => $this->items, 'channel' => $channel)), 200, array('Content-Type' => 'text/rdf+xml; charset=utf-8'));
                break;
            case 'html':
                return Response::make(Response::view('sitemap::html', array('items' => $this->items, 'channel' => $channel)), 200, array('Content-Type' => 'text/html'));
                break;
            case 'txt':
                return Response::make(Response::view('sitemap::txt', array('items' => $this->items, 'channel' => $channel)), 200, array('Content-Type' => 'text/plain'));
                break;
            default:
                return Response::make(Response::view('sitemap::xml', array('items' => $this->items)), 200, array('Content-Type' => 'text/xml; charset=utf-8'));
        }
    }

    /**
     * Generate sitemap and store it to a file
     *
     * @param string $format (options: xml, html, txt, ror-rss, ror-rdf)
     * @param string $filename (without file extension, may be a path like 'sitemaps/sitemap1' but must exist)
     *
     * @return void
     */
    public function store($format = 'xml', $filename = 'sitemap')
    {
        $content = $this->render($format);

        if ($format == 'ror-rss' || $format == 'ror-rdf') $format = 'xml';

        $file = path('public') . $filename . '.' .$format;

        File::put($file, $content);
    }

}