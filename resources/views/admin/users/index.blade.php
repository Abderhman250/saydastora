@extends('layouts.app')

@section('content')

<div class="container">
        @extends('layouts.sidebar')
        <div class="row">
            <div class="flash-message">

                @if(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
            </div>
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
			if (++count == closest_ul.find("ul").length){
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
jQuery(document).ready(function($){
  	// Get current path and find target link
  	var path = window.location.pathname.split("/").pop();

  	// Account for home page with empty path
  	if ( path == '' ) {
    	path = 'index.html';
  	}

  	var target = $('#accordian li a[href="'+path+'"]');
  	// Add active class to target link
  	target.parents("li").addClass('active');
  	target.parents("ul").addClass("show-dropdown");
});

</script>
@endsection
