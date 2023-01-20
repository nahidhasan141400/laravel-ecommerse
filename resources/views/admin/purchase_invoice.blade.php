<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>LuxuryHut</title>
    <style>
        @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
  margin-right: 350px;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
  margin-right: 313px;
}

#invoice h1 {
  color: #0087C3;
  font-size: 1.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 92%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
  text-align: center;
}

table .desc {
  text-align: center;
}

table .unit {
  background: #DDDDDD;
  text-align: center;
}

table .qty {
  text-align: center;
}

table .total {
  background: #57B223;
  color: #FFFFFF;
  text-align: center;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223; 

}

table tfoot tr td:first-child {
  border: none;
}

#greating{
  margin-bottom: 50px;
  line-height: 4px;
}
#thanks{
  font-size: 2em;
}


#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ public_path('assets/images/setting/'.$general_setting->logo)}}">
      </div>
      <div id="company">
        <h2 class="name">LuxuryHut Limited</h2>
        <div>{{$general_setting->address}}</div>
        <div>{{$general_setting->phone}}</div>
        <div><a href="mailto:{{$general_setting->email}}">{{$general_setting->email}}</a></div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{$order->supplier->name}}</h2>
          <div class="address">{{$order->supplier->address}}, {{$order->supplier->phone}}</div>
          <div class="email"><a href="mailto:{{$order->supplier->email}}">{{$order->supplier->email}}</a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE #{{$invoice->invoice_code}}</h1>
          <div class="date">Invoice Date: {{$invoice->created_at}}</div><br/>
          <h1>ORDER #{{$order->order_id}}</h1>
          <div class="date">Order Date: {{$order->created_at}}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">NAME</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
            @php       
                $purchaseproduct_itemcodes=explode(',',unserialize($order->name));
                $purchaseproduct_amount=explode(',',unserialize($order->amount));
                $purchaseproduct_quantity=explode(',',unserialize($order->quantity));
                $count=count($purchaseproduct_itemcodes); 
                $total=0;          
            @endphp
            @for ($i = 0; $i < $count; $i++)
              <tr>
                <td class="no">{{$i}}</td>
                <td class="desc">{{$purchaseproduct_itemcodes[$i]}}<h3></h3></td>
                <td class="unit">{{$purchaseproduct_amount[$i]}}.00 TK</td>
                <td class="qty">{{$purchaseproduct_quantity[$i]}}</td>
                @php
                    $total=$total+$purchaseproduct_amount[$i]*$purchaseproduct_quantity[$i];
                @endphp
                <td class="total">{{$purchaseproduct_amount[$i]*$purchaseproduct_quantity[$i]}}.00 TK</td>
              </tr>
            @endfor
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>{{$total}}.00 TK</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">IN WORDS </td>
            <td></td>
          </tr>
        </tfoot>
      </table>
      <div id="greating">
        <div id="thanks">Thank you!</div>
        <h4>LuxuryHut Sales Team</h4>
      </div>
      <div id="notices">
        <div>NOTE:Terms and Condition Apply</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
