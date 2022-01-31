
@include('admin.common.header')
<!-- start page title -->

<style>
    .card-sec h4{
        font-size: 17px;
        font-weight: 900;
    }
    .staictics .card-body{
        display: flex;
    }
    .staictics .card-body  .data{
        margin-left: 30px;
    }
    @media (max-width:767px) {

          .staictics .card-body{
        display: block;
        text-align: center;
        padding: 12px;
    }

   .staictics .card-body  .avatar{
    margin-left: 0px;
    width: auto;
   }

    .staictics .card-body  .data{
        margin-left: 0px;
    }


    }
</style>




<style>
    .container-img{
        background-color:  #373349;
    }
    .container-img > a {
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 2em;
}

.container-img > a > img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  box-shadow: 0 2px 16px var(--shadow);
}

.container-img {
  display: grid;
  grid-gap: 10px;
  grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
  grid-auto-rows: 120px;
  grid-auto-flow: dense;
}

.horizontal {
  grid-column: span 2;
}

.vertical {
  grid-row: span 2;
}

.big {
  grid-column: span 2;
  grid-row: span 2;
}
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Welcome !</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Astro</a></li>
                    <li class="breadcrumb-item active">Welcome !</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="row staictics">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-6">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body  w-100">
                        <div class="avatar">
                            <span class="avatar-title bg-soft-primary rounded">
                                <i class="mdi mdi-account-multiple-outline text-success font-size-24 color-success"></i>
                            </span>
                        </div>
                        <div class=" data" >
                        <p class="text-muted mt-0 mb-0">Total Users</p>
                        <h4 class="mt-1 mb-0 color-success">{{$users}}</h4>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-6">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body  w-100 card-sec">
                        <div class="avatar">
                            <span class="avatar-title bg-soft-success rounded">
                                <i class="mdi mdi-eye-outline text-warning font-size-24 color-warning"></i>
                            </span>
                        </div>
                        <div class=" data" >
                        <p class="text-muted mt-0 mb-0">Total Astrologers</p>
                         <h4 class="mt-1 mb-0 color-warning">{{$astrologers}}</h4>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6  col-sm-6 col-xs-6 col-6">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body  w-100 card-sec">
                        <div class="avatar">
                            <span class="avatar-title bg-soft-primary rounded">
                                <i class="mdi mdi-rocket-outline text-primary font-size-24 color-danger"></i>
                            </span>
                        </div>
                        <div class=" data" >
                        <p class="text-muted mt-0 mb-0">New User</p>
                        <h4 class="mt-1 mb-0 color-danger">0</h4>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-6">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body  w-100 card-sec">
                        <div class="avatar">
                            <span class="avatar-title bg-soft-info rounded">
                                <i class="mdi mdi-account-multiple-outline text-success font-size-24 color-info"></i>
                            </span>
                        </div>
                        <div class=" data" >
                        <p class="text-muted mt-0 mb-0">Total Revenue</p>
                        <h4 class="mt-1 mb-0 color-info">INR 0</h4>
                    </div>
                    </div>
                </div>
            </div>


           

        </div>
    </div>
</div>


<!-- Dashboard Card View -->

<!-- Dashboard Charts -->



<div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Visitor Analytics</h4>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="lineChart" class="chartjs-chart" data-colors="[&quot;rgba(57, 128, 192, 0.2)&quot;, &quot;#3980c0&quot;, &quot;rgba(235, 239, 242, 0.2)&quot;, &quot;#ebeff2&quot;]" width="513" height="256" style="display: block; box-sizing: border-box; height: 256px; width: 513px;"></canvas>   
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Daily Traffic</h4>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="bar" class="chartjs-chart" data-colors="[&quot;rgba(51, 161, 134, 0.8)&quot;, &quot;rgba(51, 161, 134, 0.9)&quot;]" width="513" height="256" style="display: block; box-sizing: border-box; height: 256px; width: 513px;"></canvas>
                                          
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>

<!-- End Dashboard Charts -->

<!-- 
<div class="container container-img">
      <a href="https://source.unsplash.com/600x600/?sig=1" data-lightbox="homePortfolio">
        <img src="https://source.unsplash.com/600x600/?sig=1"/>
      </a>
      
      <a href="https://source.unsplash.com/600x800/?sig=12" data-lightbox="homePortfolio" class="vertical">
        <img src="https://source.unsplash.com/600x800/?sig=12"/>
      </a>
      
      <a href="https://source.unsplash.com/800x600/?sig=71" data-lightbox="homePortfolio" class="horizontal">
        <img src="https://source.unsplash.com/800x600/?sig=71"/>
      </a>
      
      <a href="https://source.unsplash.com/600x600/?sig=40" data-lightbox="homePortfolio">
        <img src="https://source.unsplash.com/600x600/?sig=40"/>
      </a>
      
      <a href="https://source.unsplash.com/600x600/?sig=32" data-lightbox="homePortfolio">
        <img src="https://source.unsplash.com/600x600/?sig=32"/>
      </a>
      
      <a href="https://source.unsplash.com/800x800/?sig=7" data-lightbox="homePortfolio" class="big">
        <img src="https://source.unsplash.com/800x800/?sig=7"/>
      </a>
      
      <a href="https://source.unsplash.com/600x600/?sig=111" data-lightbox="homePortfolio">
        <img src="https://source.unsplash.com/600x600/?sig=111"/>
      </a>
      
      <a href="https://source.unsplash.com/600x800/?sig=94" data-lightbox="homePortfolio" class="vertical">
        <img src="https://source.unsplash.com/600x800/?sig=94"/>
      </a>
      
      <a href="https://source.unsplash.com/600x600/?sig=11" data-lightbox="homePortfolio">
        <img src="https://source.unsplash.com/600x600/?sig=11"/>
      </a>
      
      <a href="https://source.unsplash.com/800x600/?sig=68" data-lightbox="homePortfolio" class="horizontal">
        <img src="https://source.unsplash.com/800x600/?sig=68"/>
      </a>
      
      <a href="https://source.unsplash.com/600x600/?sig=24" data-lightbox="homePortfolio">
        <img src="https://source.unsplash.com/600x600/?sig=24"/>
      </a>
      
      <a href="https://source.unsplash.com/800x800/?sig=55" data-lightbox="homePortfolio" class="big">
        <img src="https://source.unsplash.com/800x800/?sig=55"/>
      </a>
      
      <a href="https://source.unsplash.com/600x600/?sig=56" data-lightbox="homePortfolio">
        <img src="https://source.unsplash.com/600x600/?sig=56"/>
      </a>
      
      <a href="https://source.unsplash.com/800x600/?sig=186" data-lightbox="homePortfolio" class="horizontal">
        <img src="https://source.unsplash.com/800x600/?sig=186"/>
      </a>
      
      <a href="https://source.unsplash.com/600x600/?sig=117" data-lightbox="homePortfolio">
        <img src="https://source.unsplash.com/600x600/?sig=117"/>
      </a>
      
      <a href="https://source.unsplash.com/800x800/?sig=157" data-lightbox="homePortfolio" class="big">
        <img src="https://source.unsplash.com/800x800/?sig=157"/>
      </a>
      
      <a href="https://source.unsplash.com/600x600/?sig=287" data-lightbox="homePortfolio">
        <img src="https://source.unsplash.com/600x600/?sig=287"/>
      </a>
      
      <a href="https://source.unsplash.com/600x800/?sig=307" data-lightbox="homePortfolio" class="vertical">
        <img src="https://source.unsplash.com/600x800/?sig=307"/>
      </a>
    </div>
 -->

@include('admin.common.footer')
