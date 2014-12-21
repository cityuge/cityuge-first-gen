<?php


class ApiCourseController extends BaseController
{
    /**
     * List all courses offered in a particular semester.
     *
     * @param $semester
     * @return \Illuminate\Http\JsonResponse
     */
    public function semester($semester)
    {
        $courses = Course::whereHas('offerings', function ($q) use ($semester) {
            $q->where('semester', '=', strtoupper($semester));
        })->orderBy('code', 'ASC')->get(array('id', 'code', 'title_en', 'category'))->toArray();
        return Response::json($courses);
    }

    public function batchAdd()
    {
        $courses = Input::json()->all();
        Log::debug('batch add');
        $newCourses = [];

        foreach ($courses as $course) {

            $c = Course::where('code', '=', $course['code'])->first();
            if (!$c) {
                // Create a new course record when the course
                $c = new Course();
                $c->code = $course['code'];
                $c->title_en = $course['title'];
                $c->category = $this->getCourseCategory($course['code']);
                $c->level = $this->getCourseLevel($course['code']);
                $c->department_id = $course['departmentId'];
                $c->grading_pattern = 'STD';
                $c->assess_exam = 0;
                $c->assess_quiz = 0;
                $c->assess_report = 0;
                $c->assess_project = 0;
                $c->total_comments = 0;
                $c->mean_gp = 0;
                $c->bayesian_gp = 0;
                $c->bayesian_workload = 0;
                $c->save();
                $newCourses[] = $course['code'];
            }

            $offering = new Offering();
            $offering->semester = $course['semester'];
            $offering->course_id = $c->id;
            $offering->save();
            $results[] = $offering;
        }

        return Response::json($newCourses);
    }

    public function batchDelete()
    {
        $courses = Input::json()->all();
        Log::debug('batch delete');
        $results = [];

        foreach ($courses as $course) {
            $c = Course::where('code', '=', $course['code'])->first();
            if ($c) {
                $result = Offering::where('course_id', $c->id)
                    ->where('semester', $course['semester'])->delete();
                $results[] = $result;
            }
        }

        return Response::json($results);
    }

    private function getCourseCategory($code)
    {
        if (strpos($code, 'GE') === 0) {
            $category = substr($code, 3, 1);
            if ($category == '1') {
                return 'AREA1';
            } else if ($category == '2') {
                return 'AREA2';
            } else if ($category == '3') {
                return 'AREA3';
            } else if ($category == '4' || $category == '5') {
                return 'UNIREQ';
            }
        }
        return 'E';
    }

    private function getCourseLevel($code)
    {
        $matches = array();
        preg_match('/\d{4}/', $code, $matches);
        $level = substr($matches[0], 0, 1);
        return 'B' . $level;
    }
}
