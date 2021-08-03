@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3 style="padding: 10px">Games attributes</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Numbers of attempts</th>
                        <th scope="col">Ads Numbers</th>
                        <th scope="col">Points per one try</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($games->count() > 0)
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($games as $game)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $game->name }}</td>

                                <td>{{ $game->status ? 'Active' : 'Not Active' }}</td>
                                <td>{{$game->attributes ? $game->attributes->attempts : 0 }}</td>
                                <td>{{$game->attributes ? $game->attributes->ads_count : 0 }}</td>
                                <td>{{$game->attributes ? $game->attributes->points_per_try : 0 }}</td>
                                <td>

                                    <a href="games/edit/{{ $game->id }}" class="btn btn-primary">Edit</a>
                                    <a href="games/delete/{{ $game->id }}" class="btn btn-danger">Delete</a>

                                </td>

                            </tr>
                        @endforeach

                    @endif


                </tbody>
            </table>
        </div>

    </div>

@endsection
