@extends('layouts.app')

@section('content')
    <div class="container">
        @extends('layouts.sidebar')
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
    <script>
        // -------multilevel-accordian-menu---------
        $(document).ready(function() {
            $("#accordian a").click(function() {
                var link = $(this);
                var closest_ul = link.closest("ul");
                var parallel_active_links = closest_ul.find(".active")
                var closest_li = link.closest("li");
                var link_status = closest_li.hasClass("active");
                var count = 0;

                closest_ul.find("ul").slideUp(function() {
                    if (++count == closest_ul.find("ul").length) {
                        parallel_active_links.removeClass("active");
                        parallel_active_links.children("ul").removeClass("show-dropdown");
                        link.not().children("ul").removeClass(".active");
                    }
                });

                if (!link_status) {
                    closest_li.children("ul").slideDown().addClass("show-dropdown");
                    closest_li.addClass("active");
                }

            })
        });






        // --------for-active-class-on-other-page-----------
        jQuery(document).ready(function($) {
            // Get current path and find target link
            var path = window.location.pathname.split("/").pop();

            // Account for home page with empty path
            if (path == '') {
                path = 'index.html';
            }

            var target = $('#accordian li a[href="' + path + '"]');
            // Add active class to target link
            target.parents("li").addClass('active');
            target.parents("ul").addClass("show-dropdown");
        });

    </script>
@endsection
