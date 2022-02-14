<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <li>
                        <a href="{{ route('admin.dashbord') }}"><i class="ti-home"></i><span class="right-nav-text">الرئيسية</span> </a>
                    </li>
                    <!-- category -->
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#mainCat-menu">
                                <div class="pull-left">
                                    <i class="ti-user"></i>
                                    <span class="right-nav-text">الأقسام</span>
                                </div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="mainCat-menu" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{route('categories.index')}}">الاقسام</a></li>
                            </ul>
                        </li>
                    <!-- products -->
                        <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#products">
                            <div class="pull-left">
                                <i class="ti-user"></i>
                                <span class="right-nav-text">المنتجات</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="products" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('products.index')}}">المنتجات</a></li>
                        </ul>
                    </li>

                    <!-- settings -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#settings">
                            <div class="pull-left">
                                <i class="ti-user"></i>
                                <span class="right-nav-text">الاعدادات</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="settings" class="collapse" data-parent="#sidebarnav">
                            <li><a href="#">الاعدادات</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
