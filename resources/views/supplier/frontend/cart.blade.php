@extends('supplier.frontend.app')
@section('content')
<section class="collection cart_collection">
  <div class="container">
    <div class="row">
      <div class="colum-100">
        <div class="row">
          @php
              $product_cart_quentity=0;
          @endphp
          @foreach (App\Models\Cart::totalCarts() as $item)
             @php
                  $product_cart_quentity= $product_cart_quentity + $item->product_quentity;
             @endphp
          @endforeach
          <div class="colum-100">
            <h1>SHOPPING CART &nbsp;({{$product_cart_quentity}})</h1>
          </div>
          <div class="colum-100">
            <div class="row">
              <div class="colum-100 cart_table">
                <table>
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Details</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $price=0;
                      $total_cart_price=0;
                      $vat=0;
                      $shipping_cost=0;
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
                          $vat=$vat+($total_price*($tax/100)*$item->product_quentity);
                          $shipping_cost=$shipping_cost+$item->product->shipping_cost*$item->product_quentity;
                      @endphp 
                      <tr>
                        {{-- for live --}}
                        <td><img src="{{asset('mehromah/public/assets/images/product/'.$item->image)}}"></td>
                        {{-- for local --}}
                        <!--<td><img src="{{asset('assets/images/product/'.$item->image)}}"></td>-->
                        <td>{{$item->product->name}}</td>
                          @php
                              $customer_choice=unserialize($item->customer_choice);
                          @endphp
                        <td>
                          @foreach ($customer_choice as $key => $value)
                            @php
                                $customer_choice_contents=explode(",",$value);
                            @endphp
                            {{$key}}:
                            @foreach ($customer_choice_contents as $customer_choice_content)
                                {{$customer_choice_content}}
                            @endforeach 
                            <br/> 
                         @endforeach 
                        </td>
                        <td>{{$item->product_quentity}}</td>
                        <td>{{round($total_price)}}.00</td>
                        <td>
                          <form class="cart_update" method="post" action="{{route('update_cart',[$item->id])}}">
                            @csrf
                            <div class="row">
                              <div class="colum-70">
                                <input type="number" name="quantity" min="1" value="{{$item->product_quentity}}">
                                <button><i class="fas fa-chevron-circle-right"></i></button>
                              </div>
                              <div class="colum-30">
                                @if ($item->user_id!=NULL)
                                  <a href="{{route('remove_cart_auth',[$item->product_id,$item->user_id])}}"><i class="fas fa-window-close"></i></a>
                                @else
                                  <a href="{{route('remove_cart',[$item->product_id])}}"><i class="fas fa-window-close"></i></a>
                                @endif
                              </div>
                            </div>
                          </form>
                        </td>
                      </tr>
                      @php
                          $price=0;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="colum-80"></div>
              <div class="colum-20">
                <ul class="cart_ul">
                  <li>Sub total<span>{{round($total_cart_price)}}.00</span></li>
                  <li>Vat <span>{{round($vat)}}.00</span></li>
                  <li>Shipping Cost
                    @if (!empty($item) && $item->product->shipping_cost!=NULL) 
                      <span>{{$shipping_cost}}.00</span>
                    @else
                      <span>Free</span>
                      @php
                        $shipping_cost=0;
                      @endphp
                    @endif
                  </li>
                  <li>Total<span>{{round($total_cart_price+$vat+$shipping_cost)}}.00</span></li>
                  <li><a href="{{route('checkout')}}">Checkout</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection