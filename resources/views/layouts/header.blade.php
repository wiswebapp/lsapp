<div class="header">  
  <div class="container">
    <div class="logo">
      <a href="/"><img style="max-width:270px;max-height:169px;" src="{{asset('images/logo.png')}}" title="" /></a>
    </div>
    <div class="top-menu">
        <div class="search">
          <form action="/search">
            <input type="text" placeholder="Press Enter to search" name="param" required="">
            <input type="submit" value=""/>
          </form>
        </div>
        <span class="menu"> </span> 
        <ul>
           <li><a href="/blog">Home</a></li>
           @guest
           <li><a href="{{ route('login') }}">Login</a></li>
           <li><a href="{{ route('register') }}">Register</a></li>
           @else
           <li><a href="{{ route('my.blogs') }}">My Blogs</a></li>
           <li><a style="cursor: pointer" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
           <a href="/profile" class="btn btn-primary">Welcome {{Auth::user()->name}}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
            @endguest
           <div class="clearfix"> </div>
        </ul>
      </div>
      <div class="clearfix"></div>
  </div>
</div>