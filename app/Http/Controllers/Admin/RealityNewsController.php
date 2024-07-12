<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RealityNews;
use App\ModelsExtended\Author;
use App\ModelsExtended\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RealityNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = News::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('short_content', function ($row) {
                    return substr(strip_tags($row->short_content), 0, 150);
                })
                ->addColumn('action', 'Admin.Pages.reality_news.action')
                ->addColumn('checkbox', function ($row) {
                    $html = '<div class="custom-control custom-checkbox text-center">
                                <input type="checkbox" class="custom-control-input checkItem"
                                    name="newsID[]" id="checkbox' . $row->id . '" value="' . $row->id . '">
                                <label class="custom-control-label" for="checkbox' . $row->id . '"></label>
                            </div>';
                    return $html;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }

        return view('Admin.Pages.reality_news.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Admin.Pages.reality_news.addEdit', [
            'action' => 'ADD',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'short_content' => 'required',
            'content' => 'required',
            'image_url' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $news = new News();
        $news->title = $request->title;
        $news->date = $request->date;
        $news->short_content = $request->short_content;
        $news->content = $request->input('content');
        $news->publish_by = $request->publish_by;
        $news->tag = $request->tag ? implode(',', $request->tag) : null;
        $news->author_id = $request->author_id;
        $news->featured = $request->featured;
//        $news->category = "";
//        $news->seotitle = "";
//        $news->seodescription = "";
//        $news->seourl = "";
//        $news->a4a_sort = 0;
        // $news->date = now();

        // base64_decode($request->image_url)

        if(!empty($request->image_url)){
            $image = $request->image_url;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = \Str::random(10) . '.png';
            file_put_contents(public_path().'/news_image/'.$imageName, base64_decode($image));
            $news->image = $imageName;
        }

        // if ($request->has('image')) {
        //     $image = $request->file('image');
        //     $fileName = $image->hashName();
        //     $image->move(public_path('news_image'), $fileName);
        //     $news->image = $fileName;
        // }
        $news->save();

        return redirect()->route('reality-news.index')->with('success', 'News has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);

        if (!$news) return redirect()->back()->with('error', 'Invalid request. Please try again');

        return view('Admin.Pages.reality_news.addEdit', [
            'action' => 'EDIT',
            'news' => $news,
        ]);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'short_content' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $news = News::getById($id);
        $news->title = $request->title;
        $news->date = $request->date;
        $news->short_content = $request->short_content;
        $news->content = $request->input('content');
        $news->publish_by = $request->publish_by;
        $news->tag = $request->tag ? implode(',', $request->tag) : null;
        $news->author_id = $request->author_id;
        $news->featured = $request->featured;

        if(!empty($request->image_url)){
            if (File::exists(public_path('news_image/' . $news->image . ''))) {
                File::delete(public_path('news_image/' . $news->image . ''));
            }

            $image = $request->image_url;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = \Str::random(10) . '.png';
            file_put_contents(public_path().'/news_image/'.$imageName, base64_decode($image));
            $news->image = $imageName;
        }

        // if ($request->has('image')) {
        //     if (File::exists(public_path('news_image/' . $news->image . ''))) {
        //         File::delete(public_path('news_image/' . $news->image . ''));
        //     }
        //     $image = $request->file('image');
        //     $fileName = $image->hashName();
        //     $image->move(public_path('news_image'), $fileName);
        //     $news->image = $fileName;
        // }
        $news->update();

        return redirect()->route('reality-news.index')->with('success', 'News has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);

        if (!$news) return redirect()->back()->with('error', 'Invalid request. Please try again');

        $news->delete();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Reality news has been deleted successfully'
        ]);
    }

    public function bulkDelete(Request $request)
    {
        if (empty($request->newsID)) return redirect()->back()->with('error', 'Please select a record/s to delete.');

        News::whereIn('id', $request->newsID)->delete();

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'News has been deleted successfully.'
        ]);
    }
}
