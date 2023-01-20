@extends('supplier.frontend.app')
@section('content')
<section class="collection cart_collection">
  <div class="container">
    <div class="row">
      <div class="colum-100">
        <div class="row">
          <div class="colum-100">
            <h1>CHECKOUT</h1>
          </div>
          <div class="colum-60">
            <div class="border_l_b">
              <form class="auth" method="post" action="{{route('checkout_submit')}}">
                @csrf
                <div class="row">
                  <div class="colum-100">
                    <label for="f_name">Name</label>
                    <input required id="f_name" type="text" name="name" value="{{$supplier->name}}" placeholder="First Name">
                  </div>
                  <div class="colum-100">
                    <label for="f_name">Phone</label>
                    <input required id="f_name" type="text" name="number" value="{{$supplier->phone}}" placeholder="First Name">
                  </div>
                  <div class="colum-100">
                    <label for="f_name">Address</label>
                    <input required id="f_name" type="text" name="payment_address" value="{{$supplier->address}}" placeholder="First Name">
                  </div>
                  @php
                      $shipping_cost=0;
                      $push="";
                  @endphp
                  @foreach (App\Models\Cart::totalCarts() as $item)
                    
                      @php
                          $shipping_cost=$shipping_cost+$item->product->shipping_cost*$item->product_quentity;
                          $push= $push.','.$item->id;
                      @endphp
                  @endforeach
                 
                  <div class="colum-100">
                    <label for="f_name">Shipping Area</label>
                  </div>
                  <div class="colum-100">
                    <div class="row payment_method">
                      <div class="colum-40">
                        @if (!isset($item))
                          @php
                              header("Location: " . URL::to('/'), true, 302);
                              exit();
                          @endphp
                        @endif
                        <label for="inside_dhaka">Inside Dhaka( {{$item->product->shipping_cost}}Tk * Quantity )</label>
                        <input value="0"  required id="inside_dhaka" type="radio" name="delevery" placeholder="First Name">
                      </div>
                      <div class="colum-40">
                        <label for="outside_dhaka">Outside Dhaka( {{$item->product->shipping_cost+20}}Tk * Quantity )</label>
                        <input value="1"  required id="outside_dhaka" type="radio" name="delevery" placeholder="First Name">
                      </div>
                    </div>
                  </div>

                  <div class="colum-100">
                    <input style="display: none" type="radio" checked="checked" value="{{$shipping_cost}}" name="shipping_method">
                    <input style="display: none" type="text"  value="{{$push}}" name="cart_details">
                    <label for="f_name">Payment Method</label>
                  </div>
                  <div class="colum-100">
                    <div class="row payment_method">
                      <div class="colum-25">
                        <label for="cash_on">Cash on Delivery</label>
                        <input value="cash_on"  required id="cash_on" type="radio" name="payment" placeholder="First Name">
                      </div>
                      <div class="colum-25">
                        <label for="online_cash">Online Payment</label>
                        <input value="cash_in"  required id="online_cash" type="radio" name="payment" placeholder="First Name">
                      </div>
                    </div>
                  </div>
                </div>
                @php
                    $shipping_cost=0;
                    $push="";
                  @endphp
                  @foreach (App\Models\Cart::totalCarts() as $item)
                      @php
                          $shipping_cost=$shipping_cost+$item->product->shipping_cost*$item->product_quentity;
                          $push= $push.','.$item->id;
                      @endphp
                @endforeach
                <input style="display: none" value="{{$push}}" readonly required id="online_cash" type="radio" name="shipping_method">
                <div class="row">
                  <div class="colum-25">
                    <button class="confirm_order">Confirm Order</button>
                  </div>
                </div>
            </div>
          </div>
          <div class="colum-40">
            <div class="row">
              <div class="colum-100 cart_table checkout_table">
                <table>
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Unit</th>
                      <th>Unit Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $price=0;
                      $total_cart_price=0;
                      $vat=0;
                      $shipping_cost=0;

                      $product_all_id="";
                      $product_id_price=0;
                      $product_unknown_id_price=array();
                    @endphp
                  @foreach (App\Models\Cart::totalCarts() as $item)
                    @php
                        if($item->flashdeal_id!=NULL)
                        {
                          $flash_product=App\Models\Flashdeal::find($item->flashdeal_id);
                          $discount=$item->product->unit_price*($flash_product->discount/100);
                        }else
                        {
                          $discount=$item->product->discount;
                        }
                        $total_price=$item->product->unit_price-$discount;
                       
                        $total_cart_price=$total_cart_price+($total_price*$item->product_quentity);
                        $tax= $item->product->vat;
                        $product_all_id=$product_all_id.','.$item->product_id;
                        $product_id_price=$product_id_price+$item->product->unit_price;
                        $product_unknown_id_price[$item->product_id]=$item->product->unit_price;
                        $shipping_cost=$shipping_cost+$item->product->shipping_cost*$item->product_quentity;
                    @endphp 
                    <tr>
                      <td>{{$item->product->name}}</td>
                      <td>{{$item->product_quentity}}</td>
                      <td>{{$total_price}}.00</td>
                    </tr>
                    @php
                      $price=0;
                    @endphp
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="colum-100">
                <ul class="cart_ul">
                  <li>Sub total <span>{{$total_cart_price}} TK</span></li>
                  @php
                      $vat=$vat+($total_cart_price*($tax/100));
                  @endphp
                  <li>Vat <span> {{round($vat)}}.00 Tk</span></li>
                  @if ($item->product->shipping_cost!=NULL)
                  <li>Shipping cost <span>{{round($shipping_cost)}}.00 TK</span></li>
                  @else
                  <li>Shipping cost <span>FREE</span></li>
                    @php
                      $shipping_cost=0;
                    @endphp
                  @endif
                  <li>Total <span>{{$total_cart_price+$vat+$shipping_cost}}.00 Tk</span></li>
                  <input required style="display: none"  type="text" name="address" value="{{$supplier->address}}" placeholder="First Name">
                  <input name="total_price" style="display: none" type="text" value="{{round($total_cart_price+$vat+$shipping_cost)}}"/>
                </ul>
              </div>
            </form>
              {{-- <div class="colum-100">
                <form class="coupon_apply">
                  <input type="" name="" placeholder="Apply Coupon...">
                  <button>Apply</button>
                </form>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
