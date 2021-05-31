<x-app-layout>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

               <div class="card">
                   
                   <div class="card-body">
                      
                      
                      <form action="/play/2/0004" method="post">@csrf
                          <div class="row justify-content-center">
                              <input type="number" name="1" id="" placeholder="first number"required maxlength="2">
                              <input type="number" name="2" id="" placeholder="second number"required maxlength="2">
                              <input type="number" name="3" id="" placeholder="third number"required maxlength="2">
                              <input type="number" name="4" id="" placeholder="fourth number"required maxlength="2">
                              <input type="number" name="5" id="" placeholder="fifth number"required maxlength="2">
                              <button type="submit" class="btn btn-outline-secondary">submit</button>
                          </div>
                      </form><br>
                      
            
                   </div>
               </div>

               <br>

               <div class="card">
               
               
            </div>








            </div>
        </div>
    </div>
</x-app-layout>
