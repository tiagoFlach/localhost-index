@extends('layout.mainlayout')

@section('title')
@endsection

@section('page-title')
@endsection

@section('custom-style')
<!-- Custom style -->
<link href="{{ asset('css/custom/file-explorer.css') }}" rel="stylesheet">

<link href="{{ asset('vendor/jquery-treegrid/css/jquery.treegrid.css') }}" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection



@section('page-content')
<!-- Page Content -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">/html TESTE TABELA</h6>
    </div>

        <div class="table-responsive">
            <table class="tree table table-striped">
                <tr class="treegrid-1">
                    <td>Root node</td><td>Additional info</td>
                </tr>
                <tr class="treegrid-2 treegrid-parent-1">
                    <td>Node 1-1</td><td>Additional info</td>
                </tr>
                <tr class="treegrid-3 treegrid-parent-1">
                    <td>Node 1-2</td><td>Additional info</td>
                </tr>
                <tr class="treegrid-4 treegrid-parent-3">
                    <td>Node 1-2-1</td><td>Additional info</td>
                </tr>
                <tr class="treegrid-5 treegrid-parent-1">
                    <td>Node 1-3</td><td>Additional info</td>
                </tr>
            </table> 
        </div>
        <div class="table-responsive">
            <table class="tree table table-striped" id="tree">
                <thead class="thead-dark">
                    <th></th>
                    <th>Nome</th>
                    <th>Tamanho</th>
                    <th class="text-right">Criado</th> 
                    <th class="text-right">Modificado</th>
                    <th></th>
                </thead>
                <tbody>
                
                </tbody>
            </table> 
        </div>
</div>



<!-- Page Content -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">/html</h6>
    </div>

    <!-- Card Body -->
    <!-- <div class="card-body"> -->
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th col="1"></th>
                        <th>Nome</th>
                        <th>Tamanho</th>
                        <th class="text-right">Criado</th> 
                        <th class="text-right">Modificado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @include('layout.partials.file-explorer') 
                    
                </tbody>
            </table>
            

            <div id="result"></div>
        </div>
        <!-- End of Table Responsive --> 
              
    <!-- </div> -->
    <!-- End of Card Body -->
</div>
<!-- End of Page Content -->

@endsection

@section('scripts-js')
<!-- <script src="{{ asset('js/custom/file-explorer.js') }}"></script> -->

<script src="{{ asset('vendor/jquery-treegrid/js/jquery.treegrid.min.js') }}"></script>
<!-- <script src="{{ asset('vendor/jquery-treegrid/js/jquery.treegrid.bootstrap3.js') }}"></script> -->

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('.tree').treegrid();
        $('#tree').treegrid();
    });    

    $('body').onload = listDir('{{$localhost_path}}', 'tbody');
    var treegrid_count = 1;

    function listDir(path, htmlId){
        $.ajax({
            url: "{{ route('listDir') }}",
            type: "post",
            data: {
                'directory': path
            },
            dataType: "json",
            success: function(response){
                printDir(response, htmlId)
            }
        });
    };

    function printDir(data, htmlId){
        $.each(data, function(i, val){

            if(val.isDir){
                line1 = "<tr class=\"treegrid-" + treegrid_count + "\">";
                adicional = "<tr id=\"" + i + "\"></tr>"
                treegrid_count ++;
            } else {
                adicional = "";
                line1 = "<tr>";
            }

            line2 = "<td></td>";
            filename = "<td>" + val.Filename  + "</td>";
            size = "<td>" + val.Size + "</td>";
            created = "<td class=\"text-right\">" + val.CTime + "</td>";
            modified = "<td class=\"text-right\">" + val.MTime + "</td>";
            line3 = "</tr>";
            $("#tree " + htmlId).append(line1 + line2 + filename + size + created + modified + line2 + line3 + adicional);
            
        })
    };
</script>
@endsection