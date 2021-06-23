@extends('layouts.app')
@section('content')
{{-- //////     --}}


     <!-- partial -->
     <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.menu')

      
      <div class="main-panel">
        <div class="content-wrapper" style="padding-top: 200px">
          <div class="col-md-6 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body justify-content-around" style="">
                  <h4 class="card-title">Set Rake And Pool Percentage</h4><hr>
                  <form method="post" action="_rake_pool" class="forms-sample">
                    @csrf
                    
                   <div class="row justify-content-around">
                     
                    <div class="form-group">
                      <label for="exampleInputName1">ADMIN Rake per bet</label>
                      <input type="number" onchange="set('rake')" name="commision" class="form-control" id="rake"  >
                    </div>
                
                    
                
                    <div class="form-group">
                      <label for="exampleInputCity1">POOL per bet</label>
                      <input type="number" name="pool" onchange="set('pool')" class="form-control" id="pool" 
                      
                      >
                    </div>

                   </div>
               
                   <script>

                     function set(what){
                       //\ alert('yup');
                        if(what == 'rake'){
                          document.getElementById('pool').value = 100 - document.getElementById('rake').value
                        }else{
                          document.getElementById('rake').value = 100 - document.getElementById('pool').value
                        }
                        
                     }
                  </script>          

              
                   
                    <button type="submit" style="width: 100%" class="btn btn-success mr-2">Submit</button>
               
                  </form>
                </div>
              </div>
          </div>







        <div class="col-md-6 mx-auto grid-margin stretch-card">
          <div class="card">
            <div class="card-body justify-content-around" style="">
              <h4 class="card-title"></h4><hr>
              <form method="post" action="_rake_pool" class="forms-sample">
                @csrf
                
               <div class="row justify-content-around">
                 
                <div class="form-group">
                  <label for="exampleInputName1">ADMIN Rake per bet</label>
                  <input type="number" onchange="set('rake')" name="commision" class="form-control" id="rake"  >
                </div>
            
                
            

               </div>
           
               <script>

                 function set(what){
                   //\ alert('yup');
                    if(what == 'rake'){
                      document.getElementById('pool').value = 100 - document.getElementById('rake').value
                    }else{
                      document.getElementById('rake').value = 100 - document.getElementById('pool').value
                    }
                    
                 }
              </script>          

          
               
                <button type="submit" style="width: 100%" class="btn btn-success mr-2">Submit</button>
           
              </form>
            </div>
          </div>
      </div>
    </div>
        <!-- content-wrapper ends -->
{{-- ///////// --}}
@endsection