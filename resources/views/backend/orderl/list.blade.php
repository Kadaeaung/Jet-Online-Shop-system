

	<x-backend>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1> <i class="icofont-list"></i> Item </h1>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        @if(session('successMsg') != NULL)
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong> ✅ SUCCESS!</strong>
                                {{ session('successMsg') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped" id="sampleTable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th> # </th>
                                        <th> Date </th>
                                        <th> VoucherNo</th>
                                        <th> Total </th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($orders as $order)
                                    @php
                                        $id = $order->id;
                                        $date = $order->orderdate;
                                        $voucherno = $order->voucherno;
                                        $total = $order->total;
                                        $status = $order->status;

                                        


                                    @endphp
                                    <tr>
                                        <td>{{ $i++}} </td>
                                        <td> 
                                            <div class="d-flex no-block align-items-center">
                                                <div class="mr-3">
                                                    <h5>{{$date}}</h5>
                                                </div>

                                            </div>
                                        </td>
                                        <td>                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium"> {{ $voucherno }} </h5>
                                                    
 
                                                   
                                                </div></td>
                                        <td>  {{$total }}  </td>

                                        	<td> 
                                                @if($status==0)
                                                <h5>Order</h5>
                                                @elseif($status==1)
                                                <h5>Order Confirm</h5>
                                                @else
                                                <h5>Order Cancel</h5>
                                                @endif


                                             </td>
                                        <td>
                                            <a href="{{ route('backside.orderl.show',$id) }}" class="btn btn-info">
                                                <i class="icofont-exclamation-circle"></i>
                                            </a>
                                            @if($status==0)
                                            <a href="{{ route('backside.orderl.edit',$id) }}" class="btn btn-outline-success">
                                                <i class="icofont-check"></i>
                                            </a>

                                            <form action="{{ route('backside.orderl.destroy',$id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-outline-danger" type="submit"> 
                                                    <i class="icofont-ui-close"></i>
                                                </button>

                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-backend>
