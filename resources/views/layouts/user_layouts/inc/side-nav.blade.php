<!-- Sidebar -->
         <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - BRAND -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
               <div class="sidebar-brand-icon">
                  <span class="text-light">getThrills Stream</span>
               </div>
               <!-- <div class="sidebar-brand-text mx-3"><img src="{{ asset('asset/img/logo-bg.jpg') }}" alt="" height="auto" width="45rem"></div> -->
            </a>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/">
                <i class="fas fa-fw fa-home"></i>
                <span>Home</span></a>
             </li>
           
           
            <li class="nav-item">
               <a class="nav-link" href="{{ route('movies.all') }}">
               <i class="fas fa-fw fa-film"></i>
               <span>Movies</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('series.all') }}">
               <i class="fas fa-fw fa-tv"></i>
               <span>TV Series</span></a>
            </li>
           

          
         </ul>
         <!-- End of Sidebar -->
