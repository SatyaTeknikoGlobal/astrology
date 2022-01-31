
@include('admin.common.header')
<style>
    .hijohoi{
    box-shadow: 0 14px 28px rgb(0 0 0 / 25%), 0 10px 10px rgb(0 0 0 / 22%);
    border-radius: 9px;
    text-align: center;
    padding: 40px 114px;
    overflow: hidden;
    position: relative;
}
.text{
    font-size: 24px;
    line-height: 36px;
    font-weight: 400;
    text-align: left;

}
.heading{
    color: darkred;
    margin-bottom: 20px;
}
.subheading{
    margin-bottom: 20px;
}
.subheading span{
    color: darkred;
}
.call-to-action-shape-01 {
    width: 880px;
    position: absolute;
    z-index: -1;
    top: 0px;
    right: -200px;
    opacity: 0.1;
}
.shape-path{
    fill: darkred;
}
.rounded5{
    height: 100px;
    width: 99px;
    background-color: #78c2ff70;
    border-radius: 100%;
    position: absolute;
    left: 28%;
}
.rounded6{
    height: 50px;
    width: 51px;
    background-color: #78c2ff70;
    border-radius: 100%;
    position: absolute;
    bottom: 14px;
}
.rounded7{
    height: 40px;
    width: 40px;
    background-color: #78c2ff70;
    left: 29px;
    border-radius: 100%;
    position: absolute;
    top: 50%;
}
</style>

       


        <section>
            <div class="container hijohoi my-5" >
                <div class="row">
                    <div class="rounded5">

                    </div>
                    <div class="rounded6">

                    </div>
                    <div class="rounded7">

                    </div>
                    <div class="col-md-6" style="text-align: left;">
                        <img src="https://astro.appmantra.live/public/assets/images/logo-sm.png" alt="">
                        <h1 class="heading">Hello User !</h1>
                        <h2 class="subheading">Welcome To <span>Astro</span></h2>

                        <h6 class="text">Welcome to our team, [name]! We value the talents and ideas of everyone on our team, especially our new hires. We can’t wait to see what you’ll make happen.
                        </h6>


                        <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mt-3">login Now</button>


                        



                    </div>
                    <div class="col-md-6">
                        <img src="./assets/images/maintenance.png" alt="" class="img-fluid">



                        
                    </div>
                    <div class="call-to-action-shape-01">
                        <svg id="svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0, 0, 400,370.35681610247025">
                           <g id="svgg">
                               <path class="shape-path" id="path0" d="M249.954 0.635 C 240.575 3.389,233.929 9.074,230.209 17.528 C 221.671 36.930,201.468 54.980,166.331 74.599 C 150.321 83.539,133.886 91.550,97.896 107.960 C 60.753 124.895,46.948 131.724,33.211 139.957 C 2.314 158.477,-5.531 173.697,7.558 189.731 C 8.181 190.495,11.285 193.759,14.456 196.984 C 38.336 221.280,50.229 238.507,53.680 253.797 C 54.907 259.234,55.006 266.165,53.979 274.748 C 51.984 291.423,54.149 301.599,62.854 316.468 C 72.588 333.095,83.951 343.673,97.896 349.088 C 107.191 352.698,115.551 354.028,136.688 355.260 C 160.933 356.672,172.530 358.640,186.647 363.738 C 199.456 368.363,216.007 367.283,240.657 360.214 C 277.351 349.690,331.341 324.707,386.917 292.536 C 397.502 286.408,398.745 285.641,398.645 285.304 C 398.595 285.134,396.907 276.638,394.895 266.423 C 371.016 145.183,358.578 74.176,357.552 53.239 C 357.423 50.608,357.277 49.322,356.993 48.307 C 352.156 31.013,314.465 7.243,281.287 0.562 L 278.494 0.000 265.276 0.009 L 252.059 0.017 249.954 0.635 " stroke="none" fill-rule="evenodd"></path>
                           </g>
                       </svg>
                   </div>
                </div>
            </div>
        </section>

        @include('admin.common.footer')