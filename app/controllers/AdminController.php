<?php

class AdminController extends BaseController
{

    /**
     * Dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('admin.index');
    }

    public function deletedComment()
    {
        $comments = Comment::onlyTrashed()->with('course')
            ->orderBy('deleted_at', 'DESC')
            ->paginate(Config::get('cityuge.paginate_commentPerPage'));

        $data = [
            'comments' => $comments,
        ];
        return View::make('admin.comment.deleted', $data);
    }

    public function cache()
    {
        return View::make('admin.cache.index');
    }

    /**
     * Purge all the cache manually.
     * @return Redirect redirect to admin dashboard
     */
    public function purgeCache()
    {
        Cache::flush();
        return Redirect::route('admin.dashboard')
            ->with('alertType', 'success')
            ->with('alertBody', Lang::get('app.cache_purged'));
    }

}