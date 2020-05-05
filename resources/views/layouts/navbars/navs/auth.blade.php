<nav class="navbar navbar-expand-lg navbar-absolute navbar-white">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <!-- <a class="navbar-brand" href="#">{{ $page ?? __('Dashboard') }}</a> -->
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav">
                <li class="dropdown nav-item">
                    <a href="#" class=" dropdown-toggle nav-link" data-toggle="dropdown">
                        <img width="27" src="{{ asset('white') }}/img/support.png" alt="support image">
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class=" dropdown-toggle nav-link" data-toggle="dropdown">
                        <p class="text-support">دعم فني</p>
                    </a>
                </li>
                
                <li class="dropdown nav-item nav-profile">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <b class="caret  d-lg-block d-xl-block"></b>
                        <span class="text-common-color user-name">Mohammad </span>
                        <div class="photo">
                            <img src="{{ asset('white') }}/img/anime3.png" alt="{{ __('Profile Photo') }}">

                        </div>
                         
                    </a>
                    <ul class="dropdown-menu dropdown-navbar">
                        <li class="nav-link">
                            <a href="{{ route('profile.edit') }}" class="nav-item dropdown-item">الحساب الشخصي </a>
                        </li>

                        <li class="nav-link">
                            <a href="/admin-add" class="nav-item dropdown-item">إضافة ادمن </a>
                        </li>
                        <li class="nav-link">
                            <a href="#" class="nav-item dropdown-item">تغير كلمة السر </a>
                        </li>
                       
                        <li class="nav-link">
                            <a href="{{ route('logout') }}" class="nav-item dropdown-item" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">تسجيل خروج </a>
                        </li>
                    </ul>
                </li>
                
                
                
                <li class="separator d-lg-none"></li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('SEARCH') }}">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
        </div>
    </div>
</div>
