<?php

namespace App\Http\Controllers\Api;

use App\Modules\Tasks\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Tasks\Repositories\TaskRepository;
use App\Modules\Categories\Repositories\CategoryRepository;

class TaskController extends Controller
{
    protected $taskRepo;
    protected $categoryRepo;

    public function __construct(TaskRepository $taskRepository, CategoryRepository $categoryRepository)
    {
        $this->taskRepo = $taskRepository;
        $this->categoryRepo = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = $this->taskRepo->createTask($request->all());
        return response()->json($create, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $update = $this->taskRepo->updateTask($request->all(), $id);
        return response()->json($update, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function sortable(Request $request, $id)
    {
        $categoryId = $request->get('category_id');
        $to = $request->get('order');

        $task = $this->taskRepo->findTaskById($id);
        $from = $task->order;

        $category = $this->categoryRepo->findCategoryById($categoryId);
        $cat = new CategoryRepository($category);
        if ($from < $to) {
            $start = $from + 1;
            $end = $to;
            $temp = -1;
        } else {
            $start = $to;
            $end = $from - 1;
            $temp = +1;
        }
        $tasks = $cat->findTaksBetweenOrder($start, $end);
        $data = [];
        foreach ($tasks as $value) {
            $data['order'] = $value->order + $temp;
            $this->taskRepo->updateTask($data, $value->id);
        }
        $update =$this->taskRepo->updateTask(['order' => $to], $id);
        return response()->json(['success'=> $update ], 200);
    }
}
