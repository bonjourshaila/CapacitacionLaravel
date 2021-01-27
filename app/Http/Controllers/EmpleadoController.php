<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::orderBy('id','DESC')->paginate(3);

        return view('empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = $this->getWSSoap()->AllCurrenciesResult;
        $arrayCurrencies = explode(';',$currencies, -1);

        return view('Empleado.create', compact('arrayCurrencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['nombre' => 'required|max:50',
            'puesto'    => 'required|between:3,25',
            'email'     => 'required|email',
            'edad'      => 'required|numeric',
            'antiguedad'    => 'required|numeric',
            'sueldo'        => 'required|numeric',
            'moneda_sueldo' => 'required'
            ]);

        Empleado::create($request->all());
        return redirect()->route('empleado.index')->with('success','Registro Creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);
        return view('empleado.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currencies = $this->getWSSoap()->AllCurrenciesResult;
        $arrayCurrencies = explode(';',$currencies, -1);

        $empleado = Empleado::find($id);
        return view('empleado.edit',compact('empleado','arrayCurrencies'));
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

        $this->validate($request,['nombre' => 'required|max:50',
            'puesto'    => 'required|between:3,25',
            'email'     => 'required|email',
            'edad'      => 'required|numeric',
            'antiguedad'    => 'required|numeric',
            'sueldo'        => 'required|numeric',
            'moneda_sueldo' => 'required'
        ]);

        Empleado::find($id)->update($request->all());
        return redirect()->route('empleado.index')->with('success','Registro Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Empleado::find($id)->delete();
        return redirect()->route('empleado.index')->with('success','Registro eliminado');
    }

    private function getWSSoap(){
        $wsdl = "https://fx.currencysystem.com/webservices/CurrencyServer5.asmx?wsdl";

        $client = new \SoapClient($wsdl,["licenceKey" => "" , 'trace' => true]);
        $resultClient = $client->AllCurrencies();

        return $resultClient;
    }


}