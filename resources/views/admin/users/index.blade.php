@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
            <h3 style="padding: 10px">Users</h3>

            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Email</th>
                    <th scope="col">Code</th>
                    <th scope="col">Status</th>
                    <th scope="col">Options</th>
                  </tr>
                </thead>
                <tbody>
                    @if($users->count() > 0)
                    @php
                        $i = 0;
                    @endphp
                        @foreach ($users as $user)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->age}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->referral_code}}</td>
                            <td>{{$user->status ? 'Active' : 'Not Active'}}</td>
                            <td>

                                <a href="users/edit/{{$user->id}}" class="btn btn-primary">Edit</a>
                                <a href="users/delete/{{$user->id}}" class="btn btn-danger">Delete</a>

                            </td>

                        </tr>
                        @endforeach

                    @endif


                </tbody>
              </table>
        </div>

</div>

@endsection
