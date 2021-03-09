<div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{route('admin.dashboard')}}">
                        <div class="sb-nav-link-icon"><i class="fa fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="{{route('post.index')}}">
                        <div class="sb-nav-link-icon">
                            <i class="fa fa-tachometer-alt"></i>
                        </div>Blogs
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            @can('View Blog')
                            <a class="nav-link" href="{{route('post.index')}}">List Blog</a>
                            @endcan
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                @role ('Super Admin')
                    Super Admin
                @elseif ('Reviewer Admin')
                    Reviewer Admin
                @endrole
            </div>
        </nav>
    </div>