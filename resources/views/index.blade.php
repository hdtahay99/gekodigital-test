<!doctype html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Test técnico Deko Digital">
        <title>Solver Sudoku</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('css/plantilla.css') }}">
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.16/dist/css/bootstrap-select.min.css"> -->
    </head>

    <body class="theme-green">  
        
        <div id="app">
            <div class="page-loader-wrapper">
                <div class="loader">
                    <div class="m-t-30"><img class="zmdi-hc-spin" src="images/loader.svg" width="100" height="100"></div>
                    <p>Cargando...</p>
                </div>
            </div>


            <aside id="leftsidebar" class="sidebar">
                <div class="menu">
                    <ul class="list">

                        <li @click="menu=0"><a href="#"><i class="zmdi zmdi-case-play"></i><span>Jugar Sudoku</span></a></li>
                        <li @click="menu=1"><a href="#"><i class="zmdi zmdi-accounts-list-alt"></i><span>Historial soluciones</span></a></li>

                    </ul>
                </div>
            </aside>


            @yield('contenido')

        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ mix('js/plantilla.js') }}"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.16/dist/js/bootstrap-select.min.js"></script> -->

    </body>
</html>


<script>
    function lateral(){
       let bod = document.body;

       if(bod.classList.contains('ls-toggle-menu')){
            bod.classList.remove('ls-toggle-menu');
        }else{
            bod.classList.add('ls-toggle-menu');
        }
   }
</script>