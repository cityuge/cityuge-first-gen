<?php

class CourseController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $courses = DB::table('courses')
            ->remember(Config::get('cityuge.cache_courseList'))
            ->select(array(
                'courses.*',
                'departments.initial',
                'departments.title_en AS department_title_en'))
            ->join('departments', 'courses.department_id', '=', 'departments.id')
            ->orderBy('courses.code', 'ASC')
            ->paginate(Config::get('cityuge.paginate_perPage'));

        $data = array(
            'title' => Lang::choice('app.course', $courses->getCurrentPage(), array('page' => $courses->getCurrentPage())),
            'courses' => $courses,
            'metaDescription' => Lang::get('app.course_metaDesc'),
        );
        return View::make('home.courses.index')->with($data);
    }

    /**
     * JSON course list for typeahead.
     * @return Response JSON feed
     */
    public function courseListTypeahead()
    {
        return Response::make(Course::getSearchTypeaheadList(), 200)->header('Content-Type', 'application/json');
    }

    /**
     * Display a list of courses in a certain category.
     *
     * @return Response
     */
    public function category($categoryUrl, $semesterUrl = null)
    {
        // Check the category URL
        $categoryIndex = array_search($categoryUrl, CourseHelper::$categoryUrl);
        // If category is not found, return 404 error
        if ($categoryIndex === false) {
            return App::abort(404);
        }
        $category = CourseHelper::$category[$categoryIndex];

        $configSemesters = Config::get('cityuge.semesters');

        // Check the semester URL
        if ($semesterUrl != null) {
            // Get the last semester which the database stored
            $endSemester = Config::get('cityuge.latestAcademicYearForOffering') . $configSemesters[2];
            $semesters = SemesterHelper::getSemesterOptions(false, $endSemester);
            $semester = strtoupper($semesterUrl);
            $semesterIndex = array_search($semester, $semesters);
            // If semester is not found, return 404 error
            if ($semesterIndex === false) {
                return App::abort(404);
            }
        }

        // Query
        if ($semesterUrl != null) {
            // Search for all courses in that category which will offer in that semester
            $courses = DB::table('courses')
                ->remember(Config::get('cityuge.cache_courseList'))
                ->select(array(
                    'courses.*',
                    'departments.initial',
                    'departments.title_en AS department_title_en'))
                ->join('departments', 'courses.department_id', '=', 'departments.id')
                ->join('offerings', 'courses.id', '=', 'offerings.course_id')
                ->where('category', '=', $category)
                ->where('offerings.semester', '=', $semester)
                ->groupBy('courses.id')
                ->orderBy('courses.code', 'ASC')
                ->paginate(Config::get('cityuge.paginate_perPage'));

            $title = Lang::choice('app.course_categorySemesterTitle',
                $courses->getCurrentPage(),
                array('page' => $courses->getCurrentPage(), 'category' => CourseHelper::getCategoryText($category), 'semester' => SemesterHelper::getSemesterText($semester)));
        } else {
            $courses = DB::table('courses')
                ->remember(Config::get('cityuge.cache_courseList'))
                ->select(array(
                    'courses.*',
                    'departments.initial',
                    'departments.title_en AS department_title_en',
                    ))
                ->join('departments', 'courses.department_id', '=', 'departments.id')
                ->where('category', '=', $category)
                ->groupBy('courses.id')
                ->orderBy('courses.code', 'ASC')
                ->paginate(Config::get('cityuge.paginate_perPage'));

            $title = Lang::choice('app.course_categoryTitle',
                $courses->getCurrentPage(),
                array('page' => $courses->getCurrentPage(), 'category' => CourseHelper::getCategoryText($category)));
        }

        $metaDescription = Lang::get('app.course_category_metaDesc', array('category' => CourseHelper::getCategoryText($category)));
        $categoryDesc = CourseHelper::getCategoryDesc($category);

        $data = array(
            'title' => $title,
            'courses' => $courses,
            'metaDescription' => $metaDescription,
            'categoryUrl' => $categoryUrl,
            'categoryDesc' => $categoryDesc,
            'semesters' => SemesterHelper::getSemesterOptions(true, Config::get('cityuge.latestAcademicYearForOffering') . $configSemesters[2]),
        );
        return View::make('home.courses.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string $courseCode
     * @return Response
     */
    public function show($courseCode)
    {
        $courseCode = strtoupper($courseCode);
        $course = Cache::get('course_' . $courseCode);
        // Miss in cache
        if (!$course) {
            // Retrieve it from database
            $course = Course::with('department', 'offerings')
                ->where('code', '=', $courseCode)
                ->first();
            // Nothing return from database, Error 404
            if (!$course) {
                return App::abort(404);
            }
            Cache::forever('course_' . $courseCode, $course);
        }

        // Statistics
        $avgWorkload = $course->mean_workload / 5 * 100;
        $gradeDistribution = Course::getCourseGradeDistribution($course);

        $comments = Comment::where('course_id', '=', $course->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(Config::get('cityuge.paginate_commentPerPage'));


        $data = array(
            'title' => Lang::choice('app.course_detail_title', $comments->getCurrentPage(), array('courseCode' => $courseCode, 'page' => $comments->getCurrentPage())),
            'course' => $course,
            'comments' => $comments,
            'avgWorkload' => $avgWorkload,
            'gradeDistribution' => $gradeDistribution,
            'metaKeywords' => array($courseCode, $course->category, $course->department->initial, e($course->department->title_en), e($course->department->title_zh)),
            'metaDescription' => Lang::get('app.course_detail_metaDesc', array('courseCode' => $courseCode, 'courseTitle' => e($course->title_en))),
        );
        return View::make('home.courses.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the advanced search form.
     * @return View search form page
     */
    public function search()
    {
        $configSemesters = Config::get('cityuge.semesters');

        $quickAccesses = SemesterHelper::getQuickAccessCategoryLinks(Config::get('cityuge.currentQuickAccessSemester'));
        $semesters = array('' => '') + SemesterHelper::getSemesterOptions(true, Config::get('cityuge.latestAcademicYearForOffering') . $configSemesters[2]);
        $departments = array('' => '') + Department::orderBy('title_en')->lists('title_en', 'initial');
        $categories = array('' => '');
        foreach (CourseHelper::$category as $category) {
            $categories[$category] = CourseHelper::getCategoryText($category);
        }

        $data = array(
            'title' => trans('app.course_search_title'),
            'metaDescription' => Lang::get('app.course_search_metaDesc'),
            'quickAccesses' => $quickAccesses,
            'semesters' => $semesters,
            'departments' => $departments,
            'categories' => $categories,
        );
        return View::make('home.courses.search')->with($data);
    }

    /**
     * Process the search form.
     * @return Redirect redirect to the search result page
     */
    public function processSearch()
    {
        if (Input::get('type') == 'quick') {
            return $this->processQuickSearchForm();
        } else {
            return $this->processAdvancedSearchForm();
        }
    }

    /**
     * Prepare the query string for quick search form submission.
     * @return Redirect redirect to search result page
     */
    private function processQuickSearchForm()
    {
        $keyword = trim(Input::get('keyword'));
        if (empty($keyword)) {
            return Redirect::route('courses.search')
                ->with('alertType', 'error')
                ->with('alertBody', Lang::get('app.course_search_empty'));
        } else {
            return Redirect::route('courses.searchResult', array('q' => $keyword));
        }
    }

    /**
     * Prepare the query string for advanced search form submission.
     * @return Redirect redirect to search result page
     */
    private function processAdvancedSearchForm()
    {
        $query = array();

        $keyword = trim(Input::get('keyword'));
        if (!empty($keyword)) {
            $query['q'] = $keyword;
        }

        $semester = trim(Input::get('semester'));
        if (!empty($semester)) {
            $query['semester'] = $semester;
        }

        $department = trim(Input::get('department'));
        if (!empty($department)) {
            $query['department'] = $department;
        }

        $category = trim(Input::get('category'));
        if (!empty($category)) {
            $query['category'] = $category;
        }

        $exam = trim(Input::get('exam'));
        if (strlen($exam) > 0) {
            $query['exam'] = $exam;
        }

        $quiz = trim(Input::get('quiz'));
        if (strlen($quiz) > 0) {
            $query['quiz'] = $quiz;
        }

        $report = trim(Input::get('report'));
        if (strlen($report) > 0) {
            $query['report'] = $report;
        }

        $project = trim(Input::get('project'));
        if (strlen($project) > 0) {
            $query['project'] = $project;
        }

        return Redirect::route('courses.searchResult', $query);
    }

    /**
     * Display the search results.
     * @return View            search result view
     */
    public function searchResult()
    {
        $configSemesters = Config::get('cityuge.semesters');

        $rules = array(
            'semester' => 'in:' . implode(',', SemesterHelper::getSemesterOptions(false, Config::get('cityuge.latestAcademicYearForOffering') . $configSemesters[2])),
            'department' => 'alpha',
            'category' => 'in:' . implode(',', CourseHelper::$category),
            'exam' => 'in:0,1',
            'quiz' => 'in:0,1',
            'report' => 'in:0,1',
            'project' => 'in:0,1',
        );
        // Check the GET parameters
        if (Validator::make(Input::all(), $rules)->fails()) {
            return Redirect::route('courses.search')
                ->with('alertType', 'error')
                ->with('alertBody', Lang::get('app.course_search_wrongParam'));
        }

        // Build the query
        $query = DB::table('courses')
            ->select(array(
                'courses.*',
                'departments.initial',
                'departments.title_en AS department_title_en'))
            ->join('departments', 'courses.department_id', '=', 'departments.id');
        if (Input::get('semester')) {
            $query->join('offerings', 'courses.id', '=', 'offerings.course_id');
            $query->where('offerings.semester', '=', Input::get('semester'));
        }
        if (Input::get('q')) {
            $query->where(function ($query) {
                $query->where('courses.code', 'LIKE', '%' . Input::get('q') . '%');
                $query->orWhere('courses.title_zh', 'LIKE', '%' . Input::get('q') . '%');
                $query->orWhere('courses.title_en', 'LIKE', '%' . Input::get('q') . '%');
            });
        }
        if (Input::get('department')) {
            $query->where('departments.initial', '=', Input::get('department'));
        }
        if (Input::get('category')) {
            $query->where('category', '=', Input::get('category'));
        }
        if (strlen(Input::get('exam')) > 0) {
            $query->where('assess_exam', '=', Input::get('exam'));
        }
        if (strlen(Input::get('quiz')) > 0) {
            $query->where('assess_quiz', '=', Input::get('quiz'));
        }
        if (strlen(Input::get('report')) > 0) {
            $query->where('assess_report', '=', Input::get('report'));
        }
        if (strlen(Input::get('project')) > 0) {
            $query->where('assess_project', '=', Input::get('project'));
        }
        $results = $query->groupBy('courses.id')
            ->orderBy('courses.code', 'ASC')
            ->paginate(Config::get('cityuge.paginate_perPage'));

        $data = array(
            'title' => Lang::choice('app.course_search_resultTitle', $results->getCurrentPage(), array('page' => $results->getCurrentPage())),
            'courses' => $results,
            'keyword' => Input::get('q'),
            'searchResult' => true,
        );
        return View::make('home.courses.index')->with($data);
    }

}