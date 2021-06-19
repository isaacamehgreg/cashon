@extends('layouts.app')
@section('content')
{{-- //////     --}}


     <!-- partial -->
     <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.menu')

      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-md-6 mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add new Agent</h4>
                  <form method="post" action="create_an_agent" class="forms-sample">
                    @csrf
                    
                    {{-- <div class="form-group">
                      <label for="exampleInputName1">Agent Incharge</label>
                      
                       <select class="form-control" name="agent" id="exampleInputCity1">
                        <option disabled selected>--Select agent incharge--</option>
                        @foreach ($agents as $agent)
                          <option value="{{$agent->id}}">{{$agent->name}}</option>  
                        @endforeach
              
                       <select>

                      
                    </div> --}}

                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>
                
                    <div class="form-group">
                      <label for="exampleInputCity1">Area</label>
                      <select class="form-control" name="area" id="exampleInputCity1">
                        <option disabled selected>--Select Area--</option>
                        <option value="Lekki">Lekki1</option>
                        <option value="Ajah">Ajah</option>
                        <option value="Elegushi">Elegushi</option>
                        <option value="Lekki">Lekki 2</option>
                        <option value="V-I">V-I</option>
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Phone</label>
                      <input type="text" name="phone" class="form-control" id="exampleInputCity1" placeholder="Phone">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Email address</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">State</label>
                      
                      <select class="form-control" name="state" id="exampleInputCity1">
                        <option disabled selected>--Select State--</option>
                        <option value="Abia">Abia</option>
                        <option value="Adamawa">Adamawa</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                        <option value="Anambra">Anambra</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Bayelsa">Bayelsa</option>
                        <option value="Benue">Benue</option>
                        <option value="Borno">Borno</option>
                        <option value="Cross Rive">Cross River</option>
                        <option value="Delta">Delta</option>
                        <option value="Ebonyi">Ebonyi</option>
                        <option value="Edo">Edo</option>
                        <option value="Ekiti">Ekiti</option>
                        <option value="Enugu">Enugu</option>
                        <option value="FCT">Federal Capital Territory</option>
                        <option value="Gombe">Gombe</option>
                        <option value="Imo">Imo</option>
                        <option value="Jigawa">Jigawa</option>
                        <option value="Kaduna">Kaduna</option>
                        <option value="Kano">Kano</option>
                        <option value="Katsina">Katsina</option>
                        <option value="Kebbi">Kebbi</option>
                        <option value="Kogi">Kogi</option>
                        <option value="Kwara">Kwara</option>
                        <option value="Lagos">Lagos</option>
                        <option value="Nasarawa">Nasarawa</option>
                        <option value="Niger">Niger</option>
                        <option value="Ogun">Ogun</option>
                        <option value="Ondo">Ondo</option>
                        <option value="Osun">Osun</option>
                        <option value="Oyo">Oyo</option>
                        <option value="Plateau">Plateau</option>
                        <option value="Rivers">Rivers</option>
                        <option value="Sokoto">Sokoto</option>
                        <option value="Taraba">Taraba</option>
                        <option value="Yobe">Yobe</option>
                        <option value="Zamfara">Zamfara</option>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
               
                  </form>
                </div>
              </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
{{-- ///////// --}}
@endsection