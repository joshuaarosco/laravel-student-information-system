    <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
            <div class="navbar-header">
            </div>
            <div class="be-right-navbar">
                <ul class="nav navbar-nav navbar-right be-user-nav">
                    <li class="dropdown">
                        <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"><img alt="Avatar" src="{{asset('backoffice/assets/img/avatar.png')}}"><span class="user-name">{{AUTH::user()->fname}} {{AUTH::user()->lname}}</span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <div class="user-info">
                                    <div class="user-name">
                                        {{AUTH::user()->fname}} {{AUTH::user()->lname}}
                                    </div>
                                    <div class="user-position online">
                                        Available
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="{{route('backoffice.profile.settings')}}"><span class="icon mdi mdi-settings"></span> Setting</a>
                            </li>
                            <li>
                                <a href="{{route('backoffice.logout')}}"><span class="icon mdi mdi-power"></span> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="page-title">
                    <span>Dashboard</span>
                </div>
                <ul class="nav navbar-nav navbar-right be-icons-nav">
                </ul>
            </div>
        </div>
    </nav>