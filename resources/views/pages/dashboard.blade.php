@extends('layout.mainlayout')

@section('title')
Dashboard
@endsection

@section('scripts-js')
@endsection

@section('page-content')





<!----------------------------------------------------------------------------->



<!-- Page Content -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">/html</h6>
    </div>

    <!-- Card Body -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Data de modificação</th>  
                        <th>Tamanho</th>  
                    </tr>
                </thead>
                <tbody>      
                </tbody>
            </table>
        </div>
    </div>
    <!-- End of Card Body -->
</div>
<!-- End of Page Content -->



<!----------------------------------------------------------------------------->



<!-- Page Content -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">/html ESSA AQUI</h6>
    </div>

    <!-- Card Body -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Data de criação</th> 
                        <th>Última modificação</th> 
                        <th>Tamanho</th>  
                    </tr>
                </thead>
                <tbody>
                    <?php // @include('layout.partials.file-explorer') ?>
                    <?php // @include('layout.partials.file-explorer-2') ?>



<script type="text/javascript">
    // const globby = require('globby');
    // const listAllFilesAndDirs = dir => globby(`${dir}/**/*`);
    

    // (async () => {
    //   const result = await listAllFilesAndDirs(process.cwd());
    //   console.log(result);
    // })();
</script>



<script type="text/javascript">
    const dirTree = require("directory-tree");
    const tree = dirTree("/resources");

    console.log($tree);
</script>

                    
                    <?php // @include('layout.partials.file-explorer-3') ?>
                </tbody>
            </table>
        </div>
        <!-- End of Table Responsive -->        
    </div>
    <!-- End of Card Body -->
</div>
<!-- End of Page Content -->

@endsection