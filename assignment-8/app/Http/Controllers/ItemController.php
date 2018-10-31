<?php

namespace App\Http\Controllers;

use App\Item;
use App\Like;
use App\Tag;
use Auth;
use Gate;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function getIndex() {
        $items  = Item::orderBy('created_at', 'desc')->paginate(2);
        return view('onlineShop.index', ['items' => $items]);
    }

    public function getAdminIndex() {
        $items = Item::orderBy('name', 'asc')->get();
        return view('admin.index', ['items' => $items]);
    }

    public function getItem( $id) {
        $item = Item::where('id', '=', $id)->with('likes')->first();
        return view('onlineShop.item', ['item' => $item]);
    }

    public function getOrder( $id) {
        $item = Item::where('id', '=', $id)->with('likes')->first();
        return view('onlineShop.order', ['item' => $item]);
    }

    public function getAdminCreate() {
        $tags = Tag::all();
        return view('admin.create',['tags' => $tags]);
    }

    public function getLikeItem($id) {
        $item = Item::where('id', '=', $id)->first();
        $like = new Like();
        $item ->likes()->save($like);
        return redirect()->back();
    }
    public function getAdminEdit($id) {
        $item = Item::find($id);
        $tags = Tag::all();
        return view('admin.edit', ['item' => $item, 'itemId' => $id, 'tags' => $tags]);
    }

    public function getAdminDelete($id) {
        $item = Item::find($id);
        if(Gate::denies('manipulate-item', $item)) {
            return redirect()->back();
        }
        $item->likes()->delete();
        $item>tags()->detach();
        $item->delete();
        return redirect()->route('admin.index')->with('info', 'Item deleted!');
    }

    public function itemAdminCreate( Request $request) {
        $this->validate($request, [
            'name' => 'required|min:5',
            'detail' => 'required|min:10',
            'price' => 'required|min:5'
        ]);

        $user = Auth::user();
        $item = new Item([
         'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'price' => $request->input('price')]);
           $user->items()->save($item);
        //$item->save();
        $item->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Item created, Name is: ' . $request->input('name'));
    }

    public function itemAdminUpdate( Request $request) {
        $this->validate($request, [
            'name' => 'required|min:5',
            'detail' => 'required|min:10',
            'price' => 'required|min:5'
        ]);

        $item = Item::find($request->input('id'));
        if(Gate::denies('manipulate-item', $item)) {
            return redirect()->back();
        }
        $item->name = $request->input('name');
        $item->detail = $request->input('detail');
        $item->price = $request->input('price');

        $item->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        $item->save();
        return redirect()->route('admin.index')->with('info', 'Item edited, new Name is: ' . $request->input('name'));
    }
}
