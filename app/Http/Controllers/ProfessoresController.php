<?php

namespace App\Http\Controllers;

use App\Modalidade;
use App\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professores = Professor::all();
        return view('professores.list', ['professores' => $professores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modalidades = Modalidade::all();
        return view('professores.new', ['modalidades' => $modalidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:professores',
            'modalidade' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $professor = new Professor();
            $professor->nome = $request->nome;
            $professor->email = $request->email;
            $professor->save();

            if(is_array($request->modalidade)) {
                foreach ($request->modalidade as $m) {
                    $modalidade = Modalidade::find($m);
                    $professor->modalidades()->attach($modalidade);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', "Professor Adicionado com sucesso");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modalidades = Modalidade::all();
        $prof = Professor::find($id);
        return view('professores.edit',['prof'=>$prof,'modalidades'=>$modalidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'modalidade' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $professor = Professor::find($id);
            $professor->nome = $request->nome;
            $professor->email = $request->email;
            $professor->save();
            $professor->modalidades()->detach();
            if(is_array($request->modalidade)) {
                foreach ($request->modalidade as $m) {
                    $modalidade = Modalidade::find($m);
                    $professor->modalidades()->attach($modalidade);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', "Professor Alterado com sucesso");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
         * OU também:
         * Professor::destroy($id)
         */
        try {

            $professor = Professor::find($id);
            $professor->delete();
            return redirect()->back()->with('success', "Professor Excluído com sucesso");

        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }

    }
}
