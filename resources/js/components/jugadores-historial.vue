
<template>
    <section class="content">
        <div class="body_scroll">
            
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Historial de Soluciones Sudoku</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i>Sudoku</a></li>
                         </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" @click="responsive()" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" @click="responsive()" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
                </div>

            </div>

            <!--main--> 
            <div class="container-fluid">

                <!--cuerpo de tabla y paginación--> 
                <template v-if="bandera==1">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-hover product_item_list c_table theme-color mb-0">
                                        <thead>
                                            <tr>
                                                <th>Visualizar Solución</th>
                                                <th>Nickname</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="gamer in arrayJugadores" :key="gamer.id">
                                                <td>
                                                    <button type="button" @click="verSolucionSudoku(gamer)" class="btn btn-success btn-sm">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </button>

                                                </td>
                                                <td v-text="gamer.nickname"></td>
                                                <td v-text="gamer.created_at"></td>

                                            </tr>     
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                            <!--Paginación de tabla-->
                            <div class="card">
                                <div class="body">
                                    <ul class="pagination pagination-primary m-b-0">
                                        <li class="page-item" v-if="pagination.current_page > 1">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)"><i class="zmdi zmdi-arrow-left"></i></a>
                                        </li>
                                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)"><i class="zmdi zmdi-arrow-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <!--fin cuerpo y paginación-->

                <!--Template para visualizar la solución del jugador-->
                <template v-if="bandera == 2">
                
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Matriz de Entrada</label>
                                        <form class="form-inline">
                                            <table class="table" style="width: 75%;" border="2" cellpadding="20">
                                                <tbody>

                                                    <tr v-for="(x, inx) in arrayEntradas" v-bind:key="inx">
                                                        
                                                        <td v-for="(y, iny) in x" v-bind:key="iny" >
                                                            <template v-if="y == 0">
                                                                <label v-text="'-'"></label>
                                                            </template>
                                                            <template v-else>
                                                                <label v-text="y"></label>
                                                            </template>
                                                        </td> 

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Matriz de Solución</label>
                                        <form class="form-inline">
                                            <table class="table" style="width: 75%;" border="2" cellpadding="20">
                                                <tbody>

                                                    <tr v-for="(x, inx) in arraySolucion" v-bind:key="inx">
                                                        
                                                        <td v-for="(y, iny) in x" v-bind:key="iny" v-text="y"></td> 

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-secondary" @click="cerrar()">Regresar</button>
                                    </div>
                                </div>


                            </div>

                        </div>            
                    </div>
                    
                </template>
                <!--Fin template visualizar-->


            </div>
            <!--fin main-->  

        </div>
    </section>
</template>
<script>

    export default {
        data (){
            return {
                
                arrayJugadores: [],
                arrayEntradas: [[]],
                arraySolucion: [[]],
                bandera: 1,
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,

            }
        },
        computed:{
            isActived : function(){
                return this.pagination.current_page;
            },
            pagesNumber : function(){
                if(!this.pagination.to){
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page)
                {
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }

                return pagesArray;
            },
        },
        methods : {
            cambiarPagina(page){
                let me = this;
                me.pagination.current_page = page;
                me.listarJugadores(page);
            },
            responsive(){
                let me = this;
                let body = document.body;
                let asyde =   document.getElementById('leftsidebar');
                // console.log(asyde);
                    if (screen.width < 1024){
                        if(asyde.classList.contains('open')){
                            asyde.classList.remove('open');
                        }else{
                             asyde.classList.add('open');
                        }
                    }  
                    else if (screen.width < 1280){       
                        if(body.classList.contains('right_icon_toggle')){
                            body.classList.remove('right_icon_toggle');
                        }else{
                            body.classList.add('right_icon_toggle');
                        }
                    }else{
                        if(body.classList.contains('right_icon_toggle')){
                            body.classList.remove('right_icon_toggle');
                        }else{
                            body.classList.add('right_icon_toggle');
                        }
                    } 
            },
            listarJugadores(page){
                let me=this;
                let url= `/sudoku-historial/jugadores?page=${page}`;
                axios.get(url).then( (response) => {
                    let respuesta= response.data;
                    me.arrayJugadores = respuesta.jugadores.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(console.log);
            },
            verSolucionSudoku(gamer){

                this.arrayEntradas = this.montarArray(gamer.entradas);
                this.arraySolucion = this.montarArray(gamer.sudokus);
                this.bandera       = 2;

            },
            cerrar(){
                this.bandera       = 1;
                this.arrayEntradas = [[]];
                this.arraySolucion = [[]];
            },
            montarArray(array){

                let arrTemp = [[]];
                let contador = 0;
                for (let x = 0; x < array.length; x++) {
                    if(array[x].x == contador){
                        arrTemp[contador].push(array[x].value);
                    } else {
                        if(contador <= 8) {
                            contador++;
                        } else {
                            contador = 0;
                        }
                        arrTemp.push([]);
                        arrTemp[contador].push(array[x].value);
                    }

                    
                }

                return arrTemp;

            },
        },
        mounted() {
            this.listarJugadores(1);         
        }
    }
</script>