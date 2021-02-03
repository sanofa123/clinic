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
        <li class="{{ App\Navigation::setActive('admin.home') }}">
          <a href="{{ route('admin.home') }}"><i class="fa fa-circle text-green"></i> <span>Home</span></a>
        </li>
        <li class="{{ App\Navigation::setActive('admin.profile') }}">
          <a href="{{ route('admin.profile') }}"><i class="fa fa-circle text-red"></i> <span>Profile</span></a>
        </li>
        <li class="{{ App\Navigation::setActive('admin.profile') }}">
          <a href="{{ route('admin.reservations') }}"><i class="fa fa-circle text-blue"></i> <span>Reservations</span></a>
        </li>
        @if(Auth::user()->role == "super")
          <li class="{{ App\Navigation::setActive('admin.statistics') }}">
            <a href="{{ route('admin.statistics') }}"><i class="fa fa-circle text-purple"></i> <span>statistics</span></a>
          </li>
        @endif

        <li class="treeview {{ App\Navigation::setActive('admin.patient.view') }} {{ App\Navigation::setActive('admin.patient.add') }}">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Patients</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('admin.patient.view') }}">
              <a href="{{ route('admin.patient.view') }}"><i class="fa fa-circle text-red"></i> View</a>
            </li>
            <li class="{{ App\Navigation::setActive('admin.patient.add') }}">
              <a href="{{ route('admin.patient.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a>
            </li>
          </ul>
        </li>

        <li class="treeview {{ App\Navigation::setActive('admin.nurse.view') }} {{ App\Navigation::setActive('admin.nurse.add') }}">
          <a href="#">
            <i class="fa fa-user-md"></i>
            <span>Nurses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('admin.nurse.view') }}">
              <a href="{{ route('admin.nurse.view') }}"><i class="fa fa-circle text-red"></i> View</a>
            </li>
            <li class="{{ App\Navigation::setActive('admin.nurse.add') }}">
              <a href="{{ route('admin.nurse.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a>
            </li>
          </ul>
        </li>

        @if(Auth::user()->role == "super")
            <li class="treeview {{ App\Navigation::setActive('admin.admin.view') }} {{ App\Navigation::setActive('admin.admin.add') }}">
              <a href="#">
                <i class="fa fa-stethoscope"></i>
                <span>Admins</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ App\Navigation::setActive('admin.admin.view') }}">
                  <a href="{{ route('admin.admin.view') }}"><i class="fa fa-circle text-red"></i> View</a>
                </li>
                <li class="{{ App\Navigation::setActive('admin.admin.add') }}">
                  <a href="{{ route('admin.admin.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a>
                </li>
              </ul>
            </li>
        @endif


        <li class="treeview {{ App\Navigation::setActive('admin.admin.times') }} {{ App\Navigation::setActive('admin.nurse.times') }}">
          <a href="#">
            <i class="fa fa-clock"></i>
            <span>Working Times</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('admin.admin.times') }}">
              <a href="{{ route('admin.admin.times') }}"><i class="fa fa-circle text-red"></i> Doctors</a>
            </li>
            <li class="{{ App\Navigation::setActive('admin.nurse.times') }}">
              <a href="{{ route('admin.nurse.times') }}"><i class="fa fa-circle text-aqua"></i> Nurses</a>
            </li>
          </ul>
        </li>


        <li class="treeview {{ App\Navigation::setActive('admin.clinic.view') }} {{ App\Navigation::setActive('admin.clinic.add') }}">
          <a href="#">
            <i class="fa fa-hospital"></i>
            <span>Clinics</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('admin.clinic.view') }}">
              <a href="{{ route('admin.clinic.view') }}"><i class="fa fa-circle text-red"></i> View</a>
            </li>
            <li class="{{ App\Navigation::setActive('admin.clinic.add') }}">
              <a href="{{ route('admin.clinic.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a>
            </li>
          </ul>
        </li>

        <li class="treeview {{ App\Navigation::setActive('admin.worker.view') }} {{ App\Navigation::setActive('admin.worker.add') }}">
          <a href="#">
            <i class="fa fa-briefcase"></i>
            <span>Workers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('admin.worker.view') }}">
              <a href="{{ route('admin.worker.view') }}"><i class="fa fa-circle text-red"></i> View</a>
            </li>
            <li class="{{ App\Navigation::setActive('admin.worker.add') }}">
              <a href="{{ route('admin.worker.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a>
            </li>
          </ul>
        </li>


        <li class="treeview {{ App\Navigation::setActive('admin.category.view') }} {{ App\Navigation::setActive('admin.category.add') }}">
          <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Categories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('admin.category.view') }}">
            <a href="{{ route('admin.category.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li class="{{ App\Navigation::setActive('admin.category.add') }}">
            <a href="{{ route('admin.category.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>

        <li class="treeview {{ App\Navigation::setActive('admin.material.view') }} {{ App\Navigation::setActive('admin.material.add') }}">
          <a href="#">
            <i class="fa fa-medkit"></i>
            <span>Materials</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('admin.material.view') }}">
            <a href="{{ route('admin.material.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li class="{{ App\Navigation::setActive('admin.material.add') }}">
            <a href="{{ route('admin.material.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>


        <li class="treeview {{ App\Navigation::setActive('admin.invoice.view') }} {{ App\Navigation::setActive('admin.invoice.add') }}">
          <a href="#">
            <i class="fa fa-file-alt"></i>
            <span>Invoices</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('admin.invoice.view') }}">
            <a href="{{ route('admin.invoice.view') }}"><i class="fa fa-circle text-red"></i> View</a></li>
            <li class="{{ App\Navigation::setActive('admin.invoice.add') }}">
            <a href="{{ route('admin.invoice.add') }}"><i class="fa fa-circle text-aqua"></i> Add</a></li>
          </ul>
        </li>

        <li class="treeview {{ App\Navigation::setActive('admin.inbox') }} {{ App\Navigation::setActive('admin.patient.email') }} {{ App\Navigation::setActive('admin.email.show') }}">
          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>Emails</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ App\Navigation::setActive('admin.inbox') }}">
              <a href="{{ route('admin.inbox') }}"><i class="fa fa-circle text-red"></i> Inbox</a>
            </li>
            <li class="{{ App\Navigation::setActive('admin.patient.email') }}">
              <a href="{{ route('admin.patient.email') }}"><i class="fa fa-circle text-aqua"></i> Send</a>
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>