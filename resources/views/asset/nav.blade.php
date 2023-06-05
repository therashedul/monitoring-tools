     {{-- {{ $menus }} --}}
     <div class="col-md-3 left_col">
         <div class="left_col scroll-view">
             <div class="navbar nav_title" style="border: 0;">
                 <a href="{{ url('/') }}" class="site_title"><span>Dashaboard</span></a>
             </div>

             <div class="clearfix"></div>
             <br />

             <!-- sidebar menu -->
             <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                 <div class="menu_section">

                     <ul class="nav side-menu">
                         <li><a href="{{ url('/') }}"> Home </a> </li>
                         @if (Auth::user()->role_id == '1')
                             <li><a href="{{ route('services') }}">Service</a></li>
                             <li><a href="{{ route('revenew') }}">Revenew</a></li>

                             <li><a href="{{ route('activation') }}">Activation</a></li>
                             <li><a href="{{ route('revenue.report') }}">Revenue Report</a></li>
                             <li><a href="{{ route('activation.report') }}">Activation Report</a></li>
                             <li><a href="{{ route('users') }}">Users</a></li>
                             <li><a href="{{ route('csv.upload') }}">Revenue CSV Upload</a></li>
                             <li><a href="{{ route('adcsv.upload') }}">Activion CSV Upload</a></li>
                         @elseif(Auth::user()->role_id == '2')
                             <li><a href="{{ route('revenue.report') }}">Revenue Report</a></li>
                             <li><a href="{{ route('activation.report') }}">Activation Report</a></li>
                         @endif

                         </li>

                     </ul>
                 </div>
             </div>
             <!-- /sidebar menu -->

             <!-- /menu footer buttons -->
             <div class="sidebar-footer hidden-small">
                 <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();"
                     style="width: 100%; color:#fff;">
                     <span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
             </div>
             <!-- /menu footer buttons -->
         </div>
     </div>
