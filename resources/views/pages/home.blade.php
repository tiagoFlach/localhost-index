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
                    <?php //@include('layout.partials.file-explorer') ?>
                    @include('layout.partials.file-explorer') 



                    
                    <?php // @include('layout.partials.file-explorer-3') ?>
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

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    function listDir(dir, file){

        $.ajax({
            url: "{{ route('listDir') }}",
            type: "post",
            data: {
                'directory': dir
            },
            dataType: "json",
            success: function(response){
                console.log(response);
                $("#".file).append('<td>oi' + response + '</td>');
                
            }
        })

        
        // $.post("{{ route('listDir') }}",
        // {
        //     directory: dir
        // },
        // function(data){
        //     $("#result").append('<p>' + data + '</p>');
        //     $("#result").load("tbody", {peoples:peoples});
        // })
    }
</script>
@endsection