<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Place;
use App\Vote;
use App\Http\Requests\CreateVoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class VotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $votes = $user->votes;

        return view('users.votes', [
            'user'      => $user,
            'votes' => $votes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        $event = Event::where('id', $event->id)->first();

        return view('votes.create', [
            'event' => $event
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVoteRequest $request, Event $event)
    {
        $user = $request->user();
        $event = Event::where('id', $event->id)->first();

        Vote::create([
            'user_id'   => $user->id,
            'event_id'   => $event->id,
            'vote' =>  $request->input('vote'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event = Event::where('id', $event->id)->first();
        $votes = $event->votes;

        return view('votes.show', [
            'event' => $event,
            'votes' => $votes
        ]);
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
    public function update(CreateVoteRequest $request, Event $event)
    {
        $user = $request->user();
        $event = Event::where('id', $event->id)->first();

        $vote = Vote::where('user_id', $user->id)->where('event_id', $event->id)->first();
        $vote->user_id = $user->id;
        $vote->event_id = $event->id;
        $vote->vote = $request->input('vote');
        $vote->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createOrEdit(CreateVoteRequest $request, Event $event)
    {

        if (!Auth::user()->VoteEvent($event)) {
            $this->store($request, $event);
        } else {
            $this->update($request, $event);
        }

        return redirect("/events/$event->id");
    }

    public function votar(CreateVoteRequest $request)
    {
        if (request()->ajax()) {
            $data = json_decode(file_get_contents("php://input"), true);
            $event_id = $data['event_id'];
            $vote = $data['vote'];
            $event = Event::where('id', $event_id)->first();
            $place = Place::where('id', $event->place_id)->first();

            if (!Auth::user()->VoteEvent($event)) {
                $this->store($request, $event);
            } else {
                $this->update($request, $event);
            }

            $commentarys = $event->commentaries;
            $votesTotal = $event->votesMean();

            return View::make('events.show', [
                'event' => $event,
                'place' => $place,
                'commentarys' => $commentarys,
                'votesTotal' => $votesTotal
            ])->render();
        } else {
            return redirect('/');
        }
    }
}
