<div style="display: none">
<section class="collection cart_collection">
    <div class="container">
      <div class="row">
          <div class="row">
              <div class="colum-40">
                <ul class="cart_ul">
                 @if (!empty($request_all['payment']))
                    @if ($request_all['payment']=='cash_in')
                      <form method="POST" class="needs-validation">
                          @csrf
                          <input readonly  id="customer_name" value="{{$request_all['name']}}"/>
                          <input readonly id="mobile" value="{{$request_all['number']}}"/>
                          <input readonly id="email" value="{{$request_all['name']}}"/>
                          <input readonly id="address" value="{{$request_all['payment_address']}}"/>
                          <input readonly id="total_amount" value="{{$request_all['total_price']}}"/>
                          <input readonly id="user_id" value="{{$id}}"/>
                          <input readonly id="cart_ids" value="{{$cart_ids}}"/>
                          <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                                  token="if you have any token validation"
                                  postdata="your javascript arrays or objects which requires in backend"
                                  order="If you already have the transaction generated for current order"
                                  endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
                          </button>
                      </form>
                    @endif
                  @endif
                </ul>
              </div>
          </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


<!-- If you want to use the popup integration, -->
<script>
    var obj = {};
    obj.cus_name = $('#customer_name').val();
    obj.cus_phone = $('#mobile').val();
    obj.cus_email = $('#email').val();
    obj.cus_addr1 = $('#address').val();
    obj.amount = $('#total_amount').val();
    obj.id = $('#user_id').val();
    obj.cart_ids = $('#cart_ids').val();
    $('#sslczPayBtn').prop('postdata', obj);
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
  <script>
    window.onload = function(){
    setTimeout(loadAfterTime, 2000)
  };
  function loadAfterTime() { 
    document.getElementById('sslczPayBtn').click();
  }
   
</script>
</div>
