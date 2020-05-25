<?php

namespace App\Http\Controllers;

use App\Modalidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModalidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modalidades = Modalidade::all();
        return view('modalidades.list',['modalidades'=>$modalidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modalidades.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'=>'required',
            'horario'=>'required'
        ]);

        try {
            Modalidade::create(['nome' => $request->nome,'horario'=>$request->horario]);
            return redirect()->back()->with('success',"Modalidade adicionada com sucesso");
        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage()." ".$e->getFile()." ".$e->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mod = Modalidade::find($id);
        return view('modalidades.edit',['mod'=>$mod]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome'=>'required',
            'horario'=>'required'
        ]);

        try {
            DB::beginTransaction();
            $modalidade = Modalidade::find($id);
            $modalidade->nome = $request->nome;
            $modalidade->horario = $request->horario;
            $modalidade->save();

            DB::commit();
            return redirect()->back()->with('success', "Modalidade Alterada com sucesso");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $modalidade = Modalidade::find($id);
            $modalidade->delete();
            return redirect()->back()->with('success', "Modalidade Excluída com sucesso");

        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }

    }
}
