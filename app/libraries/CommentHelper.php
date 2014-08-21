<?php

class CommentHelper
{
    public static function getWorkloadOptions()
    {
        return array(
            '1' => Lang::get('app.workload_1'),
            '2' => Lang::get('app.workload_2'),
            '3' => Lang::get('app.workload_3'),
            '4' => Lang::get('app.workload_4'),
            '5' => Lang::get('app.workload_5'),
        );
    }

    public static function getWorkloadText($index)
    {
        $workloads = static::getWorkloadOptions();

        return $workloads[$index];
    }

    /**
     * Get the corresponding grade point of a letter grade.
     * @param $grade string letter grade
     * @return float|null grade point or null for some grades
     */
    public static function getGradePoint($grade)
    {
        switch ($grade) {
            case 'A+':
                return 4.3;
            case 'A':
                return 4.0;
            case 'A-':
                return 3.7;
            case 'B+':
                return 3.3;
            case 'B':
                return 3.0;
            case 'B-':
                return 2.7;
            case 'C+':
                return 2.3;
            case 'C':
                return 2.0;
            case 'C-':
                return 1.7;
            case 'D':
                return 1.0;
            case 'F':
                return 0.0;
            default:
                return null;
        }
    }

    /**
     * Convert HTML escaped comment to unescaped text
     * @param $escaped
     * @return string unescaped string
     */
    public static function unescapeComment($escaped)
    {
        $result = preg_replace("/(\n|\r\n|\r)+/m", "", $escaped);
        $result = preg_replace("/<\/p>/m", "", $result);
        $result = preg_replace("/<p>/m", "\n\n", $result);
        $result = preg_replace("/<br \/>/m", "\n", $result);
        $result = trim($result);
        $result = html_entity_decode($result, ENT_QUOTES, "UTF-8");

        return $result;
    }
}
