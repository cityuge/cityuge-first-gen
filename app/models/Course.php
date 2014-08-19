<?php

use Carbon\Carbon;

class Course extends BaseModel
{
    protected $guarded = array();
    public static $rules = array();
    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo('Department');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function offerings()
    {
        return $this->hasMany('Offering')->orderBy('semester', 'DESC');
    }

    public static function checkCourseCode($courseCode)
    {
        $courseCode = strtoupper($courseCode);
        $course = static::where('code', '=', $courseCode)->first();
        if ($course) {
            return $course;
        }
        return false;
    }

    /**
     * Get the statistics of a course.
     * @param  Course $course course object
     * @return array           associative array with workload rate and grade distribution
     */
    public static function getCourseGradeDistribution(Course $course)
    {
        return Cache::rememberForever('courseGradeDist_' . $course->id, function () use ($course) {
            return Comment::getGradeDistribution($course->id, $course->grading_pattern);
        });
    }

    /**
     * Get the JSON for course search typeahead.
     * @return string course list
     */
    public static function getSearchTypeaheadList()
    {
        $self = __CLASS__;
        return Cache::rememberForever('courseTypeahead', function () use ($self) {
            $courses = $self::orderBy('code', 'ASC')->get(array('title_en', 'category', 'code'))->toArray();
            $list = array();
            foreach ($courses as $course) {
                $list[] = array(
                    'title' => $course['title_en'],
                    'category' => $course['category'],
                    'value' => $course['code'],
                    'tokens' => array(
                        $course['code'],
                        preg_replace("/[A-Z]/", "", $course['code']),
                        $course['title_en'],
                    ),
                );
            }
            return json_encode($list);
        });
    }

    /**
     * Get statistics from database.
     * @return array statistics
     */
    public static function getCourseStats()
    {
        $self = __CLASS__;
        return Cache::rememberForever('homeStats', function () use ($self) {
            return array(
                'hotCoursesArea1' => $self::getHotCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
                'hotCoursesArea2' => $self::getHotCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
                'hotCoursesArea3' => $self::getHotCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

                'goodGradeCoursesArea1' => $self::getGoodGradeCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
                'goodGradeCoursesArea2' => $self::getGoodGradeCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
                'goodGradeCoursesArea3' => $self::getGoodGradeCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

                'badGradeCoursesArea1' => $self::getBadGradeCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
                'badGradeCoursesArea2' => $self::getBadGradeCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
                'badGradeCoursesArea3' => $self::getBadGradeCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

                'lightWorkloadCoursesArea1' => $self::getLightWorkloadCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
                'lightWorkloadCoursesArea2' => $self::getLightWorkloadCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
                'lightWorkloadCoursesArea3' => $self::getLightWorkloadCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

                'heavyWorkloadCoursesArea1' => $self::getHeavyWorkloadCourses('AREA1', Config::get('cityuge.home_statsMaxItem')),
                'heavyWorkloadCoursesArea2' => $self::getHeavyWorkloadCourses('AREA2', Config::get('cityuge.home_statsMaxItem')),
                'heavyWorkloadCoursesArea3' => $self::getHeavyWorkloadCourses('AREA3', Config::get('cityuge.home_statsMaxItem')),

                'updatedAt' => Carbon::now(),
            );
        });
    }

    /**
     * Get the courses which have most comments.
     * @param  string $category category like AREA1, AREA2...
     * @param  int $limit max number of courses return
     * @return array            list of courses
     */
    public static function getHotCourses($category, $limit)
    {
        $query = DB::select("SELECT
  code,
  title_en,
  total_comments
FROM courses
WHERE category = ?
ORDER BY total_comments DESC
LIMIT ?", array($category, $limit));
        return $query;
    }

    public static function getGoodGradeCourses($category, $limit)
    {
        $query = DB::select("SELECT
  code,
  title_en,
  bayesian_gp
FROM courses
WHERE category = ? AND bayesian_gp >= 3.3
ORDER BY bayesian_gp DESC
LIMIT ?", array($category, $limit));
        return $query;
    }

    public static function getBadGradeCourses($category, $limit)
    {
        $query = DB::select("SELECT
  code,
  title_en,
  bayesian_gp
FROM courses
WHERE category = ? AND bayesian_gp < 3 AND bayesian_gp > 0
ORDER BY bayesian_gp DESC
LIMIT ?", array($category, $limit));
        return $query;
    }

    public static function getLightWorkloadCourses($category, $limit)
    {
        $query = DB::select("SELECT
  code,
  title_en,
  bayesian_workload
FROM courses
WHERE category = ? AND bayesian_workload <= 2.7 AND bayesian_workload > 0
ORDER BY bayesian_workload ASC
LIMIT ?", array($category, $limit));
        return $query;
    }

    public static function getHeavyWorkloadCourses($category, $limit)
    {
        $query = DB::select("SELECT
  code,
  title_en,
  bayesian_workload
FROM courses
WHERE category = ? AND bayesian_workload >= 3.3
ORDER BY bayesian_workload DESC
LIMIT ?", array($category, $limit));
        return $query;
    }

    /**
     * Update mean grade point and mean workload level of a course.
     * @param $courseId integer Course ID
     */
    public static function updateMeans($courseId)
    {
        DB::update("UPDATE courses AS co1
  INNER JOIN
  (SELECT
     course_id,
     avg(gp)       AS mean_gp,
     avg(workload) AS mean_workload
   FROM comments
   WHERE deleted_at IS NULL AND course_id = ?
   GROUP BY course_id) AS co2
    ON co1.id = co2.course_id
SET co1.mean_gp     = co2.mean_gp,
  co1.mean_workload = co2.mean_workload
WHERE co1.id = ?", array($courseId, $courseId));
    }

    /**
     * Update mean grade point and mean workload level of all courses.
     */
    public static function updateAllMeans()
    {
        DB::update("UPDATE courses AS co1
  INNER JOIN
  (SELECT
     courses.id,
     avg(comments.gp)       AS mean_gp,
     avg(comments.workload) AS mean_workload
   FROM courses
     INNER JOIN comments ON comments.course_id = courses.id AND comments.deleted_at IS NULL
   GROUP BY courses.id) AS co2
    ON co1.id = co2.id
SET co1.mean_gp     = co2.mean_gp,
  co1.mean_workload = co2.mean_workload");
    }

    /**
     * Calculate and store the Bayesian average of grade point and workload level for courses under Area 1-3.
     * Remember to calculate the mean grade point and mean workload level first.
     * @param $minCommentNum integer minimum number of comments required to be listed
     */
    public static function updateBayesianAverages($minCommentNum)
    {
        // Reset all Bayesian averages columns in courses table to zero
        DB::update("UPDATE courses SET bayesian_gp = 0, bayesian_workload = 0");

        // Calculate and write the Bayesian averages into courses table
        DB::update("UPDATE courses AS co1
  INNER JOIN
  (SELECT
     id,
     IF(total_comments = 0, 0, ((SELECT
     AVG(comments.workload) AS all_mean_workload
                                 FROM courses
                                   INNER JOIN comments ON comments.course_id = courses.id
                                                          AND comments.deleted_at IS NULL
                                                          AND courses.category NOT IN ('E', 'UNIREQ')) * ? +
                                mean_workload * total_comments) / (? + total_comments)) AS bayesian_workload,
     IF(total_comments = 0, 0, ((SELECT
     AVG(comments.gp) AS all_mean_gp
                                 FROM courses
                                   INNER JOIN comments ON comments.course_id = courses.id
                                                          AND comments.deleted_at IS NULL
                                                          AND courses.category NOT IN ('E', 'UNIREQ')) * ? +
                                mean_gp * total_comments) / (? + total_comments))        AS bayesian_gp

   FROM courses
   WHERE courses.category NOT IN ('E', 'UNIREQ')) AS co2
    ON co1.id = co2.id
SET co1.bayesian_workload = co2.bayesian_workload,
  co1.bayesian_gp = co2.bayesian_gp", array($minCommentNum, $minCommentNum, $minCommentNum, $minCommentNum));
    }

    public static function recalculateCommentCount()
    {
        DB::update("UPDATE courses AS co1
  INNER JOIN
  (SELECT
     courses.id,
     COUNT(*) AS total_comments
   FROM courses
     INNER JOIN comments ON comments.course_id = courses.id AND comments.deleted_at IS NULL
   GROUP BY courses.id) AS co2
    ON co1.id = co2.id
SET co1.total_comments = co2.total_comments");
    }
}