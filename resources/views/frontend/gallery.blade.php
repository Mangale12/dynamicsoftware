@extends('frontend.includes.app')
@section('content')
 <!-- ======= Portfolio Section ======= -->
 <section id="hero" style="height: 0%;">

 </section><!-- End Hero -->
 <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title">
        <h2>Portfolio</h2>
        <h3>Check our <span>Portfolio</span></h3>
        <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
      </div>

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">

            <li data-filter="" class=" {{ request('category') ? '' : 'filter-active' }} gallery-all">All</li>
            @foreach ($categories as $category)

              <li class="category {{ request('category') == $category->slug ? 'filter-active' : '' }}"" data-id="{{ $category->slug }}">{{ $category->name }}</li>
            @endforeach

          </ul>
        </div>
      </div>

      <div class="row portfolio-container">
          @foreach ($gallery as $image)
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{ asset('public/uploads/category/'.$image->image) }}" class="img-fluid" alt="">

            </div>
          @endforeach
      </div>

    </div>
  </section><!-- End Portfolio Section -->
  <!-- ======= Footer ======= -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <script>

    $(document).ready(function(){
        $('.gallery-all').on('click', function(){
            location.href = "{{ url('home/gallery') }}";
        })
        $('.category').on("click", function(){
            var category = $(this).data('id');
            location.href = "{{ url('home/gallery') }}?category="+category;
            // $.ajax({
            //     url: '{{ route("frontend.home") }}',  // Replace with your API endpoint URL
            //     type: 'GET',
            //     // Set the expected data type
            //     data:{'category':category},
            //     success: function(data) {
            //         console.log("successs");
            //     },
            //     error: function(xhr, status, error) {
            //         // Handle errors here
            //         console.error(error);
            //     }
            // });
        });
    });
</script>
@endsection
