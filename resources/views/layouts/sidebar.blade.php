<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu mt-3">
            <div class="nav">
                <a class="nav-link {{Request::is('/')?'active':''}}" href="{{route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
            </div>
            <div class="nav">
                <a class="nav-link {{Request::is('products*')?'active':''}}" href="{{ route('products.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    products
                </a>
            </div>
         
	
        </div>
    
    </nav>
</div>