@extends('layouts.app')
@section('content')


    <div class="container">
        {{-- action="/users/update/{{$user->id}}" method="POST" --}}
        <h1 style="color: white; overflow: hidden; text-align: center">Edit Game</h1>


        <div class="edit-questions">
            <form id="question-form" method="POST" action="/games/update/{{ $game->id }}">
                @csrf
                <div class="step-one">
                    <div class="col-12">
                        <label for="">Title:
                            <input type="text" name="title" id="title" value="{{ $game->name }}" class="form-control"
                                required>
                        </label>
                    </div>

                    <div class="col-12">
                        <label for="">Status:
                            <select name="status" id="status" class="form-control" required>
                                <option value="0" {{ $game->status ? '' : 'selected' }}>Not Active</option>
                                <option value="1" {{ $game->status ? 'selected' : '' }}> Active</option>
                            </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg">Edit</button>
                    </div>
                </div>

            </form>
                    <div class="advance-option" >
                        <div id="show-hidden-menu">
                            <h3>Advance Options
                            </h3>
                            <img class="arro-down" src="/icons/down-arrow.png" alt="">
                        </div>
                        <div class="attributes" style="display: none;">
                            <form action="/games/update-attributes/{{ $game->id }}" method="POST">
                                @csrf
                                <div class="form-group" style="width: 89%;">
                                    <label for="exampleInputEmail1">Numbers of attempts</label>
                                    <input type="number" name="attempts" class="form-control" id="exampleInputEmail1" value= "{{$game->attributes ? $game->attributes->attempts : 0 }}">
                                    <small id="emailHelp" class="form-text text-muted">
                                        how many times users can play game in a day</small>
                                </div>
                                <div class="form-group" style="width: 89%;">
                                    <label for="exampleInputEmail1">Ads Numbers</label>
                                    <input type="number" name="ads_count" class="form-control" id="exampleInputEmail1" value= "{{$game->attributes ? $game->attributes->ads_count : 0 }}">
                                    <small id="emailHelp" class="form-text text-muted">Number of adds user can show</small>
                                </div>
                                <div class="form-group" style="width: 89%;">
                                    <label for="exampleInputEmail1">Points per one try</label>
                                    <input type="number" name="points_per_try" class="form-control" id="exampleInputEmail1" value= "{{$game->attributes ? $game->attributes->points_per_try : 0 }}">
                                    <small id="emailHelp" class="form-text text-muted">this is amount of points per one try</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>


        </div>

    </div>
@endsection
