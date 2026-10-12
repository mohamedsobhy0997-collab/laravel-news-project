@extends('layouts.frontend.app')
@section('body')
@section('title')
    Notification
@endsection
           <!-- Dashboard Start-->
       <div class="dashboard container">
       
          <!-- Sidebar Menu -->
          <aside class="col-md-3 nav-sticky dashboard-sidebar">
            
        <!-- User Info Section -->
        <div class="user-info text-center p-3">
          <img
            src="{{asset(auth()->user()->image)}}"
            alt="User Image"
            class="rounded-circle mb-2"
            style="width: 80px; height: 80px; object-fit: cover"
          />
          <h5 class="mb-0" style="color: #ff6f61">{{auth()->user()->name}}</h5>
        </div>

        <!-- Sidebar Menu -->
        <div class="list-group profile-sidebar-menu">
          <a
            href="{{route('frontend.dashboard.profile')}}"
            class="list-group-item list-group-item-action menu-item"
            data-section="profile"
          >
            <i class="fas fa-user"></i> Profile
          </a>
          <a
            href="{{route('frontend.dashboard.notification.index')}}"
            class="list-group-item list-group-item-action menu-item"
            data-section="notifications"
          >
            <i class="fas fa-bell"></i> Notifications
          </a>
          <a
            href="{{route('frontend.dashboard.setting')}}"
            class="list-group-item list-group-item-action active menu-item"
            data-section="settings"
          >
            <i class="fas fa-cog"></i> Settings
          </a>
        </div>
      </aside>

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
            <div class="row">
                <div class="col-6">
                    <h2 class="mb-4">Notifications</h2>
                </div>
                <div class="col-6">
                    <a href="{{route('frontend.dashboard.notification.deleteAll')}}" class="btn btn-sm btn-danger">Delete All</a>
                </div>
                
              @forelse (auth()->user()->notifications()->take(2)->get() as $notify )
                 <a href="{{$notify->data['link']}}?notify={{$notify->id}}">
                <div class="notification alert alert-success">
                    <strong>You have post: {{$notify->data['user_name']}}</strong> This is a success notification:{{$notify->data['post_title']}}<br><br>
                    {{$notify->created_at->diffForHumans()}}
                    <div class="float-right">
                        <button onclick="if(confirm('عايز تمسح ولا لا هاا')){document.getElementById('notifydelete').submit(); return false}" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </div>
               </a>
               <form id="notifydelete" action="{{route('frontend.dashboard.notification.delete')}}" method="post">
                @csrf
                <input type="hidden" name="notify_id" value="{{$notify->id}}">

                </form>
              @empty
                
              @endforelse
              
            </div>
        </div>
      </div>
     </div>
      <!-- Dashboard End-->

@endsection