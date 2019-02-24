<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Discussion;

use App\Reply;

use App\User;

use Session;

use Notification;

use Auth;

class DiscussionsController extends Controller
{
    public function create(){
        return view('discuss');
    }

    public function store(Request $request){
        $this->validate($request, [
            'channel_id' => 'required',
            'content' => 'required',
            'title' => 'required',
        ]);

        $discussion = Discussion::create([
            'title' => $request->title,
            'channel_id' => $request->channel_id,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'slug' => str_slug($request->title)
        ]);

        Session::flash("success", "Discussion created successfully");
        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }



    public function show($slug){

        $d = Discussion::where('slug', $slug)->first();

        $best_answer = $d->replies()->where('best_answer', 1)->first();

        return view('discussions.show')
        ->with('d', $d)
        ->with('best_answer', $best_answer);
    }

    public function reply(Request $request, $id){

        $this->validate($request, [
            'reply' => 'required'
        ]);

        $discussion = Discussion::find($id);
        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => $request->reply
        ]);

        $reply->user->points += 50;

        $reply->user->save();

        $watchers = array();

        foreach($discussion->watchers as $watcher){
            array_push($watchers, User::find($watcher->user_id));
        }

        Notification::send($watchers, new \App\Notifications\NewReplyAdded($discussion));

        Session::flash('success', 'Replied to discussion');

        return redirect()->back();
        

    }

    public function edit($slug){
        return view('discussions.edit')->with('d', Discussion::where('slug', $slug)->first());
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'content' => 'required'
        ]);

        $discussion = Discussion::find($id);
        $discussion->content = $request->content;
        $discussion->save();
        return redirect()->route('discussion', ['slug' => $discussion->slug]);

    }


}
