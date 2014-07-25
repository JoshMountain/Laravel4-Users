<ul class="nav nav-sidebar">
    <li><a href="{{ URL::route('home') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>

    @if( Auth::check() )

    @else
        <li><a href="{{ URL::route('account-sign-in') }}"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
        <li><a href="{{ URL::route('account-create') }}"><span class="glyphicon glyphicon-user"></span> Create Account</a></li>
    @endif
</ul>

<ul class="nav nav-sidebar">
    <li><a href="">Nav item</a></li>
    <li><a href="">Nav item again</a></li>
    <li><a href="">One more nav</a></li>
    <li><a href="">Another nav item</a></li>
    <li><a href="">More navigation</a></li>
</ul>

<p id="copyright">
    This is <a href="#">Item Manager</a> 1.0.0
</p>