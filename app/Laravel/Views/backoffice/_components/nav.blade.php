<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper">
        <a class="left-sidebar-toggle" href="#">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">Menu</li>

                        <li class="{{ active_class(if_route(['backoffice.dashboard']), 'active') }}">
                            <a href="{{route('backoffice.dashboard')}}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                        </li>

                        <li class="divider">School Management</li>

                        @if(in_array(Auth::user()->type, ['teacher']))
                        <li class="{{ active_class(if_route(['backoffice.class_record.index']), 'active') }}">
                            <a href="{{route('backoffice.class_record.index')}}"><i class="icon fa fa-book"></i><span>My Class Record</span></a>
                        </li>
                        <li class="{{ active_class(if_route(['backoffice.advisory_class.index']), 'active') }}">
                            <a href="{{route('backoffice.advisory_class.index')}}"><i class="icon fa fa-user"></i><span>My Advisory Class</span></a>
                        </li>
                        @endif

                        @if(in_array(Auth::user()->type, ['admin','super_user']))

                        <li class="parent {{ active_class(if_route(['backoffice.sections.index','backoffice.sections.create','backoffice.sections.edit','backoffice.sections.destroy',]), 'active open') }}">
                            <a href="#"><i class="icon fa fa-university"></i><span>Sections</span></a>
                            <ul class="sub-menu">
                                <li class="{{ active_class(if_route(['backoffice.sections.index',]), 'active open') }}">
                                    <a href="{{route('backoffice.sections.index')}}">All Records</a>
                                </li>
                                <li class="{{ active_class(if_route(['backoffice.sections.create',]), 'active open') }}">
                                    <a href="{{route('backoffice.sections.create')}}">Create New</a>
                                </li>
                            </ul>
                        </li>

                        <li class="parent {{ active_class(if_route(['backoffice.subjects.index','backoffice.subjects.create','backoffice.subjects.edit','backoffice.subjects.destroy',]), 'active open') }}">
                            <a href="#"><i class="icon fa fa-book"></i><span>Subjects</span></a>
                            <ul class="sub-menu">
                                <li class="{{ active_class(if_route(['backoffice.subjects.index',]), 'active open') }}">
                                    <a href="{{route('backoffice.subjects.index')}}">All Records</a>
                                </li>
                                <li class="{{ active_class(if_route(['backoffice.subjects.create',]), 'active open') }}">
                                    <a href="{{route('backoffice.subjects.create')}}">Create New</a>
                                </li>
                            </ul>
                        </li>

                        <li class="parent {{ active_class(if_route(['backoffice.classes.index','backoffice.classes.create','backoffice.classes.edit','backoffice.classes.destroy',]), 'active open') }}">
                            <a href="#"><i class="icon fa fa-users"></i><span>Classes</span></a>
                            <ul class="sub-menu">
                                <li class="{{ active_class(if_route(['backoffice.classes.index',]), 'active open') }}">
                                    <a href="{{route('backoffice.classes.index')}}">Year Level</a>
                                </li>
                                <li class="{{ active_class(if_route(['backoffice.classes.create',]), 'active open') }}">
                                    <a href="{{route('backoffice.classes.create')}}">Create New</a>
                                </li>
                            </ul>
                        </li>

                        <li class="parent {{ active_class(if_route(['backoffice.students.index','backoffice.students.create','backoffice.students.edit','backoffice.students.destroy',]), 'active open') }}">
                            <a href="#"><i class="icon fa fa-user"></i><span>Students</span></a>
                            <ul class="sub-menu">
                                <li class="{{ active_class(if_route(['backoffice.students.index',]), 'active open') }}">
                                    <a href="{{route('backoffice.students.index')}}">All Records</a>
                                </li>
                                <li class="{{ active_class(if_route(['backoffice.students.create',]), 'active open') }}">
                                    <a href="{{route('backoffice.students.create')}}">Create New</a>
                                </li>
                            </ul>
                        </li>
                        
                        {{-- <li class="divider">School Documents</li> --}}

                        <li class="{{ active_class(if_route(['backoffice.documents.school_data']), 'active') }}">
                            <a href="{{route('backoffice.documents.school_data')}}"><i class="icon fa fa-file-text"></i><span>Generate School Documents</span></a>
                        </li>

                        {{-- <li class="{{ active_class(if_route(['backoffice.documents.generate_conso']), 'active') }}">
                            <a href="{{route('backoffice.documents.generate_conso')}}"><i class="icon fa fa-file-text-o"></i><span>Consolidated</span></a>
                        </li> --}}
                        {{-- <li class="{{ active_class(if_route(['backoffice.documents.sf1']), 'active') }}">
                            <a href="{{route('backoffice.documents.sf1')}}"><i class="icon fa fa-file-text-o"></i><span>School Form 1 (SF1)</span></a>
                        </li> --}}
                        
                        {{-- <li class="{{ active_class(if_route(['backoffice.documents.conso']), 'active') }}">
                            <a href="{{route('backoffice.documents.conso')}}"><i class="icon fa fa-file-text-o"></i><span>Conso</span></a>
                        </li> --}}
        
                        <li class="divider">User Management</li>
                        <li class="parent {{ active_class(if_route(['backoffice.teachers.index','backoffice.teachers.create','backoffice.teachers.edit','backoffice.teachers.destroy',]), 'active open') }}">
                            <a href="#"><i class="icon fa fa-user-secret"></i><span>Faculties</span></a>
                            <ul class="sub-menu">
                                <li class="{{ active_class(if_route(['backoffice.teachers.index',]), 'active open') }}">
                                    <a href="{{route('backoffice.teachers.index')}}">All Records</a>
                                </li>
                                <li class="{{ active_class(if_route(['backoffice.teachers.create',]), 'active open') }}">
                                    <a href="{{route('backoffice.teachers.create')}}">Create New</a>
                                </li>
                            </ul>
                        </li>
                        <li class="parent {{ active_class(if_route(['backoffice.employee.index','backoffice.employee.create','backoffice.employee.edit','backoffice.employee.destroy',]), 'active open') }}">
                            <a href="#"><i class="icon mdi mdi-face"></i><span>Administrators</span></a>
                            <ul class="sub-menu">
                                <li class="{{ active_class(if_route(['backoffice.employee.index',]), 'active open') }}">
                                    <a href="{{route('backoffice.employee.index')}}">All Records</a>
                                </li>
                                <li class="{{ active_class(if_route(['backoffice.employee.create',]), 'active open') }}">
                                    <a href="{{route('backoffice.employee.create')}}">Create New</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        {{-- <div class="progress-widget">
            <div class="progress-data">
                <span class="progress-value">60%</span><span class="name">Current Project</span>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-primary" style="width: 60%;"></div>
            </div>
        </div> --}}
    </div>
</div>