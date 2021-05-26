<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

               <div class="card">
                   <img class="card-img-top" src="holder.js/100x180/" alt="">
                   <div class="card-body">
                       <br>
                       <div class="row">
                        <h1 style="margin-left:50%; ">game placing</h1>
                       </div><br>
                      
                      <form action="/play" method="post">@csrf
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
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <br>
                    <div class="row">
                     <h1 style="margin-left:50%; ">games listed</h1>
                    </div><br>
                    
                    <table style="width: 100%">
                        <tr>
                          <th>id</th>
                          <th>terminal</th>
                          <th>1</th>
                          <th>2</th>
                          <th>3</th>
                          <th>4</th>
                          <th>5</th>
                          <th>paid</th>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>NG-LG-0001</td>
                          <td>17</td>
                          <td>9</td>
                          <td>35</td>
                          <td>0</td>
                          <td>25</td>
                          <td>300</td>
                          
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>NG-LG-0001</td>
                            <td>17</td>
                            <td>9</td>
                            <td>35</td>
                            <td>0</td>
                            <td>25</td>
                            <td>500</td>
                            
                          </tr>
                    </table>
                    <button type="submit">Play the game</button>
                   <br>
                   
         
                </div>
            </div>



            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <br>
                    <div class="row">
                     <h1 style="margin-left:50%; ">results</h1>
                    </div><br>
                    <h1 style="margin-left:50%; ">most appering numbers</h1>
                    <table style="width: 100%">
                        <tr>
                          <th></th>
                          <th></th>
                          <th>40%</th>
                          <th>10%</th>
                          <th>30%</th>
                          <th>10%</th>
                          <th>10%</th>
                          <th></th>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td>17</td>
                          <td>9</td>
                          <td>35</td>
                          <td>0</td>
                          <td>25</td>
                          <td></td>
                          
                        </tr>
                      
                    </table>
                   
         
                </div>
            </div>






            </div>
        </div>
    </div>
</x-app-layout>
