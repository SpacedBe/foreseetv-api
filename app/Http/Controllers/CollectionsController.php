<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Http\Requests\EditCollectionFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CollectionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAll()
    {
        $main = Collection::with('keywords')->find(1);
        $other = Collection::where('id', '!=', 1)->with('keywords')->orderBy('updated_at', 'desc')->get();

        return view('collections/list')->with('main', $main)->with('other', $other);
    }

    public function create(Request $request)
    {
        $collection = new Collection;

        $collection->name = $request->name;

        $collection->save();

        return redirect()->action(
            'CollectionsController@edit', ['id' => $collection->id]
        );
    }

    public function edit($id)
    {
        $collection = Collection::with(['videos' => function($query) {
            $query->orderBy('updated_at', 'DESC');
    }, 'keywords'])->find($id);

        return view('collections/edit')->with('collection', $collection);
    }

    public function editSave(EditCollectionFormRequest $request, $id)
    {
        // collection
        $collection = Collection::find($id);
        $collection->name = $request->name;
        $collection->save();

        // keywords
        $keywords = explode(',', $request->keywords);

        foreach($collection->keywords as $keyword)
        {
            $keyword->delete();
        }

        foreach($keywords as $keyword)
        {
            $collection->keywords()->create([
                'word' => $keyword,
            ]);
        }

        Session::flash('message', 'Collection saved.');

        //redirect
        return redirect()->action(
            'CollectionsController@edit', ['id' => $id]
        );
    }

    public function delete($id)
    {
        $collection = Collection::find($id);
        $collection->delete();

        Session::flash('message', 'Collection deleted.');

        return redirect()->action('CollectionsController@showAll');
    }
}
