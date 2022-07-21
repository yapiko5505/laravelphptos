<?php

namespace App\Http\Controllers;

use App\Models\Brog;
use App\Models\Category;
use Illuminate\Http\Request;

class BrogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brogs = Brog::latest()->paginate(5);
        return view('brog.index', ['brogs' => $brogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            ['title' => 'required',
             'memo' => 'required',
             'category' => 'required',
             'image' => 'required|mimes:jpeg,png,jpg,gif,svg'],
             ['title.required' => 'タイトルを入力してください。',
              'memo.required' => '詳細を入力してください。',
              'category.required' => 'カテゴリーを入力してください。',
              'image.required' => '画像を選択してください。']
        );

        $image = $request->file('image');
        $name = time(). '.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath,$name);

        Brog::create([
            'title'=>request('title'),
            'memo'=>request('memo'),
            'category_id'=>request('category'),
            'image'=>$name
        ]);

        return redirect()->back()->with('message', '詳細が追加されました。');
    
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
        $brog = Brog::find($id);
        return view('Brog.edit', ['brog' => $brog]);
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
        request()->validate(
            ['title' => 'required',
             'memo' => 'required',
             'category' => 'required',
             'image' => 'required|mimes:jpeg,png,jpg,gif,svg'],
             ['title.required' => 'タイトルを入力してください。',
              'memo.required' => '詳細を入力してください。',
              'category.required' => 'カテゴリーを入力してください。',]
        );

        $brog = Brog::find($id);
        $name = $brog->image;
        if( $request->hasfile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath,$name);
        }
        $brog->update([
            'title'=>request('title'),
            'memo'=>request('memo'),
            'category_id'=>request('category'),
            'image'=>$name
        ]);
        return redirect()->route('brog.index')->with('message', '詳細が更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brog = Brog::find($id);
        $brog->delete();
        return redirect('/brog')->with('message', '詳細が削除されました。');
    
    }

    public function brogTop() {
        $categories = Category::latest()->get();
        return view('brog.top', ['categories' => $categories]);
    }
}
