<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Gamer;
use App\Sudoku;
use App\GiveSudoku;

class SudokuController extends Controller
{
    public function index(Request $request){
        if(!$request -> ajax()) return redirect('/');
        
        $jugadores = Gamer::with('sudokus', 'entradas')
                          ->orderBy('created_at', 'desc')
                          ->paginate(3);

        return [
            'pagination' => [
                'total'        => $jugadores->total(),
                'current_page' => $jugadores->currentPage(),
                'per_page'     => $jugadores->perPage(),
                'last_page'    => $jugadores->lastPage(),
                'from'         => $jugadores->firstItem(),
                'to'           => $jugadores->lastItem(),
            ],
            'jugadores' => $jugadores
        ];

    }

    public function store(Request $request){
        if(!$request -> ajax()) return redirect('/');

        try{

            DB::beginTransaction();

            $gamer           = new Gamer();
            $gamer->nickname = $request->nickname;
            $gamer->save();

            $coordenadas = $request->data;
            $entradas    = $request->entrada;

            foreach($coordenadas as $inx=>$coordenada){

                foreach($coordenada as $iny=>$dir){

                    $sudoku               = new Sudoku();
                    $sudoku->idgamer      = $gamer->id;
                    $sudoku->x     = $inx;
                    $sudoku->y     = $iny;
                    $sudoku->value = (int) $dir;
                    $sudoku->save();
                }
                
            }

            foreach($entradas as $inx=>$entrada){

                foreach($entrada as $iny=>$dir){

                    $give             = new GiveSudoku();
                    $give->idgamer    = $gamer->id;
                    $give->x     = $inx;
                    $give->y     = $iny;
                    $give->value = (int) $dir;
                    $give->save();
                }
                
            }

            DB::commit();

        } catch(Exception $e) {

            DB::rollBack();

        }
        


    }
}
