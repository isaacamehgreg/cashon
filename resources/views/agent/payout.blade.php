@extends('layouts.app')
@section('content')
{{-- //////     --}}


     <!-- partial -->
     <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.agent_menu')

      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-md-6 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Reconcile Your Debt.</h4>
                  

                  <form id="paymentForm">
                    <div class="form-group" hidden>
                      <label for="email">Email Address.</label>
                      <input type="email" id="email-address" value="{{Auth::user()->email}}"  required  hidden/>
                    </div>
                    <div class="form-group">
                      <label for="amount">Amount</label>
                      <input type="number" id="amount" class="form-control" required />
                    </div>
                    <div class="form-group" hidden>
                      <label for="first-name">First Name.</label>
                      <input type="text" id="first-name" value="{{Auth::user()->name}}" hidden />
                    </div>
                    <div class="form-group" hidden>
                      <label for="last-name">Last Name</label>
                      <input type="text" id="last-name" value="{{Auth::user()->id}}" hidden />
                    </div>

                    <div class="form-submit">
                      <button type="submit" style="width:100%" class="btn btn-success" onclick="payWithPaystack()"> Pay </button>
                    </div>
                  </form>
                  <script src="https://js.paystack.co/v1/inline.js"></script> 


                  <script>
                  const paymentForm = document.getElementById('paymentForm');
                  paymentForm.addEventListener("submit", payWithPaystack, false);
                  function payWithPaystack(e) {
                    e.preventDefault();
                    let handler = PaystackPop.setup({
                      key: 'pk_test_8fb90d70196c1b277ae8be739f363bee5ae991ab', // Replace with your public key
                      email: document.getElementById("email-address").value,
                      amount: document.getElementById("amount").value * 100,
                      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                      // label: "Optional string that replaces customer email"
                      onClose: function(){
                        alert('Window closed.');
                      },
                      callback: function(response){
                        let message = 'Payment complete! Reference: ' + response.reference;
                        
                        
                        fetch(`/_payout/${response.reference}`).
                        then(data => json(data)).
                        then(res => {
                               console/log(res);
                        }).
                        catch(
                          // alert('something went wrong')
                        );


                      }
                    });
                    handler.openIframe();
                  }
                  </script>

                </div>
              </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
{{-- ///////// --}}
@endsection