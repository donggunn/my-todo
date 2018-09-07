<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Modules\Articles\Requests\CreateArticleRequest;
use App\Modules\Articles\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleController extends Controller
{
    private $articleRepo;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepo = $articleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->articleRepo->listArticles();
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
    public function store(CreateArticleRequest $request)
    {
        $data = $request->except('_token', '_method');
        if ($request->hasFile('thumb') && $request->file('thumb') instanceof UploadedFile) {
            $data['thumb'] = $this->articleRepo->saveCoverImage($request->file('thumb'));
        }
        $article = $this->articleRepo->createArticle($data);
        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->articleRepo->findArticleById($id);
        return response()->json($article, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        $this->articleRepo->updateArticle($data, $id);
        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = $this->articleRepo->delete($id);
        return response()->json($article, 201);
    }
}