@php
    $footer = getContent('footer.content', true);
    $contact = getContent('contact_us.content', true);
    $policys = getContent('policy_pages.element', false);
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
@endphp

@push('script')
<script>

    document.addEventListener("DOMContentLoaded", function(){
  window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.getElementById('navbar_top').classList.add('fixed-top');
        // add padding top to show content behind navbar
        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('navbar_top').classList.remove('fixed-top');
         // remove padding top from body
        document.body.style.paddingTop = '0';
      }
  });
});
    (function () {
        'use strict';
        $(document).on('click','.subscribe-btn' , function(){
            var email = $("#emailSub").val();
            if(email){
                $.ajax({
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}",},
                    url:"{{ route('subscribe') }}",
                    method:"POST",
                    data:{email:email},
                    success:function(response)
                    {
                        if(response.success) {
                            notify('success', response.success);
                            $("#emailSub").val('');
                        }else{
                            $.each(response, function (i, val) {
                                notify('error', val);
                            });
                        }
                    }
                });
            }
            else{
                notify('error', "Please Input Your Email");
            }
        });

        $('.policy').on('click',function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('{{route('cookie.accept')}}', function(response){
                $('.cookie__wrapper').addClass('d-none');
                notify('success', response);
            });
        });
    })();
</script>
@endpush
