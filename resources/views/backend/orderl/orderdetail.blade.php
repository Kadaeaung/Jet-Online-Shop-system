	<x-backend>

		<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>A Printable Invoice Format</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> Vali Inc</h2>
                </div>
                <div class="col-6">



@php 
		date_default_timezone_set('Asia/Rangoon');
		$date=strtotime(date("h:i:s"));

		//orderdate
		$today=date('Y-m-d');
		$uname=$order->user->name;
		$uaddress=$order->user->address;
		$uemail=$order->user->email;
		$oid=$order->id;






 @endphp
                  <h5 class="text-right">Date:<{{ $today}} ></h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">From
                  <address><strong><?= $uname ?> </strong><br><?= $uaddress ?><br>Email: <?= $uemail ?></address>
                </div>
                <div class="col-4">To
                  <address><strong>{{Auth::user()->profile}}</strong><br>{{Auth::user()->address}} <br>{{Auth::user()->phone}}<br>{{Auth::user()->email}}</address>
                </div>


                <div class="col-4"><b>Invoice #007612</b><br><br><b>Order ID:</b> {{$oid}}<br><b>Payment Due:</b> 2/22/2014<br><b>Account:</b> 968-34567</div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table " border="1" cellpadding="1">
                    <thead>
                      <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Serial #</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                    	

                           @foreach($orderitems as $orderitem)
                                        
                                        @php
                                        
                                        $qty=$orderitem->qty;
                                        $name=$orderitem->name;
                                        $note=$orderitem->note;
                                        $price=$orderitem->price;
                                        $dicount=$orderitem->discount;
                                        $codeno=$orderitem->voucherno;
                                        if($dicount)
                                        {
                                         $subtotal=$dicount*$qty;                                         
                                        }

                                        else
                                        {
                                          $subtotal=$price*$qty;
                                        }
                                        
                                        
                                          @endphp



                                      

                    	 
                      <tr>
                        <td>{{  $qty}} </td>
                        <td>{{  $name}} </td>
                        <td>{{ $codeno}} </td>
                        <td>  {!!$note!!}</td>
                        <td>{{$subtotal}} </td>
                       
                      </tr>
                      @endforeach

                  
                                   </tbody>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
 </main>

	</x-backend>