<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
                <a href="{{ route('vendor.dashboard',[Auth::user()->username]) }}" class="nav-link has-dropdown"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>
            <li class="menu-header">Starter</li>

            <li
                class="dropdown {{ setActive(['vendor.category.*', 'vendor.sub-category.*', 'vendor.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Categories</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['vendor.category.*']) }}"><a class="nav-link"
                            href="{{ route('vendor.category.index', ['username' => Auth::user()->username]) }}">Category</a>
                    </li>

                    <li class="{{ setActive(['vendor.sub-category.*']) }}"><a class="nav-link"
                        href="{{ route('vendor.sub-category.index', ['username' => Auth::user()->username]) }}">Sub Category</a>
                </li>

                <li class="{{ setActive(['vendor.child-category.*']) }}"><a class="nav-link"
                    href="{{ route('vendor.child-category.index', ['username' => Auth::user()->username]) }}">Child Category</a>
            </li>



                </ul>
            </li>

            <li class="dropdown  {{ setActive(['vendor.brand.*','vendor.slider.*','vendor.products.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['vendor.brand.*']) }}"><a class="nav-link"
                            href="{{ route('vendor.brand.index', ['username' => Auth::user()->username]) }}">Brand</a>
                    </li>
                    <li class="{{ setActive(['vendor.products.*']) }}"><a class="nav-link"
                        href="{{ route('vendor.products.index', ['username' => Auth::user()->username]) }}">Product</a>
                </li>

                <li class="{{ setActive(['vendor.slider.*']) }}"><a class="nav-link"
                    href="{{ route('vendor.slider.index', ['username' => Auth::user()->username]) }}">Slider</a>
            </li>

                </ul>
            </li>




            <li class="dropdown  {{ setActive(['vendor.profile.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Settings</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['vendor.profile.*']) }}"><a class="nav-link"
                            href="{{ route('vendor.profile.index', ['username' => Auth::user()->username]) }}">Profile</a>
                    </li>

                </ul>
            </li>



            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li> --}}

        </ul>
</div>
