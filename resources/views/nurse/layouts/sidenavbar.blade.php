<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ (Auth::user()->image) ? Storage::disk('local')->url(Auth::user()->image) : asset('/admin_styles/images/user4-128x128.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">       



         <li class="treeview">

       <li class="{{ App\Navigation::setActive('nurse.home') }}">
          <a href="{{ route('nurse.home') }}"><i class="fa fa-circle text-green"></i> <span>Home</span></a>
        </li>
        <li class="{{ App\Navigation::setActive('nurse.profile') }}">
          <a href="{{ route('nurse.profile') }}"><i class="fa fa-circle text-red"></i> <span>Profile</span></a>
        </li>

         <li><a href="{{ route('nurse.reservations') }}"><i class="fa fa-circle text-blue"></i> <span>Reservations</span></a></li>

        <li class="treeview {{ App\Navigation::setActive('nurse.patient.view') }} {{ App\Navigation::setActive('nurse.patient.add') }}">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Patients</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('nurse.patient.view') }}">
              <a href="{{ route('nurse.patient.view') }}"><i class="fa fa-circle text-red"></i> View</a>
            </li>
            <li class="{{ App\Navigation::setActive('nurse.patient.add') }}">
              <a href="{{ route('nurse.patient.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a>
            </li>
          </ul>
        </li>

        <li class="treeview {{ App\Navigation::setActive('nurse.invoice.view') }} {{ App\Navigation::setActive('nurse.invoice.add') }}">
          <a href="#">
            <i class="fa fa-file-alt"></i>
            <span>Invoices</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('nurse.invoice.view') }}">
            <a href="{{ route('nurse.invoice.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li class="{{ App\Navigation::setActive('nurse.invoice.add') }}">
            <a href="{{ route('nurse.invoice.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>

        <li class="treeview {{ App\Navigation::setActive('nurse.admin.times') }} {{ App\Navigation::setActive('nurse.nurse.times') }}">
          <a href="#">
            <i class="fa fa-clock"></i>
            <span>Working Times</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('nurse.admin.times') }}">
              <a href="{{ route('nurse.admin.times') }}"><i class="fa fa-circle text-red"></i> Doctors</a>
            </li>
            <li class="{{ App\Navigation::setActive('nurse.nurse.times') }}">
              <a href="{{ route('nurse.nurse.times') }}"><i class="fa fa-circle text-aqua"></i> Nurses</a>
            </li>
          </ul>
        </li>


      </ul>


    </section>
    <!-- /.sidebar -->
  </aside>