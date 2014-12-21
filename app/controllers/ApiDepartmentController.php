<?php


class ApiDepartmentController extends BaseController
{
    public function index()
    {
        $departments = Department::all();
        return Response::json($departments);
    }

}
