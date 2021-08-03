@extends('layouts.app')

@section('content')

    <div class="container">
        
           <form action="/users/update/{{$user->id}}" method="POST">
            @csrf
            <div class="row align-items-center">
                <div class="row col-6">
                    <label for="">Name:
                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                </label>
                </div>
                <div class="row col-6">
                    <label for="">E-mail:
                    <input type="text" name="email" class="form-control" value="{{$user->email}}"></label>
                </div>
                <div class="row col-6">
                    <label for="">Age:
                    <input type="text" name="age" class="form-control" value="{{$user->age}}"></label>
                </div>
                <div class="row col-6">
                    <label for="">Code:
                    <input type="text" class="form-control" value="{{$user->referral_code}}" disabled></label>
                </div>
                <div class="row col-6">
                    <label for="">Status:
                    <select name="status" id="status" class="form-control">
                        <option value="0" {{$user->status ? '' : 'selected'}}>Not Active</option>
                        <option value="1" {{$user->status ? 'selected' : ''}}> Active</option>
                    </select>
                </div>
                <div class="row col-12" >
                    <button type="submit"  class="btn btn-primary">Save</button>
                </div>
           </form>
    </div>

@endsection
