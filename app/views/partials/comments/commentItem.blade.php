<div class="comment-wrapper">
    <article class="panel panel-default panel-comment">
        <header class="panel-comment-heading">
            <a href="{{ URL::route('courses.show', array(strtolower($comment->course->code))) }}" class="{{ CourseHelper::getGradeStyle('panel-comment-heading-', $comment->grade) }}">
                <h3 class="panel-title" itemprop="name">
                    <span class="panel-course-code">{{{ $comment->course->code }}}</span>

                    <span class="panel-course-title">{{{ $comment->course->title_en }}}</span>
                    @if (!empty($comment->course->title_zh) && Config::get('app.locale') !== 'en')
                        <span class="panel-course-title">{{{ $comment->course->title_zh }}}</span>
                    @endif
                </h3>
                <span class="panel-comment-grade {{ CourseHelper::getGradeStyle('panel-comment-grade-', $comment->grade) }}" data-toggle="tooltip" data-placement="left" title="{{ trans('app.comment_grade_tooltip', array('grade' => CourseHelper::getGradeText($comment->grade))) }}">{{ $comment->grade }}</span>
            </a>
        </header>
        <aside class="panel-comment-aside">
            <ul class="panel-comment-aside-meta">
                <li>
                    <dl>
                        <dt>{{ trans('app.comment_semester') }}</dt>
                        <dd>{{ SemesterHelper::getSemesterText($comment->semester) }}</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>{{ trans('app.comment_instructor') }}</dt>
                        <dd>{{{ $comment->instructor }}}</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>{{ trans('app.comment_workload') }}</dt>
                        <dd>{{ CommentHelper::getWorkloadText($comment->workload) }}</dd>
                    </dl>
                </li>
            </ul>
        </aside>
        <div class="panel-body panel-comment-body" itemprop="commentText">{{ $comment->body }}</div>
        <footer class="panel-footer panel-comment-footer">
            <p class="text-muted pull-left">
                <i class="fa fa-clock-o"></i>
                <time pubdate datetime="{{ $comment->created_at->format(DateTime::ISO8601) }}" itemprop="commentTime">{{ $comment->created_at->format('M j, Y H:i') }}</time>
            </p>
            <div class="btn-group btn-group-comment-footer">
                @if (Route::getCurrentRoute()->getName() != 'comments.show')
                    <a href="{{ URL::route('comments.show', array($comment->id)) }}" class="btn btn-comment-footer" role="button"><i class="fa fa-link"></i> <span class="sr-only">{{ trans('app.comment_permalink') }}</span></a>
                @endif
                <div class="btn-group dropup">
                    <ul class="dropdown-menu dropdown-menu-right" role="menu" data-share-list="share" aria-labelledby="comment-dropup-menu-{{ $comment->id }}">
                        <li><a rel="nofollow" data-share="facebook" href="http://facebook.com/share.php?u={{ urlencode(URL::route('comments.show', array($comment->id))) }}"><i class="fa fa-fw fa-facebook"></i> {{ trans('app.socialMedia_facebook') }}</a></li>
                        <li><a rel="nofollow" data-share="twitter" href="https://twitter.com/intent/tweet?url={{ urlencode(URL::route('comments.show', array($comment->id))) }}"><i class="fa fa-fw fa-twitter"></i> {{ trans('app.socialMedia_twitter') }}</a></li>
                        <li><a rel="nofollow" data-share="googlePlus" href="http://plus.google.com/share?url={{ urlencode(URL::route('comments.show', array($comment->id))) }}"><i class="fa fa-fw fa-google-plus"></i> {{ trans('app.socialMedia_googlePlus') }}</a></li>
                        <li><a rel="nofollow" data-share="renren" href="http://share.renren.com/share/buttonshare?link={{ urlencode(URL::route('comments.show', array($comment->id))) }}"><i class="fa fa-fw fa-renren"></i> {{ trans('app.socialMedia_renren') }}</a></li>
                        <li><a rel="nofollow" data-share="sinaWeibo" href="http://v.t.sina.com.cn/share/share.php?url={{ urlencode(URL::route('comments.show', array($comment->id))) }}"><i class="fa fa-fw fa-weibo"></i> {{ trans('app.socialMedia_sinaWeibo') }}</a></li>
                    </ul>
                    <button type="button" id="comment-dropup-menu-{{ $comment->id }}" class="btn btn-comment-footer dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-share"></i> <span class="sr-only">{{ trans('app.comment_share') }}</span> <span class="caret"></span>
                    </button>
                </div>
            </div>
        </footer>
    </article>
</div>
