<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="table-responsive">
        <table class="table table-striped table-bordered first">
            <thead>
                <tr>
                    <th><b style="color: #5E2CED;">DATE</th>
                    <th><b style="color: #5E2CED;">DESCRIPTION.</th>
                    <th><b style="color: #5E2CED;">REMARK</b></th>
                    <th><b style="color: #5E2CED;">AMOUNT</th>
    
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($usage as $use)
                
                    <tr>
                        <td>{{ date( 'jS'.' \o\f'.' M, Y'.' \a\t'. ' g:iA', strtotime( $use->created_at )) }}</td>
                        <td>{{ $use->paying_for }}</td>
                        <td>{{ $use->remark ?? 'No Remark' }} </td>
                        <td>₦{{ $use->amount }}</td>
                    </tr>
                @endforeach --}}
                @foreach(DB::table('bets')->orderBy('created_at', 'DESC')->get() as $bet)
                <tr>
             
                  
                  <td >{{$bet->game_code}}</td>
                  <td >{{$bet->ticket_number}}</td>
                  <td class="text-primary">{{$bet->bet_code}}</td>
                  <td class="text-danger">{{$bet->stake}}</td>
         
              
                 
                  
                
                </tr>
                @endforeach
              
            </tbody>
           
        </table>
    
</body>
</html>






    <script src="/libs/js/axios.min.js"></script>
<script src="/libs/js/sweetalert2.all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
 <script src="/vendor/datatables/js/data-table.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>