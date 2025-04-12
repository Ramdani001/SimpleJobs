
@include('Dashboard/component/head')
    
<main class="d-md-flex gap-5">
    @include('Dashboard/component/navbar')

    <div class="contentDash">
        <div class="container-fluid py-4">
            <div class="row">
              

              <div class="mb-2" id="menuBtn">
                <button style="font-size: 30px !important;">
                  <i class="fa-solid fa-bars"></i>
                </button>
              </div>

              @include('Dashboard/product/productContent')
              
            </div>
          </div>
    </div>

</main> 

@include('Dashboard/component/footerAll')