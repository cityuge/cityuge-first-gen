<?php

class CommentController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comments = Comment::with('course')
            ->orderBy('created_at', 'DESC')
            ->paginate(Config::get('cityuge.paginate_commentPerPage'));
        $data = array(
            'title' => Lang::choice('app.comment', $comments->getCurrentPage(), array('page' => $comments->getCurrentPage())),
            'comments' => $comments,
            'metaKeywords' => array('comments', '意見', '評論', '評價'),
            'metaDescription' => Lang::get('app.comment_metaDesc'),
        );

        return View::make('home.comments.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @param $courseCode string course code
     * @return $this|\Illuminate\View\View|void
     */
    public function create($courseCode)
    {
        $courseCode = strtoupper($courseCode);
        $course = Course::where('code', '=', $courseCode)->first();

        if (!$course) {
            return App::abort(404);
        }
        $semesters = array('' => '') + SemesterHelper::getSemesterOptions();
        $workloads = array('' => '') + CommentHelper::getWorkloadOptions();
        $grades = array(' ' => ' ') + CourseHelper::getGradingOptionArray($course->gradingPattern);

        $data = array(
            'title' => Lang::get('app.comment_newTitle', array('courseCode' => $course->code)),
            'course' => $course,
            'semesters' => $semesters,
            'workloads' => $workloads,
            'grades' => $grades,
        );

        return View::make('home.comments.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // Get the course ID in the form
        $courseId = Input::get('course_id');
        if (!$courseId) {
            return App::abort(400);
        }

        // Get the grading pattern for that course
        $course = Course::find($courseId);
        if (!$course) {
            return App::abort(400);
        }

        Comment::$rules['semester'] .= $courseId;
        switch ($course->gradingPattern) {
            case 'PF':
                Comment::$rules['grade'] .= implode(',', CourseHelper::$pfGrading);
                break;
            case 'STD-PF':
                Comment::$rules['grade'] .= implode(',', CourseHelper::$stdPFGrading);
                break;
            default:
                Comment::$rules['grade'] .= implode(',', CourseHelper::$stdGrading);
                break;
        }

        $comment = new Comment();
        $validation = $comment->validate(Input::all());
        if ($validation->passes()) {
            $comment->course_id = Input::get('course_id');
            $comment->semester = Input::get('semester');
            $comment->instructor = Input::get('instructor');
            $comment->grade = Input::get('grade');
            $comment->gp = CommentHelper::getGradePoint(Input::get('grade'));
            $comment->workload = Input::get('workload');
            $comment->body = Input::get('body');
            // Use the IP provided by CloudFlare if $_SERVER has HTTP_CF_CONNECTING_IP
            $comment->ip_address = Request::server('HTTP_CF_CONNECTING_IP') ?
                Request::server('HTTP_CF_CONNECTING_IP') : Request::server('REMOTE_ADDR');
            $comment->save();

            // Update courses table
            DB::table('courses')->where('id', '=', $courseId)->increment('total_comments');
            Course::updateMeans($courseId);

            // Fire an event
            Event::fire('app.newComment', array(Input::get('course_id'), $course->code));

            return Redirect::route('courses.show', array(strtolower($course->code)))
                ->with('alertType', 'success')
                ->with('alertBody', Lang::get('app.comment_created'));
        }

        return Redirect::back()->withInput()->withErrors($validation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int      $id
     * @return Response
     */
    public function show($id)
    {
        $comment = Comment::withTrashed()->with('course')->find($id);
        if (!$comment || $comment->trashed() && !Auth::check()) {
            return App::abort(404);
        }
        $data = array(
            'title' => Lang::get('app.comment_show_title',
                    array('id' => $comment->id,
                        'courseCode' => e($comment->course->code),
                        'courseTitle' => e($comment->course->title_en))),
            'metaKeywords' => array(
                $comment->course->code,
                $comment->course->category,
                $comment->course->department->initial,
                e($comment->course->department->title_en),
                e($comment->course->department->title_zh)),
            'metaDescription' => e($this->excerpt($comment->body)),
            'comment' => $comment,
        );

        return View::make('home.comments.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int      $id
     * @return Response
     */
    public function edit($id)
    {
        $comment = Comment::withTrashed()->with('course')->find($id);
        if (!$comment || $comment->trashed() && !Auth::check()) {
            return App::abort(404);
        }

        $semesters = array('' => '') + SemesterHelper::getSemesterOptions();
        $workloads = array('' => '') + CommentHelper::getWorkloadOptions();
        $grades = array(' ' => ' ') + CourseHelper::getGradingOptionArray($comment->course->gradingPattern);

        $data = [
            'comment' => $comment,
            'semesters' => $semesters,
            'workloads' => $workloads,
            'grades' => $grades,
        ];

        return View::make('home.comments.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int           $id
     * @return Response|null
     */
    public function update($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            App::abort(400);

            return;
        }

        $comment->semester = Input::get('semester');
        $comment->instructor = Input::get('instructor');
        $comment->grade = Input::get('grade');
        $comment->gp = CommentHelper::getGradePoint(Input::get('grade'));
        $comment->workload = Input::get('workload');
        $comment->body = Input::get('body');
        $comment->admin_note = Input::get('admin_note');
        $comment->save();

        // Update courses table
        Course::updateMeans($comment->course_id);

        // Fire an event
        Event::fire('app.editComment', array($comment->course_id, $comment->course->code));

        return Redirect::route('comments.show', array($comment->id))
            ->with('alertType', 'success')
            ->with('alertBody', 'Comment edited.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int      $id
     * @return Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();

            // Update courses table
            DB::table('courses')->where('id', '=', $comment->course_id)->decrement('total_comments');
            Course::updateMeans($comment->course_id);

            // Fire an event
            Event::fire('app.editComment', array($comment->course_id, $comment->course->code));

            return Redirect::back()
                ->with('alertType', 'success')
                ->with('alertBody', 'Comment deleted!');
        } else {
            return Redirect::back()
                ->with('alertType', 'error')
                ->with('alertBody', 'Cannot delete this comment.');
        }
    }

    /**
     * Undo delete comment.
     * @param $id int comment ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $comment = Comment::withTrashed()->find($id);
        if ($comment) {
            $comment->restore();

            // Update courses table
            DB::table('courses')->where('id', '=', $comment->course_id)->increment('total_comments');
            Course::updateMeans($comment->course_id);

            // Fire an event
            Event::fire('app.editComment', array($comment->course_id, $comment->course->code));

            return Redirect::back()
                ->with('alertType', 'success')
                ->with('alertBody', 'Comment restored!');
        } else {
            return Redirect::back()
                ->with('alertType', 'error')
                ->with('alertBody', 'Cannot restore this comment.');
        }
    }

    /**
     * Generate excerpt form a long text.
     * @param  string $text original text
     * @return string excerpt
     */
    private function excerpt($text)
    {
        $text = strip_tags($text);
        //$text = str_replace(array("\r\n", "\r", "\n"), ' ', $text);
        if (mb_strlen($text) > Config::get('cityuge.excerptLength')) {
            return mb_substr($text, 0, Config::get('cityuge.excerptLength'), 'UTF-8') . trans('app.excerptEllipse');
        }

        return $text;
    }

}
