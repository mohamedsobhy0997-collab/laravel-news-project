@extends('layouts.frontend.app')
@section('title')
Setting
@endsection

@section('body')

  <!-- Dashboard Start-->

    <div class="dashboard container">
      <!-- Sidebar -->
      @include('frontend.dashboard._sidebar' ,['setting_active'=>'active'])


      <!-- Main Content -->
      <div class="main-content">
        <!-- Settings Section -->
        <!-- <section id="settings" class="content-section"> -->
          <section id="settings" class="content-section" style="display: block !important;">
          <h2>Settings</h2>
          <form action="{{route('frontend.dashboard.setting.update')}}" method="post" class="settings-form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="username">Name:</label>
              <input name="name" type="text" id="username" value="{{$user->name}}" />
              @error('name')
              <small>{{$message}}</small>
              @enderror
            </div>
              <div class="form-group">
              <label for="username">Username:</label>
              <input name="username" type="text" id="username" value="{{$user->username}}" />
                @error('username')
              <small>{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input name="email" type="email" id="email" value="{{$user->email}}" />
                @error('email')
              <small>{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="profile-image">Profile Image:</label>
              <input name="image" type="file" id="profile-image" accept="image/*" />
    
            </div>
            <div class="form-group">
              <label for="country">Country:</label>
              <input
                name="country"
                type="text"
                id="country"
                placeholder="Enter your country"
                value="{{$user->country}}"
              />
                @error('country')
              <small>{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="city">City:</label>
              <input name="city" type="text" id="city" value="{{$user->city}}" placeholder="Enter your city" />
                @error('city')
              <small>{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="street">Street:</label>
              <input name="street" type="text" id="street" value="{{$user->street}}" placeholder="Enter your street" />
                @error('street')
              <small>{{$message}}</small>
              @enderror
            </div>
              <div class="form-group">
              <label for="street">Phone:</label>
              <input name="phone" type="text" id="phone" value="{{$user->phone}}" placeholder="Enter your Phone" />
                @error('phone')
              <small>{{$message}}</small>
              @enderror
            </div>
            
          
            <button type="submit" class="save-settings-btn">
              Save Changes
            </button>
          </form>

          <!-- Form to change the password -->
          <form action="{{route('frontend.dashboard.setting.changePassword')}}" method="post" class="change-password-form">
            @csrf
            <h2>Change Password</h2>
            <div class="form-group">
              <label for="current-password">Current Password:</label>
              <input
                type="password"
                id="current-password"
                placeholder="Enter Current Password"
                name="current_password"
              />
              @error('current_password')
              <strong>{{$message}}</strong>
              @enderror
            </div>
            <div class="form-group">
              <label for="new-password">New Password:</label>
              <input
                type="password"
                id="new-password"
                placeholder="Enter New Password"
                name="password"
              />
               @error('password')
              <strong>{{$message}}</strong>
              @enderror
            </div>
            <div class="form-group">
              <label for="confirm-password">Confirm New Password:</label>
              <input
                type="password"
                id="confirm-password"
                placeholder="Enter Confirm New "
                name="password_confirmation"
              />
               @error('password-confirmation')
              <strong>{{$message}}</strong>
              @enderror
            </div>
            <button type="submit" class="change-password-btn">
              Change Password
            </button>
          </form>
        </section>
      </div>
    </div>

    <!-- Dashboard End-->

@endsection