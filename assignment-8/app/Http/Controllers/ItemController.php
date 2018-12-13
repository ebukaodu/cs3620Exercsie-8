<?php

namespace App\Http\Controllers;

use App\Item;
use App\Like;
use App\Tag;
use App\Comment;
use Auth;
use Gate;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function getIndex() {
        $items  = Item::orderBy('created_at', 'desc')->paginate(2);
        return view('onlineShop.index', ['items' => $items]);
    }


    public function index()
    {
        $comments = Comment::latest('created_at')->get();
        //$item = Item::where('id', '=', $id)->with('likes')->with('comments')->first();
        return view('onlineShop.item', ['comments' => $comments]);
    }

    public function getAdminIndex() {
        $items = Item::orderBy('name', 'asc')->get();
        return view('admin.index', ['items' => $items]);
    }

    public function getItem( $id) {
        $item = Item::where('id', '=', $id)->with('likes')->with('comments')->first();
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

    public function postComments( Request $request) {
        $this->validate($request, [
            'comment' => 'required|min:1'
        ]);
        if (Auth::check()) {
            $comment = new Comment([
                'comment' => $request->input('comment'),
                'name' => $request->input('name'),
                'user_id' => $request->input('user_id'),
                'item_id' => $request->input('item_id'),
            ]);

            $comment->save();
            return redirect()->back();
        }
        else {
            return back()->withInput()->with('error', 'Something wrong');
        }
    }

    public function postReplies(Request $request)
    {
        $this->validate($request, [
            'reply' => 'required|min:1'
        ]);
        if (Auth::check()) {
            $reply = new Reply([
                'comment_id' => $request->input('comment_id'),
                'name' => $request->input('name'),
                'reply' => $request->input('reply'),
                'user_id' => Auth::user()->id
            ]);
            $reply->save();
            return redirect()->back();
        }

        return back()->withInput()->with('error','Something wronmg');

    }

    public function deleteComment($id) {
        if (Auth::check()) {
            $comment = Comment::find($id);
            $comment->delete();
            return redirect()->back();
        }
    }

    public function deleteReply(Item $reply)
    {
        if (Auth::check()) {
            $reply = Reply::where(['id'=>$reply->id,'user_id'=>Auth::user()->id]);
            if ($reply->delete()) {
                return 1;
            }else{
                return 2;
            }
        }else{

        }
        return 3;
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
        $item->tags()->detach();
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
