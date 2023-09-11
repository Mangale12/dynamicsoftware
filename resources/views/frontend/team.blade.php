@extends('frontend.includes.app')
@section('content')
  <section id="hero" style="height: 0%;">

  </section><!-- End Hero -->
<!-- ======= Portfolio Section ======= -->
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Portfolio Details</li>
        </ol>
        <h2>Portfolio Details</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                    @if(!empty($team->image))

                    <img src="{{ asset('public/images/'.$team->image) }}" alt="Photo of sunset" class="p-0">
                    @endif
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Project information</h3>
              <ul>
                @foreach ($team->contact as $contact)
                <li data-id="{{ $contact->id }}" class="team-member" style="cursor: pointer;">{{ $contact->name }}</li>
                @endforeach
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>This is an example of portfolio detail</h2>
              <p>
                Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->
<div class="modal fade mymodal" id="contactDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="width: 150%;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Team Member Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <b>Team :</b>
          <p class="team_name"></p>
          <b>Name :</b>
          <p class="member_name"></p>
          <b>Email :</b>
          <p class="member_email"></p>
          <b>Address :</b>
          <p class="member_address"></p>
          <b>Achievement :</b>
          <p class="member_achievement"></p>

        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <script>

    $(document).ready(function(){
        $('.team-member').on("click", function(){
            var member_id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("team.contact_details") }}',  // Replace with your API endpoint URL
                type: 'POST',
                dataType: 'json',  // Set the expected data type
                data:{'member_id':member_id},
                success: function(data) {
                    console.log(data);
                    var myModal = new bootstrap.Modal(document.getElementById('contactDetails'))
                    myModal.show()
                    $('.team_name').html('{{ $team->name }}');
                    $('.member_name').html(data.contact.name);
                    $('.member_email').html(data.contact.email);
                    $('.member_address').html(data.contact.address);
                    $('.member_achievement').html(data.contact.achievement);
                    $('.member-achievement-text').val(data.contact.achievement);
                    $('.contact_id').val(data.contact.id);


                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(error);
                }
            });
        });
        $('.achievement-btn').on('click', function(){
            var achievement = $('.member-achievement-text').val();
            var member_id = $('.contact_id').val();
            alert(member_id);
            console.log(member_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("team.achieve") }}',  // Replace with your API endpoint URL
                type: 'POST',
                dataType: 'json',  // Set the expected data type
                data:{"member_id":member_id, "achievement":achievement},
                success: function(data) {
                    // var myModal = new bootstrap.Modal(document.getElementById('contactDetails'))
                    // myModal.hide()
                    window.location.href = "{{URL::to('teams')}}"
                    console.log(data);
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(error);
                }
            });

        });
        $('.remove-contact').on('click', function(){
            alert("test");


        });
    });

    function myFunction(){
        if(confirm("Do you want to remove conatct from this team ?")){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                dataType: 'json',  // Set the expected data type
                data:{"member_id":member_id, "achievement":achievement},
                success: function(data) {
                    // var myModal = new bootstrap.Modal(document.getElementById('contactDetails'))
                    // myModal.hide()
                    window.location.href = "{{URL::to('teams')}}"
                    console.log(data);
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(error);
                }
            });
        }
    }
</script>
<!-- End Portfolio Section -->
  @endsection
