<template>

    <section class="content">

        <div class="body_scroll">

            <div class="block-header">

                <div class="row">

                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Sudoku</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">Sudoku Solver</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu"  @click="responsive()"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">                
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" @click="responsive()" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    </div>

                </div>

            </div>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                                <div class="form-group">
                                    
                                    <div class="form-inline">
                                        
                                        <input v-model="direccion_x" max = "8" min = "0" v-on:keyup="direccion_x = comprobarCoordenada(direccion_x)" type="number" style="width: 30%" class="form-control" placeholder="Ingresa coordenada X" />
                                        <input v-model="direccion_y" max = "8" min = "0" v-on:keyup="direccion_y = comprobarCoordenada(direccion_y)" type="number" style="width: 30%" class="form-control" placeholder="Ingresa coordenada Y" />
                                        <input v-model="valor" max = "9" min = "1" v-on:keyup="valor = comprobarValor(valor)" type="number" style="width: 30%" class="form-control" placeholder="Ingresa el valor" />

                                    </div>

                                    <button style="float:left;" type="button" @click="comprobarGeneral()" class="btn btn-info waves-effect m-t-20">Ingresar</button>
                                    <button style="float:left; left: 20px;" type="button" @click="resolverTablero()" class="btn btn-danger waves-effect m-t-20">Resolver Tabla</button>
                                    <button style="float:left; left: 40px;" type="button" @click="limpiar()" class="btn btn-success waves-effect m-t-20">Nuevo Juego</button>
                                    <template v-if="arraySolucion.length == 9">
                                            <button style="float:left; left: 60px;" type="button" @click="guardarSolucion()" class="btn btn-primary waves-effect m-t-20">¿Guardar Partida?</button>
                                    </template>


                                </div>
                        </div>

                        <div class="card">

                            <table class="table" style="width: 50%; float:left; right: 20px;" border="2" cellpadding="20">
                                <tbody v-if="arrayValores.length">

                                    <tr v-for="(x, inx) in arrayValores" v-bind:key="inx">

                                        <td v-for="(y, iny) in x" v-bind:key="iny" v-text="y"></td> 

                                    </tr>
                                </tbody>
                            </table>

                            <template v-if="arraySolucion.length == 9">
                                <table class="table" style="width: 50%; float:left; right: 20px;" border="2" cellpadding="20">
                                    <tbody>

                                        <tr v-for="(x, inx) in arraySolucion" v-bind:key="inx">

                                            <td v-for="(y, iny) in x" v-bind:key="iny" v-text="y"></td> 

                                        </tr>
                                    </tbody>
                                </table>  
                            </template>


                        </div>

                    </div>            
                </div>

            </div>

        </div>

    </section>

</template>

<script>
    export default {
        data (){
            return {
                nickname: '',
                direccion_x: '',
                direccion_y: '',
                valor:       '',
                arrayValores: [[]],
                arraySolucion: [[]],
            }
        },
        computed:{
            
        },
        methods : {
            guardarSolucion(){

                swal('Escribe tu nickname:', {
                    content: 'input',
                })
                .then((value) => {
                    this.nickname = value;
                }).finally(() => {

                    if(this.nickname == '' || this.nickname == null){
                        swal({
                            type: 'error',
                            title: '¡Error!',
                            text: 'Ingresa un nickname!'
                        });

                        return;
                    }

                    axios.post('/sudoku-partida/store',{
                        'nickname': this.nickname,
                        'data'    : this.arraySolucion,
                        'entrada': this.arrayValores,
            
                    }).then( (response) => {

                        $.notify({
                            message: 'Su partida con la solución ha sido almacenada con éxito' 
                        },
                        {
                            type: 'bg-green',
                            allow_dismiss: true,
                            newest_on_top: true,
                            timer: 5,
                            placement: {
                                from: 'top',
                                align: 'center'
                            },
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            },
                            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (true ? "" : "") + '" role="alert">' +
                            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                            '<span data-notify="icon"></span> ' +
                            '<span data-notify="title">{1}</span> ' +
                            '<span data-notify="message">{2}</span>' +
                            '<div class="progress" data-notify="progressbar">' +
                            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                            '</div>' +
                            '<a href="{3}" target="{4}" data-notify="url"></a>' +
                            '</div>'
                        });

                    })
                    .catch(console.log)
                    .finally(() => this.limpiar());


                });

            },
            limpiar(){
                this.direccion_x   = '';
                this.direccion_y   = '';
                this.valor         = '';
                this.arrayValores  = [[]];
                this.arraySolucion = [[]];
                this.boot();
            },
            responsive(){
                let me = this;
                let body = document.body;
                let asyde =   document.getElementById('leftsidebar');
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
            comprobarCoordenada(numero){

                return (isNaN(numero)) ? '' 
                                       : (parseInt(numero) < 0 || parseInt(numero) > 8 ) ? ''
                                       : (isNaN(numero) === false) ? numero : '';

            },
            comprobarValor(value){
                
                return (isNaN(value)) ? '' 
                                       : (parseInt(value) < 1 || parseInt(value) > 9 ) ? ''
                                       : (isNaN(value) === false) ? value : '';

            },
            comprobarGeneral(){

                if(this.direccion_x === '' || this.direccion_y === '' || this.valor === ''){
                    swal({
                        type: 'error',
                        title: '¡Error!',
                        text: 'Revise los valores que ingresó, son incorrectos!'
                    });
                } else {

                    let arrayTemp = [[]];
                    arrayTemp     = this.arrayValores;

                    arrayTemp[this.direccion_x][this.direccion_y] = parseInt(this.valor);
                    this.arrayValores = arrayTemp;

                    console.table(this.arrayValores[this.direccion_x][this.direccion_y]);

                    this.direccion_x = '';
                    this.direccion_y = '';
                    this.valor       = '';

                }

            },
            resolverTablero(){
                const entradaValida = this.validarTabla(this.arrayValores);
                
                if (!entradaValida){
                    swal({
                        type: 'error',
                        title: '¡Error!',
                        text: 'La tabla dada es inválida!'
                    });
                    this.limpiar();
                }
                else{
                    const respuesta = this.solucionador(this.arrayValores);
                    this.dibujarTablaSolucion(respuesta);
                }
            },
            solucionador(tabla) {

                if (this.tablaSolucionada(tabla)) {
                    return tabla;
                } else {
                    const posibilidades = this.probarSiguienteTabla(tabla);
                    const tablaValida = this.depurarValidacion(posibilidades);
                    return this.obtenerSolucion(tablaValida);
                }
            },
            obtenerSolucion(tablas) {

                if (tablas.length < 1) {
                    return false;
                } else {
                    let primero = tablas.shift();
                    const ruta = this.solucionador(primero);
                    if (ruta != false) {
                        return ruta;
                    } else {
                        return this.obtenerSolucion(tablas);
                    }
                }

            },
            tablaSolucionada(tabla) {

                for (let i = 0; i < 9; i++) {
                    for (let j = 0; j < 9; j++) {
                        if (tabla[i][j] == null) {
                            return false;
                        }
                    }
                }
                return true;
            },
            probarSiguienteTabla(tabla) {

                let res = [];
                const primerVacio = this.encontrarCuadroVacio(tabla);
                if (primerVacio != undefined) {
                    const y = primerVacio[0];
                    const x = primerVacio[1];
                    for (let i = 1; i <= 9; i++) {
                        let nuevaTabla = [...tabla];
                        let fila = [...nuevaTabla[y]];
                        fila[x] = i;
                        nuevaTabla[y] = fila;
                        res.push(nuevaTabla);
                    }
                }
                return res;
            },
            encontrarCuadroVacio(tabla) {

                for (let i = 0; i < 9; i++) {
                    for (let j = 0; j < 9; j++) {
                        if (tabla[i][j] == null) {
                            return [i, j];
                        }
                    }
                }
            },
            depurarValidacion(tablas) {

                let res = []
                for (let i = 0; i < tablas.length; i++) {
                    if (this.validarTabla(tablas[i])) {
                        res.push(tablas[i]);
                    }
                }
                return res;
            },
            validarTabla(board) {
                return this.depurarFilas(board) && this.depurarColumnas(board) && this.depurarCuadros(board);
            },
            depurarFilas(tabla) {

                for (let i = 0; i < 9; i++) {
                    let cur = [];
                    for (let j = 0; j < 9; j++) {
                        if (cur.includes(tabla[i][j])) {
                            return false;
                        } else if (tabla[i][j] != null) {
                            cur.push(tabla[i][j]);
                        }
                    }
                }
                return true;
            },
            depurarColumnas(tabla) {

                for (let i = 0; i < 9; i++) {
                    let cur = [];
                    for (let j = 0; j < 9; j++) {
                        if (cur.includes(tabla[j][i])) {
                            return false;
                        } else if (tabla[j][i] != null) {
                            cur.push(tabla[j][i]);
                        }
                    }
                }
                return true;
            },
            depurarCuadros(tabla) {
                const coordenadaTresporTres = [
                        [0, 0],
                        [0, 1],
                        [0, 2],
                        [1, 0],
                        [1, 1],
                        [1, 2],
                        [2, 0],
                        [2, 1],
                        [2, 2]
                    ];

                for (let y = 0; y < 9; y += 3) {

                    for (let x = 0; x < 9; x += 3) {

                        let cur = [];

                        for (let i = 0; i < 9; i++) {
                            let coordenadas = [...coordenadaTresporTres[i]];
                            coordenadas[0] += y;
                            coordenadas[1] += x;
                            if (cur.includes(tabla[coordenadas[0]][coordenadas[1]])) {
                                return false;
                            } else if (tabla[coordenadas[0]][coordenadas[1]] != null) {
                                cur.push(tabla[coordenadas[0]][coordenadas[1]]);
                            }
                        }

                    }

                }
                return true;
            },
            dibujarTablaSolucion(tabla) {

                if (tabla === false) {
                    swal({
                        type: 'error',
                        title: '¡Error!',
                        text: 'No existe solución para la tabla dada!'
                    });
                    this.boot();
                } else {
                    this.arraySolucion = tabla;
                }
            },
            boot(){
                
                for (let x = 0; x <= 8; x++) {
                    for (let y = 0; y < 9; y++) {
                        this.arrayValores[x].push(null);
                    }

                    if(x <= 7){
                        this.arrayValores.push([]);
                    }
                }

            },
        },
        mounted() {
            this.boot();
        }
    }
</script>