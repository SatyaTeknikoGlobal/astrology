  <!-- ========== Left Sidebar Start ========== -->

  <?php 
  $ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

  $url = url()->current();
// echo $url;

  $baseurl = url('/');


  ?>


  <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
    <i class="fa fa-fw fa-bars"></i>


</button>

<div class="topnav active">
    <nav class="navbar navbar-light navbar-expand-lg topnav-menu active">

        <div class="collapse navbar-collapse active" id="topnav-menu-content">
            <ul class="navbar-nav active">
                <li class="nav-item active">
                    <a class="nav-link dropdown-toggle arrow-none active" href="{{url('/admin')}}" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-tachometer"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="bx bx-grid-alt"></i>
                     <span data-key="t-bootstrap">Master</span> <div class="arrow-down"></div>
                 </a>

                 <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                    <div class="ps-2 p-lg-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>


                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <div>




                                             <?php if(CustomHelper::isAllowedModule('user')){ ?>    
                                                <a href="{{ route('admin.user.index') }}" class="dropdown-item" data-key="t-calendar">User</a>
                                            <?php } ?>

                                            <?php if(CustomHelper::isAllowedModule('astrologer')){ ?>   
                                                <a href="{{ route('admin.astrologer.index') }}" class="dropdown-item" data-key="t-chat">Astrologer</a>
                                            <?php } ?>

                                            <?php if(CustomHelper::isAllowedModule('languages')){ ?>   
                                                <a href="{{ route('admin.languages.index') }}" class="dropdown-item" data-key="t-chat">Language</a>
                                            <?php } ?>

                                            <?php if(CustomHelper::isAllowedModule('expertises')){ ?>   
                                                <a href="{{ route('admin.expertises.index') }}" class="dropdown-item" data-key="t-chat">Expertises</a>
                                            <?php } ?>
                                            <?php if(CustomHelper::isAllowedModule('categories')){ ?>   
                                                <a href="{{ route('admin.categories.index') }}" class="dropdown-item" data-key="t-chat">Categories</a>
                                            <?php } ?>

                                            <?php if(CustomHelper::isAllowedModule('banners')){ ?>   
                                                <a href="{{ route('admin.banners.index') }}" class="dropdown-item" data-key="t-chat">Banners</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                         
                                            <?php if(CustomHelper::isAllowedModule('report_list_category')){ ?>   
                                                <a href="{{ route('admin.report_list_category.index') }}" class="dropdown-item" data-key="t-chat">Report List</a>
                                            <?php } ?>

                                            <?php if(CustomHelper::isAllowedModule('transactions')){ ?>   
                                                <a href="{{ route('admin.transactions.index') }}" class="dropdown-item" data-key="t-chat">Transactions</a>
                                            <?php } ?>
                                            <?php if(CustomHelper::isAllowedModule('report_type')){ ?>   
                                                <a href="{{ route('admin.report_type.index') }}" class="dropdown-item" data-key="t-chat">Report Type</a>
                                            <?php } ?>
                                            <?php if(CustomHelper::isAllowedModule('report_history')){ ?>   
                                                <a href="{{ route('admin.report_history.index') }}" class="dropdown-item" data-key="t-chat">Report History</a>
                                            <?php } ?>

                                            <?php if(CustomHelper::isAllowedModule('call_history')){ ?>   
                                                <a href="{{ route('admin.call_history.index') }}" class="dropdown-item" data-key="t-chat">Call History</a>
                                            <?php } ?>

                                            <?php if(CustomHelper::isAllowedModule('chat_history')){ ?>   
                                                <a href="{{ route('admin.chat_history.index') }}" class="dropdown-item" data-key="t-chat">Chat History</a>
                                            <?php } ?>

                                            <?php if(CustomHelper::isAllowedModule('notifications')){ ?>   
                                                <a href="{{ route('admin.notifications.index') }}" class="dropdown-item" data-key="t-chat">Notification</a>
                                            <?php } ?>


                                        </div>
                                    </div>
                                   
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </li>

   
 

 <li class="nav-item">
    <?php if(CustomHelper::isAllowedModule('user')){ ?>    
        <a href="{{ route('admin.user.index') }}" class="dropdown-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
    <?php } ?>
 </li>

 <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
        <i class="bx bx-map"></i>
        <span data-key="t-apps">Location</span> <div class="arrow-down"></div>
    </a>
    <div class="dropdown-menu" aria-labelledby="topnav-pages">
      <a href="{{ route('admin.countries.index')}}" class="dropdown-item" data-key="t-inbox">Country</a>
      <a href="{{ route('admin.states.index')}}" class="dropdown-item" data-key="t-read-email">State</a>
      <a href="{{ route('admin.cities.index')}}" class="dropdown-item" data-key="t-read-email">City</a>



  </div>

</li>


              <!--       <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                        <i class="bx bx-grid-alt"></i>
                        <span data-key="t-apps">Master</span> <div class="arrow-down"></div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="topnav-pages">

                     <?php if(CustomHelper::isAllowedModule('user')){ ?>    
                            <a href="{{ route('admin.user.index') }}" class="dropdown-item" data-key="t-calendar">User</a>
                        <?php } ?>

                        <?php if(CustomHelper::isAllowedModule('astrologer')){ ?>   
                            <a href="{{ route('admin.astrologer.index') }}" class="dropdown-item" data-key="t-chat">Astrologer</a>
                        <?php } ?>

                        <?php if(CustomHelper::isAllowedModule('languages')){ ?>   
                            <a href="{{ route('admin.languages.index') }}" class="dropdown-item" data-key="t-chat">Language</a>
                        <?php } ?>

                        <?php if(CustomHelper::isAllowedModule('expertises')){ ?>   
                            <a href="{{ route('admin.expertises.index') }}" class="dropdown-item" data-key="t-chat">Expertises</a>
                        <?php } ?>

                         <?php if(CustomHelper::isAllowedModule('categories')){ ?>   
                            <a href="{{ route('admin.categories.index') }}" class="dropdown-item" data-key="t-chat">Categories</a>
                        <?php } ?>

                        <?php if(CustomHelper::isAllowedModule('banners')){ ?>   
                            <a href="{{ route('admin.banners.index') }}" class="dropdown-item" data-key="t-chat">Banners</a>
                        <?php } ?>

                         <?php if(CustomHelper::isAllowedModule('report_list_category')){ ?>   
                            <a href="{{ route('admin.report_list_category.index') }}" class="dropdown-item" data-key="t-chat">Report List</a>
                        <?php } ?>

                        <?php if(CustomHelper::isAllowedModule('transactions')){ ?>   
                            <a href="{{ route('admin.transactions.index') }}" class="dropdown-item" data-key="t-chat">Transactions</a>
                        <?php } ?>

                        <?php if(CustomHelper::isAllowedModule('report_type')){ ?>   
                            <a href="{{ route('admin.report_type.index') }}" class="dropdown-item" data-key="t-chat">Report Type</a>
                        <?php } ?>

                         <?php if(CustomHelper::isAllowedModule('report_history')){ ?>   
                            <a href="{{ route('admin.report_history.index') }}" class="dropdown-item" data-key="t-chat">Report History</a>
                        <?php } ?>

                         <?php if(CustomHelper::isAllowedModule('call_history')){ ?>   
                            <a href="{{ route('admin.call_history.index') }}" class="dropdown-item" data-key="t-chat">Call History</a>
                        <?php } ?>

                          <?php if(CustomHelper::isAllowedModule('chat_history')){ ?>   
                            <a href="{{ route('admin.chat_history.index') }}" class="dropdown-item" data-key="t-chat">Chat History</a>
                        <?php } ?>

                         <?php if(CustomHelper::isAllowedModule('notifications')){ ?>   
                            <a href="{{ route('admin.notifications.index') }}" class="dropdown-item" data-key="t-chat">Notification/SMS</a>
                        <?php } ?>

                        

                       

                        <div class="dropdown">
                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                role="button">
                                <span data-key="t-email">Location</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-email">
                                <a href="{{ route('admin.countries.index')}}" class="dropdown-item" data-key="t-inbox">Country</a>
                                <a href="{{ route('admin.states.index')}}" class="dropdown-item" data-key="t-read-email">State</a>
                                 <a href="{{ route('admin.cities.index')}}" class="dropdown-item" data-key="t-read-email">City</a>
                            </div>
                        </div>  -->



                        
                       <!--  <a href="apps-calendar.html" class="dropdown-item" data-key="t-calendar">Calendar</a>


                        <a href="apps-chat.html" class="dropdown-item" data-key="t-chat">Chat</a> -->

                       <!--  <div class="dropdown">
                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email" role="button">
                                <span data-key="t-email">Email</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-email">
                                <a href="email-inbox.html" class="dropdown-item" data-key="t-inbox">Inbox</a>
                                <a href="email-read.html" class="dropdown-item" data-key="t-read-email">Read Email</a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce" role="button">
                                Ecommerce <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                <a href="ecommerce-products.html" class="dropdown-item" data-key="t-products">Products</a>
                                <a href="ecommerce-product-detail.html" class="dropdown-item" data-key="t-product-detail">Product Detail</a>
                                <a href="ecommerce-orders.html" class="dropdown-item" data-key="t-orders">Orders</a>
                                <a href="ecommerce-customers.html" class="dropdown-item" data-key="t-customers">Customers</a>
                                <a href="ecommerce-cart.html" class="dropdown-item" data-key="t-cart">Cart</a>
                                <a href="ecommerce-checkout.html" class="dropdown-item" data-key="t-checkout">Checkout</a>
                                <a href="ecommerce-shops.html" class="dropdown-item" data-key="t-shops">Shops</a>
                                <a href="ecommerce-add-product.html" class="dropdown-item" data-key="t-add-product">Add Product</a>
                            </div>
                        </div> -->

                        <!-- <div class="dropdown">
                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoice" role="button"><span data-key="t-invoices">Invoices</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-invoice">
                                <a href="invoices-list.html" class="dropdown-item" data-key="t-invoice-list">Invoice List</a>
                                <a href="invoices-detail.html" class="dropdown-item" data-key="t-invoice-detail">Invoice Detail</a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-contact" role="button">
                               <span data-key="t-contacts">Contacts</span> <div class="arrow-down"></div>
                           </a>
                           <div class="dropdown-menu" aria-labelledby="topnav-contact">
                            <a href="contacts-grid.html" class="dropdown-item" data-key="t-user-grid">User Grid</a>
                            <a href="contacts-list.html" class="dropdown-item" data-key="t-user-list">User List</a>
                            <a href="contacts-profile.html" class="dropdown-item" data-key="t-user-settings">User Settings</a>
                        </div>
                    </div> 
                </div>
            </li>-->

            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bxl-bootstrap"></i>
                    <span data-key="t-bootstrap">Bootstrap</span> <div class="arrow-down"></div>
                </a>

                <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                    <div class="ps-2 p-lg-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <div class="menu-title">Components</div>
                                    <div class="row g-0">
                                        <div class="col-lg-4">
                                            <div>
                                                <a href="ui-alerts.html" class="dropdown-item" data-key="t-alerts">Alerts</a>
                                                <a href="ui-buttons.html" class="dropdown-item" data-key="t-buttons">Buttons</a>
                                                <a href="ui-cards.html" class="dropdown-item" data-key="t-cards">Cards</a>
                                                <a href="ui-carousel.html" class="dropdown-item" data-key="t-carousel">Carousel</a>
                                                <a href="ui-dropdowns.html" class="dropdown-item" data-key="t-dropdowns">Dropdowns</a>
                                                <a href="ui-grid.html" class="dropdown-item" data-key="t-grid">Grid</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <a href="ui-images.html" class="dropdown-item" data-key="t-images">Images</a>
                                                <a href="ui-modals.html" class="dropdown-item" data-key="t-modals">Modals</a>
                                                <a href="ui-offcanvas.html" class="dropdown-item" data-key="t-offcanvas">Offcanvas</a>
                                                <a href="ui-placeholders.html" class="dropdown-item" data-key="t-placeholders">Placeholders</a>
                                                <a href="ui-progressbars.html" class="dropdown-item" data-key="t-progress-bars">Progress Bars</a>
                                                <a href="ui-tabs-accordions.html" class="dropdown-item" data-key="t-tabs-accordions">Tabs &amp; Accordions</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <a href="ui-typography.html" class="dropdown-item" data-key="t-typography">Typography</a>
                                            <a href="ui-video.html" class="dropdown-item" data-key="t-video">Video</a>
                                            <a href="ui-general.html" class="dropdown-item" data-key="t-general">General</a>
                                            <a href="ui-colors.html" class="dropdown-item" data-key="t-colors">Colors</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li> -->

            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button">
                    <i class="bx bx-layer"></i>
                    <span data-key="t-components">Components</span> <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-components">
                    <div class="dropdown">
                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-extended" role="button">
                            <span data-key="t-extendeds">Extended</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                            <a href="extended-lightbox.html" class="dropdown-item" data-key="t-lightbox">Lightbox</a>
                            <a href="extended-rangeslider.html" class="dropdown-item" data-key="t-range-slider">Range Slider</a>
                            <a href="extended-sweet-alert.html" class="dropdown-item" data-key="t-sweet-alert">SweetAlert 2</a>
                            <a href="extended-rating.html" class="dropdown-item" data-key="t-rating">Rating</a>
                            <a href="extended-notifications.html" class="dropdown-item" data-key="t-notifications">Notifications</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form" role="button">
                            <span data-key="t-forms">Forms</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                            <a href="form-elements.html" class="dropdown-item" data-key="t-basic-elements">Basic Elements</a>
                            <a href="form-validation.html" class="dropdown-item" data-key="t-validation">Validation</a>
                            <a href="form-advanced.html" class="dropdown-item" data-key="t-advanced-plugins">Advanced Plugins</a>
                            <a href="form-editors.html" class="dropdown-item" data-key="t-editors">Editors</a>
                            <a href="form-uploads.html" class="dropdown-item" data-key="t-file-upload">File Upload</a>
                            <a href="form-wizard.html" class="dropdown-item" data-key="t-wizard">Wizard</a>
                            <a href="form-mask.html" class="dropdown-item" data-key="t-mask">Mask</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table" role="button">
                            <span data-key="t-tables">Tables</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-table">
                            <a href="tables-basic.html" class="dropdown-item" data-key="t-bootstrap-basic">Bootstrap Basic</a>
                            <a href="tables-advanced.html" class="dropdown-item" data-key="t-advanced-tables">Advance Tables</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts" role="button">
                            <span data-key="t-charts">Charts</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-charts">
                            <a href="charts-apex.html" class="dropdown-item" data-key="t-apex-charts">Apex Charts</a>
                            <a href="charts-chartjs.html" class="dropdown-item" data-key="t-chartjs-charts">Chartjs</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons" role="button">
                            <span data-key="t-icons">Icons</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-icons">
                            <a href="icons-feather.html" class="dropdown-item" data-key="t-feather">Feather</a>
                            <a href="icons-boxicons.html" class="dropdown-item" data-key="t-boxicons">Boxicons</a>
                            <a href="icons-materialdesign.html" class="dropdown-item" data-key="t-material-design">Material Design</a>
                            <a href="icons-dripicons.html" class="dropdown-item" data-key="t-dripicons">Dripicons</a>
                            <a href="icons-fontawesome.html" class="dropdown-item" data-key="t-font-awesome">Font awesome</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map" role="button">
                            <span data-key="t-maps">Maps</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-map">
                            <a href="maps-google.html" class="dropdown-item" data-key="t-google">Google</a>
                            <a href="maps-vector.html" class="dropdown-item" data-key="t-vector">Vector</a>
                            <a href="maps-leaflet.html" class="dropdown-item" data-key="t-leaflet">Leaflet</a>
                        </div>
                    </div>
                </div>

            </li> -->

            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                    <i class="bx bx-file"></i>
                    <span data-key="t-pages">Pages</span> <div class="arrow-down"></div>
                </a>
                <div class="dropdown-menu" aria-labelledby="topnav-more">
                    <div class="dropdown">
                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button">
                            <span data-key="t-authentication">Authentication</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-auth">
                            <a href="auth-login.html" class="dropdown-item" data-key="t-login">Login</a>
                            <a href="auth-register.html" class="dropdown-item" data-key="t-register">Register</a>
                            <a href="auth-recoverpw.html" class="dropdown-item" data-key="t-recover-password">Recover Password</a>
                            <a href="auth-lock-screen.html" class="dropdown-item" data-key="t-lock-screen">Lock Screen</a>
                            <a href="auth-logout.html" class="dropdown-item" data-key="t-logout">Log Out</a>
                            <a href="auth-confirm-mail.html" class="dropdown-item" data-key="t-confirm-mail">Confirm Mail</a>
                            <a href="auth-email-verification.html" class="dropdown-item" data-key="t-email-verification">Email Verification</a>
                            <a href="auth-two-step-verification.html" class="dropdown-item" data-key="t-two-step-verification">Two Step Verification</a>
                        </div>
                    </div>

                    <div class="dropdown">
                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility" role="button">
                            <span data-key="t-utility">Utility</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-utility">
                            <a href="pages-starter.html" class="dropdown-item" data-key="t-starter-page">Starter Page</a>
                            <a href="pages-maintenance.html" class="dropdown-item" data-key="t-maintenance">Maintenance</a>
                            <a href="pages-comingsoon.html" class="dropdown-item" data-key="t-coming-soon">Coming Soon</a>
                            <a href="pages-timeline.html" class="dropdown-item" data-key="t-timeline">Timeline</a>
                            <a href="pages-faqs.html" class="dropdown-item" data-key="t-faqs">FAQs</a>
                            <a href="pages-pricing.html" class="dropdown-item" data-key="t-pricing">Pricing</a>
                            <a href="pages-404.html" class="dropdown-item" data-key="t-error-404">Error 404</a>
                            <a href="pages-500.html" class="dropdown-item" data-key="t-error-500">Error 500</a>
                        </div>
                    </div>

                    <a href="layouts-vertical.html" class="dropdown-item" data-key="t-vertical">Vertical</a>
                </div>
            </li> -->

        </ul>
    </div>
</nav>
</div>
</div>


<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="rounded-circle header-profile-user" src="{{$imageUrl}}" alt="Header Avatar">
    </button>
    <div class="dropdown-menu dropdown-menu-end pt-0">
        <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="bx bx-user-circle text-muted font-size-18 align-middle me-1"></i> <span class="align-middle">My Account</span></a>


        <!-- <a class="dropdown-item" href="apps-chat.html"><i class="bx bx-chat text-muted font-size-18 align-middle me-1"></i> <span class="align-middle">Chat</span></a> -->

        <a class="dropdown-item" href="#"><i class="bx bx-buoy text-muted font-size-18 align-middle me-1"></i> <span class="align-middle">Support</span></a>


        <a class="dropdown-item d-flex align-items-center" href="{{route('settings')}}"><i class="bx bx-cog text-muted font-size-18 align-middle me-1"></i> <span class="align-middle me-3">Settings</span></a>


        <!-- <a class="dropdown-item" href="auth-lock-screen.html"><i class="bx bx-lock text-muted font-size-18 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a> -->


        <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="bx bx-log-out text-muted font-size-18 align-middle me-1"></i> <span class="align-middle">Logout</span></a>
    </div>
</div>
</div>
</div>
</header>
</div>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
