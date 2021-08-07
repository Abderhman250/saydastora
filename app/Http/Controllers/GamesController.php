<?php

namespace App\Http\Controllers;

use App\Games;
use App\GameAttribute;
use App\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Games::all();
       return view ('admin.games.index',['games'=>$games]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function show(Games $games)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $game = Games::findOrFail($id);
        if($game){

            return view('admin.games.edit',['game'=>$game]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $game = Games::findOrFail($id);
        if($game){
            $game->name = $request->title;
            $game->status = $request->status;
            $game->save();

            return redirect('/games')->with('success','Game Update Successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function destroy(Games $games)
    {
        //
    }

    public function updateAttributes(Request $request, $id)
    {
        $game = Games::find($id);
        if(isset($game->attributes)){
            $game->attributes->attempts = $request->attempts ;
            $game->attributes->ads_count = $request->ads_count ;
            $game->attributes->points_per_try = $request->points_per_try ;

            $game->attributes->save();
            return redirect('/games')->with('success','Game Attributes Update Successfully.');

        }

        $attributes = new GameAttribute();
        $attributes->game_id = $id ;
        $attributes->attempts = $request->attempts ;
        $attributes->ads_count = $request->ads_count ;
        $attributes->points_per_try = $request->points_per_try ;

        $attributes->save();
        return redirect('/games')->with('success','Game Attributes Update Successfully.');

    }

    public function joinGame (Request $request)
    {
        if(Auth::user()){
            $game = Games::findOrFail($request->game_id);

            if($game->status){
                $data = [];

                $data['user'] = Auth::user();
                $attempts = session()->get('join.attempts', 0);
                $adds = session()->get('join.adds', 0);
                if($attempts >= $game->attributes->attempts){
                    if($adds >= $game->attributes->ads_count ){
                        $data['can_view_adds'] = false;
                        $data['can_join_game'] = false;
                        return response()->json([$data,'msg'=>'لقد تجاوزت الحد الاعلى للمحاولات .. حاول غدا '], 401);
                    }

                    $data['can_view_adds'] = true;
                    $data['can_join_game'] = false;
                    session()->put('join.adds', $adds + 1);

                     $data['questions'] = Questions::where('status',1)->with('answers')->get();

                    return response()->json([$data], 200);


                }

                session()->put('join.attempts', $attempts + 1);

                $data['can_view_adds'] = true ;
                $data['can_join_game'] = true ;
                $data['questions'] = Questions::where('status',1)->with('answers')->get();
                return response()->json([$data], 200);


            }
        }
    }

    public function viewAdds(Request $request)
    {
        // sdfgdsf sdgfsdfg sdfgsdfgsd sdfgsdfgsdf sdfgsdfg
        if(Auth::user()) {
            // want parameter from mobile to insure validations (if user complete the adds )
            session()->put('join.attempts',0);

            return response()->json(['msg'=>'لقد حصلت على محاولات اضافية'], 200);

        }
    }


}
