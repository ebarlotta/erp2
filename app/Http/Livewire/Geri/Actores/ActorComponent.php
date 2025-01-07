<?php

namespace App\Http\Livewire\Geri\Actores;

use App\Models\Nacionalidad;
use App\Models\Localidades;
use App\Models\Area;
use App\Models\Condicioniva;
use App\Models\DiasDeLaSemana;
use App\Models\Elementos\Elemento;
use App\Models\Elementos\ElementoMedicamento;
use App\Models\EmpresaUsuario;
use App\Models\Iva;
use App\Models\TiposDocumentos;
use App\Models\EstadosCiviles;


use Illuminate\Support\Facades\DB;
use App\Models\Geri\Actor;
use App\Models\Geri\Actores\ActorAgente;
use App\Models\Geri\Actores\ActorCliente;
use App\Models\Geri\Actores\ActorEmpresa;
use App\Models\Geri\Actores\ActorPersonal;
use App\Models\Geri\Actores\ActorProveedor;
use App\Models\Geri\Actores\ActorReferente;
use App\Models\Geri\Actores\ActorVendedor;
// use App\Models\Geri\Agente;
use App\Models\Geri\Agenteinforme;

use App\Models\Geri\Beneficios;
use App\Models\Geri\Camas;
use App\Models\Geri\Cliente;
use App\Models\Geri\Empresa;
use App\Models\Geri\Escolaridades;
use App\Models\Geri\GradoDependencia;
use App\Models\Geri\Habitacion;
use App\Models\Geri\Informes\Informe;
use App\Models\Geri\Informes\InformeRespuestas;
use App\Models\Geri\Medicamento;
use App\Models\Geri\PersonActivo;
use App\Models\Geri\Personas;
use App\Models\Geri\PlanAlimentario;
use App\Models\Geri\PlanAlimentarioActor;
use App\Models\Geri\Pregunta;
use App\Models\Geri\Referente;
use App\Models\Geri\Sexo;
use App\Models\Geri\Sociales\DatosSocial;
use App\Models\Geri\TipoDePersona;
use App\Models\Indicaciones;
use App\Models\MomentosDelDia;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Livewire\Component;

class ActorComponent extends Component
{
    public $persona_descripcion, $actor_id, $iva_id, $fingreso, $fegreso, $peso, $telefono, $nombreempresa, $motivosegresos, $gradodependencia, $referente_id;
    public $actores, $ivas, $condicioniva_id, $referentes;
    
    public $tipos_documentos, $estados_civiles, $tipos_de_personas, $nacionalidades, $localidades, $beneficios, $grados_dependencias, $escolaridades, $camas, $person_activos, $sexos, $datossociales_id, $historiadevida;

    public $camas22;
    public $radios, $temporal, $searchActor;

    public $name, $alias, $documento, $nacimiento, $email, $domicilio, $tipodocumento_id, $estadocivil_id, $nacionalidad_id, $localidad_id, $beneficio_id, $gradodependencia_id, $cama_id, $escolaridad_id, $sexo_id, $tipopersona_id, $personactivo_id, $email_verified_at, $iminimo, $cbu, $nrotramite, $patente, $nrocta,
    $actor_referente, $actividad, $caracterdeltitular, $agente_informes_id;
    public $informe_id; // Es el id del area seleccionada que tiene ligados todos los informes del area

    public $listadoinformes,$listadoinformesGenerados,$respuestas,$nombredelinforme;
    public $bancorespuestas =array();
    public $bancopreguntas;

    public $isModalOpen = false;
    public $isModalOpenAdicionales=false;
    public $isModalOpenGestionar=false;

    //Variables de Nuevo informe
    public $ModalNuevoInforme=false;
    public $personalmedico;
    public $anioNuevo, $periodoNuevo, $profesional_id_Nuevo, $nuevo_informe_id;

    // public $mostrarInformesGenerados =false;
    public $mostrarinformeespecifico=false, $informeespecifico;
    public $modalpreguntas=false;

    public $vinculo, $modalidad,$ultimaocupacion,$viviendapropia,$canthijosvarones=0,$canthijasmujeres=0, $activo;

    public $dias, $momentos;
    public $visualizarMedicamentos, $listadomedicamentos, $listadoDescartables, $listadoMenues;
    public $CantidadAModificar, $mostrarModificarIndicacion, $mostrarNuevaIndicacion, $MomentoAModificar, $ElementoAModificar, $DiaAModificar, $NuevaIndicacion, $elementos;

    public $plan_alimentario_actor_id, $visualizarPlanAlimentario, $plan_alimentario_elegido;

    public function render()
    {
        //Busca el id de la empresa relacionada con el usuario que está logueado
        $usuario=EmpresaUsuario::where('user_id','=',Auth::id())->get();
        // session(['empresa_id' => $usuario[0]['empresa_id']]);
        
        $this->anioNuevo=date("Y");
        $this->tipos_documentos = TiposDocumentos::all();   //Carga todos los tipos de documentos
        $this->estados_civiles = EstadosCiviles::all(); // Carga todos los estados civiles
        $this->tipos_de_personas = TipoDePersona::all();    // Carga tipos de personas/agentes
        $this->nacionalidades = Nacionalidad::all();    //Carga nacionalidades
        $this->localidades = Localidades::all();    // Carga localidades
        $this->beneficios = Beneficios::all();  // Carga Obras Sociales
        $this->grados_dependencias = GradoDependencia::all();   // Carga Grados de dependencia
        $this->escolaridades = Escolaridades::all();    // Carga escolaridades
        $this->sexos = Sexo::all();     // Carga sexos 
        $this->person_activos = PersonActivo::all();    // Carga los distintos estados Alta/Baja/En proceso de baja
        $this->dias = DiasDeLaSemana::all();
        $this->momentos = MomentosDelDia::all();
        // $this->ivas = Iva::all();   // Carga las distintas ivas
        $this->ivas = Condicioniva::all();   // Carga las distintas ivas
        // Carga las distintas camas y sus habitaciones de cada empresa
        $this->camas = json_decode(DB::table('cama_habitacions')
            ->join('habitacions', 'habitacions.id', '=', 'cama_habitacions.habitacion_id')
            ->where('habitacions.empresa_id',session('empresa_id'))
            ->orderBy('cama_id')
            ->get(),true);
        if(is_null($this->radios)) { $this->radios='Todos'; $this->actores = Actor::orderby('nombre')->get(); } // Carga inicial de los actores y categoria Todos en la variable radios
        else {
            $this->Filtrar();
        }
    
        return view('livewire.geri.actores.actor-component',['radios'=>$this->radios])->extends('layouts.adminlte');
    }
    
    protected $rules = [
        'agente_id' => ['required', 'email'],
        'informe_id' => ['required'],
    ];

    public function nuevoInforme() {
        $this->validate([
            'anioNuevo' => 'required|integer',
            'periodoNuevo' => 'required',
            'profesional_id_Nuevo' => 'required',
        ]);
        $a= new Agenteinforme;
        $a->agente_id = $this->actor_id;
        $a->informe_id=$this->nuevo_informe_id;
        $a->nroperiodo=$this->periodoNuevo;
        $a->anio=$this->anioNuevo;
        $a->profesional_id=$this->profesional_id_Nuevo;
        $a->empresa_id=session('empresa_id');
        $a->save(); 
        //Falta validar antes de guardar
        $preguntas = Pregunta::where('informe_id','=',$this->informe_id)->get();
        foreach($preguntas as $pregunta) {
            $b = new InformeRespuestas;
            $b->agente_informes_id = $a->id;
            $b->preguntas_id = $pregunta->id;
            $b->cantidad = -1;      // Carga -1 si la respuesta está sin contestr aún
            $b->descripcion = '';
            $b->fotourl = null;
            $b->save();
        }
        $this->cerrarModalNuevoInforme();
        $this->MostrarInformes($this->nuevo_informe_id);
    }

    public function show($id) {
        $this->cama_id = '';
        $actor = Actor::find($id);
        $this->plan_alimentario_actor_id=null;
        $this->plan_alimentario_elegido=null;

        if($actor->tipopersona_id==1) {     // Si es un agente, entonces...
            $this->CargaDatosdelActor($actor);
            // $agente = ActorAgente::where('id','=',$this->actor_id)->get(); 
            
            $this->CargarInforme('PlanAlimentario');    // Carga el plan Alimentario, si es que lo hay
            $a = PlanAlimentarioActor::where('actor_id','=',$this->actor_id)->get();
            if(count($a)) { 
                $this->plan_alimentario_actor_id = $a[0]->plan_id; 
                $this->plan_alimentario_elegido=$a[0]->plan_id;
            } else { $this->plan_alimentario_elegido = NULL; }
            $this->isModalOpenGestionar=!$this->isModalOpenGestionar;
        }
    }

    public function CargarInforme($informe) {
        $this->listadoinformes = null;
        switch ($informe) {
            case 'Sociales':{ 
                $this->listadoinformes = Area::join('informes','areas.id','informes.area_id')
                ->where('name','=','Social')
                ->get();
                if(count($this->listadoinformes)) {
                    if($this->listadoinformes) {
                        $this->informe_id=$this->listadoinformes[0]->id;
                    }
                }
                break;
            }
            case 'Medicos':{ 
                $this->listadoinformes = Area::join('informes','areas.id','informes.area_id')
                ->where('name','=','Médica')
                ->get();
                if(count($this->listadoinformes)) {
                    if($this->listadoinformes) {
                        $this->informe_id=$this->listadoinformes[0]->id;
                    }
                }
                break;
            }
            case 'Nutricional':{ 
                $this->listadoinformes = Area::join('informes','areas.id','informes.area_id')
                ->where('name','=','Nutricional')
                ->get();
                break;
            }
            case 'HistoriaDeVida':{ 
                $this->listadoinformes = Area::join('informes','areas.id','informes.area_id')
                ->where('name','=','Historia De Vida')
                ->get();
                break;
            }
            case 'Pagos':{ 
                $this->listadoinformes = Area::join('informes','areas.id','informes.area_id')
                ->where('name','=','Administración')
                ->get();
                break;
            }
            // Busca los datos necesarios para llenar el front
            if(count($this->listadoinformes)) {
                if($this->listadoinformes) {
                    $this->informe_id=$this->listadoinformes[0]->id;
                }
            }

            case 'Medicamentos':{                
                //Busca todos los medicamentos que tiene el actor
                
                $this->listadomedicamentos = Indicaciones::join('elementos','indicaciones.elemento_id','elementos.id')
                ->join('momentos_del_dias','momentos_del_dias.id','indicaciones.momento_del_dia_id')
                ->join('dias_de_la_semanas','dias_de_la_semanas.id','indicaciones.dia_de_la_semana_id')
                ->where('elementos.empresa_id','=',session('empresa_id'))
                ->where('actor_id','=',$this->actor_id)
                ->orderby('dia_de_la_semana_id','asc')
                ->orderby('momento_del_dia_id','asc')
                ->orderby('elemento_id','asc')
                ->get();
                $cant=$this->listadomedicamentos->groupBy('elemento_id')->toArray();

                $matriz = '';
                $i=0;
                foreach ($cant as $clave => $subArray) { 
                    //Genera el primer encabezado
                    $NombreMedicamento = $subArray[0]['name'];
                    // $NombreMedicamento = $this->listadomedicamentos[$i]->name;
                    $matriz = $matriz . '
                    <div class="card sm:col-11 shadow-md rounded-l-md transform transition duration-500 hover:scale-105" style="margin: 1%;box-shadow: 10px 5px 5px gray; height: max-content; border: lightgray; border-style: ridge; border-width: thin;">
                        <div class="card-body" style="height: 100%; padding: 0.25rem;">
                            <p>
                                <table class="w-full">
                                    <tr>
                                        <td rowspan=5><b class="ml-2">'.$NombreMedicamento.'</b></td>
                                        <td><b class="ml-2">Momento</b></td>
                                        <td><b class="ml-2">Lunes</b></td>
                                        <td><b class="ml-2">Martes</b></td>
                                        <td><b class="ml-2">Miércoles</b></td>
                                        <td><b class="ml-2">Jueves</b></td>
                                        <td><b class="ml-2">Viernes</b></td>
                                        <td><b class="ml-2">Sábado</b></td>
                                        <td><b class="ml-2">Domingo</b></td>
                                    </tr>';

                    $registro = Indicaciones::join('elementos','indicaciones.elemento_id','elementos.id')
                    ->join('momentos_del_dias','momentos_del_dias.id','indicaciones.momento_del_dia_id')
                    ->join('dias_de_la_semanas','dias_de_la_semanas.id','indicaciones.dia_de_la_semana_id')
                    ->where('elementos.empresa_id','=',session('empresa_id'))
                    ->where('elemento_id','=',$subArray[0]['elemento_id'])
                    ->orderby('dia_de_la_semana_id','asc')
                    ->orderby('momento_del_dia_id','asc')
                    ->orderby('elemento_id','asc')
                    ->get();

                    $indice=0; $registros = '';

                    for($momentos=1;$momentos<=count($this->momentos);$momentos++) {
                        $registros = $registros . '<tr>';
                        switch ($momentos) { 
                            case(1) : $registros = $registros . '<td><b class="ml-2">Mañana</b></td>';break;
                            case(2) : $registros = $registros . '<td><b class="ml-2">Almuerzo</b></td>';break;
                            case(3) : $registros = $registros . '<td><b class="ml-2">Mediatarde</b></td>';break;
                            case(4) : $registros = $registros . '<td><b class="ml-2">Cena</b></td>';break;                                                        
                        }
                        for($dias=1;$dias<=count($this->dias);$dias++) {                            
                            if($momentos==$registro[$indice]->momento_del_dia_id && $dias==$registro[$indice]->dia_de_la_semana_id) {
                                $registros = $registros . '<td class="text-center" wire:click="ModificarIndicacion('.$momentos.','.$dias.','.$subArray[0]['elemento_id'].')">'. $registro[$indice]->cantidad.'</td>'; 
                                if($indice<count($registro)-1) { $indice++; } 
                            }
                            else {
                                $registros = $registros . '<td class="text-center" wire:click="ModificarIndicacion('.$momentos.','.$dias.','.$subArray[0]['elemento_id'].')">0</td>';
                            }
                        }
                        $registros = $registros . '</tr>';
                    }
                    $matriz = $matriz . $registros;
                    $matriz = $matriz . '</table></p></div></div>';
                    $i++;
                }
                $this->visualizarMedicamentos = $matriz;
                break;
            }

            case 'PlanAlimentario':{
                $a = PlanAlimentarioActor::where('actor_id','=',$this->actor_id)->get();
                $listado_planes_alimentarios = PlanAlimentario::where('empresa_id','=',session('empresa_id'))->get();
                $matriz = '
                <div class="card w-full shadow-md rounded-l-md transform transition duration-500 hover:scale-105" style="margin: 1%;box-shadow: 10px 5px 5px gray; height: max-content; border: lightgray; border-style: ridge; border-width: thin;">
                    <div class="card-body" style="height: 100%; padding: 0.25rem;">
                        <p>
                            <table class="w-full">
                                <tr>
                                    <td><b class="ml-2">Plan Alimentario Utilizado</b></td>
                                    <td>';
                                    if(count($a)) { $this->plan_alimentario_actor_id = $a[0]->plan_id; }
                                    $matriz = $matriz . '<select wire:model="plan_alimentario_elegido" wire:change="ActualizarPlanAlimentarioActor()">
                                                        <option value="">-- Seleccione un Plan Alimentario-- </option>';
                                    foreach($listado_planes_alimentarios as $plan) {
                                        if($plan->id == $this->plan_alimentario_actor_id) { $matriz = $matriz . '<option value="'.$plan->id.'" selected>'.$plan->nombre.'</option>'; }
                                        else { $matriz = $matriz . '<option value="'.$plan->id.'">'.$plan->nombre.'</option>'; }
                                    }
                                    $matriz = $matriz . '</select></td>
                                    </tr>
                                </table>
                            <p>
                        </div>
                    </div>';
    
                $this->visualizarPlanAlimentario = $matriz;

            }
            
            case 'Descartables':{
                // dd('encontrado');
                $this->listadoDescartables = Medicamento::all();
                break;
            }
            case 'Menúes':{
                // dd('encontrado');
                $this->listadoMenues = Medicamento::all();
                break;
            }
        }
        $this->listadoinformesGenerados=null;
    }

    public function ActualizarPlanAlimentarioActor() {
        // $a = PlanAlimentarioActor::where('actor_id','=',$this->actor_id)->where('plan_id','=',$this->plan_alimentario_actor_id)->get();
        // if(count($a)) {
            PlanAlimentarioActor::updateOrCreate([
                'actor_id' => $this->actor_id,
                'plan_id' => $this->plan_alimentario_actor_id
            ],
            [
                'actor_id' => $this->actor_id,
                'plan_id' => $this->plan_alimentario_elegido
            ]);

            $this->plan_alimentario_actor_id = $this->plan_alimentario_elegido;
        // } else {

        session()->flash('message', 'Plan Actualizado');
        
    }

    public function ModificarIndicacion($momento, $dia, $elemento_id) {
        $a = Indicaciones::where('dia_de_la_semana_id','=',$dia)
        ->where('momento_del_dia_id','=',$momento)
        ->where('elemento_id','=',$elemento_id)
        ->where('actor_id','=',$this->actor_id)
        ->get();
        if(count($a)) { 
            $this->CantidadAModificar = $a[0]->cantidad; 
        } else { $this->CantidadAModificar=0; }

        $this->MomentoAModificar = $momento; 
        $this->ElementoAModificar = $elemento_id; 
        $this->DiaAModificar = $dia; 

        $this->mostrarModificarIndicacion = true;
    }

    public function storeModificarIndicacion() {
        Indicaciones::updateOrCreate(
            [
                'dia_de_la_semana_id' => $this->DiaAModificar,
                'momento_del_dia_id' => $this->MomentoAModificar,
                'elemento_id' => $this->ElementoAModificar,
                'actor_id' => $this->actor_id,
            ],
            [
                'cantidad' => $this->CantidadAModificar,
            ]
        );
        // Indicaciones::updateOrCreate(['dia_de_la_semana_id' => $this->MomentoAModificar,'momento_del_dia_id','=',$this->DiaAModificar,'elemento_id','=',$this->ElementoAModificar,'actor_id','=',$this->actor_id], ['cantidad' => $this->CantidadAModificar,]); 
        $this->mostrarModificarIndicacion = false;
        $this->CargarInforme('Medicamentos');
    }

    public function storeNuevaIndicacion() {
        Indicaciones::updateOrCreate(
            [
                'dia_de_la_semana_id' => 1,
                'momento_del_dia_id' => 1,
                'elemento_id' => $this->NuevaIndicacion,
                'actor_id' => $this->actor_id,
            ],
            [
                'cantidad' => 0,
            ]
        );
        $this->mostrarNuevaIndicacion = false;
        $this->CargarInforme('Medicamentos');
    }

    public function MostrarInformes($informe_id) {
        //select * from `agenteinformes` where `informe_ida` = 1 and `agente_id` = 1 order by `anio` asc, `nroperiodo` asc
        $this->listadoinformesGenerados = Agenteinforme::where('informe_id','=',$informe_id)
        ->where('agente_id','=',$this->actor_id)
        ->join('informes','agenteinformes.informe_id','informes.id')
        ->select('agenteinformes.id','agente_id','informe_id','nroperiodo','anio','profesional_id','agenteinformes.empresa_id')
        ->orderby('anio')->orderby('nroperiodo')->get();
        // dd($this->listadoinformesGenerados);
    }

    public function BuscarDatosDelInforme($informe_id) {
        dd($informe_id);

        $this->informeespecifico = InformeRespuestas::where('agente_informes_sid','=',$informe_id)
        ->join('preguntas','preguntas.id','preguntas_id')
        ->get(['preguntas_id','cantidad','descripcion','agente_informes_id','fotourl','informe_respuestas.id','textopregunta','escala_id']);
        
        $this->agente_informes_id=$informe_id;
        $this->mostrarinformeespecifico = true;
    }

    public function ResponderInforme($informe_id) {
        // Buscar las preguntas que tendrá el informe
        $informe = Informe::find($this->informe_id);
        $this->bancopreguntas = Pregunta::select('preguntas.id','textopregunta','area_id','escala_id','informe_id','nombreescala','tipodatos','minimo','maximo', 'empresa_id')
        ->where('informe_id','=',$this->informe_id)
        ->join('escalas','escala_id','escalas.id')
        ->get();
        $this->modalpreguntas = true;
    }

    // public function ResponderInforme1() {
    //     // Buscar las preguntas que tendrá el informe
    //     $this->bancopreguntas = Pregunta::where('informe_id','=',2)
    //     ->join('escalas','escala_id','escalas.id')
    //     ->get();
    //     $this->modalpreguntas = true;
    //     return view('livewire.actores.modalpreguntas')->with(['nombredelinforme'=>'INFORME','bancopreguntas'=>$this->bancopreguntas,'temporal'=>1]);
    // }

    public function TomarRespuesta($id, $pregunta_id, $respuesta, $descripcion){
        $a = InformeRespuestas::find($id);
        if(!is_null($a)) {
            $a->cantidad = $respuesta;
            $a->save();
        } else
        {   $a = new InformeRespuestas();
            $a->agente_informes_id = $this->agente_informes_id;
            $a->preguntas_id = $pregunta_id;
            if($respuesta==1) { $a->cantidad = $respuesta; } else { $a->cantidad = 0;}
            $a->descripcion = $descripcion;
            $a->save();
        }
        $this->BuscarDatosDelInforme($this->agente_informes_id);
    }

    public function Filtrar() {
        switch ($this->radios) {
        // switch ($a) {
            case 'Todos': $this->actores = Actor::orderby('nombre')->where('nombre','like','%'.$this->searchActor.'%')->get(); break;
            case 'Agentes': 
                $this->actores = Actor::where('tipopersona_id','=',1)->get();
                // $this->actores = Actor::where('tipopersona_id','=',1)->where('nombre','like','%'.$this->searchActor.'%')->orderby('nombre')->get();
                // dd($this->actores );
                break;
            case 'Referentes': $this->actores = Actor::where('tipopersona_id','=',2)->where('nombre','like','%'.$this->searchActor.'%')->orderby('nombre')->get(); break;
            case 'Personal': $this->actores = Actor::where('tipopersona_id','=',3)->where('nombre','like','%'.$this->searchActor.'%')->orderby('nombre')->get(); break;
            case 'Proveedores': $this->actores = Actor::where('tipopersona_id','=',4)->where('nombre','like','%'.$this->searchActor.'%')->orderby('nombre')->get(); break;
            case 'Clientes': $this->actores = Actor::where('tipopersona_id','=',5)->where('nombre','like','%'.$this->searchActor.'%')->orderby('nombre')->get(); break;
            case 'Vendedores': $this->actores = Actor::where('tipopersona_id','=',6)->where('nombre','like','%'.$this->searchActor.'%')->orderby('nombre')->get(); break;
            case 'Empresas': $this->actores = Actor::where('tipopersona_id','=',7)->where('nombre','like','%'.$this->searchActor.'%')->orderby('nombre')->get(); break;
        }
    }

    public function create()
    {
        $this->resetCreateForm();   
        $this->openModalPopover();
        $this->isModalOpen=true;
        $this->tipos_documentos = TiposDocumentos::all();
        $this->estados_civiles = EstadosCiviles::all();
        $this->tipos_de_personas = TipoDePersona::all();
        $this->nacionalidades = Nacionalidad::all();
        $this->localidades = Localidades::all();
        $this->beneficios = Beneficios::all();
        $this->grados_dependencias = GradoDependencia::all();
        $this->escolaridades = Escolaridades::all();
        $this->person_activos = PersonActivo::all();
        $this->camas = json_decode(DB::table('cama_habitacions')
            ->join('habitacions', 'habitacions.id', '=', 'cama_habitacions.habitacion_id')
            ->where('habitacions.empresa_id',session('empresa_id'))
            ->orderBy('cama_id')
            ->get(),true);
        return view('livewire.geri.actores.actor-component')->with('isModalOpen', $this->isModalOpen);
    }

    // Se encarga de los modales 
    //==========================
    public function openModalPopover() { $this->isModalOpen = true; }
    public function closeModalPopover() { $this->isModalOpen = false; }
    public function closeModalInformeEspecifico() { $this->mostrarinformeespecifico = false; }
    public function openModalPopoverAdicionales() { $this->isModalOpenAdicionales = true; }
    public function closeModalPreguntas() { $this->modalpreguntas = false; }
    public function closeModalPopoverAdicionales() { 
        $this->isModalOpenAdicionales = false; 
        $this->reset('vinculo','ultimaocupacion','viviendapropia','canthijosvarones','canthijasmujeres','activo'); }

    public function abrirModalNuevoInforme($id) { 
        $this->ModalNuevoInforme=true; 
        $this->personalmedico = Actor::where('tipopersona_id','=',3)->get(); 
        $this->nuevo_informe_id = $id; }
    public function cerrarModalNuevoInforme() { $this->ModalNuevoInforme=false; }
    public function cerrarModalModificarIndicacion() { $this->mostrarModificarIndicacion = false; }
    public function cerrarModalNuevaIndicacion() { $this->mostrarNuevaIndicacion = false; }
    public function openModalNuevaIndicacion($caso) { 
        switch ($caso) {
            case 'Medicamentos': 
                $this->elementos = Elemento::join('elemento_medicamentos','elemento_medicamentos.elemento_id','elementos.id')
                ->where('empresa_id','=',session('empresa_id'))->orderby('name')->get();
                break;
        }
    $this->mostrarNuevaIndicacion = true; }

    private function resetCreateForm(){
        $this->name = '';
        $this->actor_id = '';
        $this->email = '';
        $this->domicilio = '';
        $this->documento = '';
        $this->tipopersona_id = null ;
        $this->nacionalidad_id = null;
        $this->localidad_id = null ;
        $this->beneficio_id = null ;
        $this->personactivo_id = null ;
        $this->condicioniva_id =null;
    }
    
    public function store() {
        if(is_null(session('empresa_id'))) return redirect()->route('login');
        $this->validate([
            'name' => 'required', 
            'documento' => 'required|integer',
            'tipodocumento_id' => 'required|integer', 
            'tipopersona_id' => 'required|integer', 
            'nacionalidad_id' => 'required|integer',
            'localidad_id' => 'required|integer',
            'beneficio_id' => 'required|integer',
            'personactivo_id' => 'required|integer',
            'condicioniva_id' => 'required',
        ]);
        
        $a = actor::updateOrCreate(['id' => $this->actor_id], [
            'nombre' => $this->name, 
            'domicilio' => $this->domicilio, 
            'documento' =>  $this->documento,
            'tipos_documento' =>  1, //$this->tipodocumento_id, 
            'nacimiento' =>  date(now()), //$this->nacimiento,
            'sexo_id' =>  1, //$this->sexo_id, 
            'email' =>  $this->email, 
            'telefono' => 1111, // $this->telefono, 
            'nacionalidad_id' =>  $this->nacionalidad_id,
            'localidad_id' =>  $this->localidad_id,
            'obrasocial_id' =>  $this->beneficio_id,
            'escolaridad_id' =>  1, //$this->escolaridad_id, 
            'personactivo_id' =>  $this->personactivo_id,
            'tipopersona_id' => $this->tipopersona_id,
            'condicioniva_id' => $this->condicioniva_id,
            'empresa_id' => session('empresa_id'),
            'urlfoto' => asset('images/sin_imagen.jpg'),
            'activo' => 1,
        ]);

        // dd($a->id);
        switch($this->tipopersona_id) {
            case 1:
                $agente = new ActorAgente;
                $agente->actor_id = $a->id;
                $agente->save();
                break;
            case 4:
                $agente = new ActorProveedor();
                $agente->actor_id = $a->id;
                $agente->iva_id = 1;
                $agente->save();
                break;
    
        }

        // if($this->tipopersona_id==2) {
        //     $b = new ActorReferente;
        //     $b->actor_id = 1; //$a->id;
        //     $b->vinculo = '';
        //     $b->modalidad = '';
        //     $b->save();
        //     $this->actor_id = $b->id;
        // }

        if(is_null($this->radios)) { $this->radios='Todos'; $this->actores = Actor::orderby('nombre')->get(); }
        session()->flash('message', $this->actor_id ? 'Actor Actualizado/a.' : 'Actor Creado.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $actor = Actor::findOrFail($id);
        // $this->id = $id;
        $this->actor_id=$id;
        $this->name = $actor->nombre;
        $this->domicilio = $actor->domicilio;
        $this->documento = $actor->documento;
        $this->tipodocumento_id = $actor->tipos_documento;
        $this->nacimiento = $actor->nacimiento;
        $this->estadocivil_id = $actor->estadocivil_id;
        $this->email = $actor->email;
        $this->tipopersona_id = $actor->tipopersona_id;
        $this->nacionalidad_id = $actor->nacionalidad_id;
        $this->localidad_id = $actor->localidad_id;
        $this->beneficio_id = $actor->obrasocial_id;
        $this->escolaridad_id = $actor->escolaridad_id ;
        $this->condicioniva_id = $actor->condicioniva_id;

        if(is_null($this->radios)) { $this->radios='Todos'; $this->actores = Actor::orderby('nombre')->get(); } // Carga inicial de los actores y categoria Todos en la variable radios

        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        // fALTA MENSAJE DE CONFIRMACIÓN DE ELIMINACIÓN
        Actor::find($id)->delete();
        session()->flash('message', 'Actor Eliminado.');
        $this->Filtrar();
    }

    public function agregar($id)
    {
        $actor = Actor::findOrFail($id);
        // $this->id = $id; 
        switch ($actor->tipopersona_id) {
            case 1: { // Agente
                $this->referentes = Actor::where('tipopersona_id','=',2)->get(); 
                $this->camas22 = Camas::where('EstadoCama','=',1)->orderby('NroHabitacion')->get();
                $agente = ActorAgente::where('actor_id','=',$actor->id)->get(); 
                $this->CargaDatosdelAgente($agente[0]->id);  
                break; 
            }
            case 2: {
                // Referentes
                    $referente = ActorReferente::where('actor_id','=',$id)->get();
                    if($referente->isNotEmpty()) {
                        $this->vinculo = $referente[0]->vinculo;
                        $this->ultimaocupacion = $referente[0]->ultimaocupacion;
                        $this->viviendapropia = $referente[0]->viviendapropia;
                        $this->canthijosvarones = $referente[0]->canthijosvarones;
                        $this->canthijasmujeres = $referente[0]->canthijasmujeres;
                        $this->actor_id = $referente[0]->actor_id;
                        $this->condicioniva_id = $actor->condicioniva_id;
                        $this->activo = $referente[0]->activo;
                    }
                    break;
                }
            case 3: // Personal
                $personal = ActorPersonal::where('actor_id','=',$this->actor_id)->get();
                if($personal->isNotEmpty()) {
                    $this->modalidad = $personal[0]->modalidad;
                    $this->fingreso = $personal[0]->fingreso;
                    $this->iminimo = $personal[0]->iminimo;
                    $this->cbu = $personal[0]->cbu;
                    $this->nrotramite = $personal[0]->nrotramite;
                    $this->patente = $personal[0]->patente;
                    $this->nrocta = $personal[0]->nrocta;
                    $this->condicioniva_id = $actor->condicioniva_id;
                    $this->activo = $personal[0]->activo;
                }
                break;
            case 4: //Proveedor
                $proveedor = ActorProveedor::where('actor_id','=',$this->actor_id)->get();
                if($proveedor->isNotEmpty()) {
                    $this->condicioniva_id = $actor->condicioniva_id;
                    $this->iva_id = $proveedor[0]->iva_id;
                }
                break;
            case 5: //Cliente
                $cliente = ActorCliente::where('actor_id','=',$this->actor_id)->get();
                if($cliente->isNotEmpty()) {
                    $this->condicioniva_id = $actor->condicioniva_id;
                    $this->iva_id = $cliente[0]->iva_id;
                }
                break;
            case 6: // Vendedor
                    $vendedor = ActorVendedor::where('actor_id','=',$this->actor_id)->get();
                if($vendedor->isNotEmpty()) {
                    $this->condicioniva_id = $actor->condicioniva_id;
                    $this->iva_id = $vendedor[0]->iva_id;
                }
                    break;
            case 7: // Empresa
                    $empresa = ActorEmpresa::where('actor_id','=',$this->actor_id)->get();
                if($empresa->isNotEmpty()) {
                    $this->iva_id = $empresa[0]->iva_id;
                    $this->caracterdeltitular = $empresa[0]->caracterdeltitular;
                    $this->condicioniva_id = $actor->condicioniva_id;
                    $this->actividad = $empresa[0]->actividad;
                }
                    break;
            }

        // Carga Datos del Actor
        $this->CargaDatosdelActor($actor);
        $this->openModalPopoverAdicionales();
        if(is_null($this->radios)) { $this->radios='Todos'; $this->actores = Actor::orderby('nombre')->get(); } // Carga inicial de los actores y categoria Todos en la variable radios
    }

    public function CargaDatosdelActor($actor) {
        $this->actor_id = $actor->id;
        $this->name = $actor->nombre;
        $this->domicilio = $actor->domicilio;
        $this->documento = $actor->documento;
        $this->tipodocumento_id = $actor->TipoDocumento($actor->id)[0]['tipodocumento'];
        $this->sexo_id = $actor->Sexo()[0]['nombresexo'];
        $this->nacionalidad_id = $actor->Nacionalidad()[0]['nacionalidad_descripcion'];
        $this->localidad_id = $actor->Localidad()[0]['localidad_descripcion'];
        $this->beneficio_id = $actor->Beneficio()[0]['descripcionbeneficio'];
        $this->escolaridad_id = $actor->Escolaridad()[0]['escolaridadDescripcion'];
        $this->telefono = $actor->telefono;
        $this->nombreempresa = $actor->Empresa()[0]['name'];
        $this->activo = $actor->activo;
        $this->nacimiento = $actor->nacimiento;
        $this->estadocivil_id = $actor->estadocivil_id;
        $this->email = $actor->email;
        $this->tipopersona_id = $actor->tipopersona_id;
        $this->personactivo_id = $actor->personactivo_id;
        $this->email_verified_at = $actor->email_verified_at;
        $this->condicioniva_id = $actor->condicioniva_id;
        // dd($actor->actor_referente()[0]->nombre);
        if(!is_null($actor->actor_referente())) {
            $this->actor_referente = $actor->actor_referente()[0]->nombre;
            $this->referente_id = $actor->actor_referente()[0]->id;
        }
    }

    public function CargaDatosdelAgente($agente_id) {
        // Datos del Agente
        $agente = ActorAgente::where('id','=',$agente_id)->get();
        if($agente) {
            // if($agente->isNotEmpty()) {
            $this->fingreso = $agente[0]->fingreso;
            $this->fegreso = $agente[0]->fegreso;
            $this->peso = $agente[0]->peso_id;
            $this->cama_id = $agente[0]->cama_id;
            $this->alias = $agente[0]->alias;
            $this->referente_id = $agente[0]->actor_referente;
        }
    }

    public function storeAdicionalActor() {
        switch ($this->tipopersona_id) {
            case 1: // Agente
                $this->validate([
                    'fingreso' => 'required',
                    'peso' => 'integer',
                    'referente_id' => 'integer',
                    'cama_id' => 'integer',
                ]);
                $a = ActorAgente::updateOrCreate(['actor_id' => $this->actor_id], [
                'fingreso' => $this->fingreso,
                'fegreso' => $this->fegreso,
                'alias' => $this->alias,
                'peso_id' => $this->peso,
                'actor_id' => $this->actor_id,
                'actor_referente' => $this->referente_id,
                'cama_id' => $this->cama_id,
                'datossociales_id' => null,
                'datosmedicos_id' => null,
                'motivos_egreso_id' => null,
                'grado_dependencia_id' => null,
                'historiadevida_id' => null,
                ]);
                session()->flash('message', 'Se guardaron los datos');
                break;
            case 2: // Referente
                
            $this->validate([
                'vinculo' => 'required',
                // 'modalidad' => 'required', 
                'ultimaocupacion' => 'required', 
                'viviendapropia' => 'required', 
                'canthijosvarones' => 'required', 
                'canthijasmujeres' => 'required', 
                'activo' => 'required', 
            ]);
            // dd($this->actor_id);
            $a = ActorReferente::updateOrCreate(['actor_id' => $this->actor_id], [ //Tener en cuenta que está grabando en la tabla de personas, no de agentes
                'vinculo' => $this->vinculo, 
                'modalidad' => 1, 
                'ultimaocupacion' => $this->ultimaocupacion, 
                'viviendapropia' => $this->viviendapropia, 
                'canthijosvarones' => $this->canthijosvarones, 
                'canthijasmujeres' => $this->canthijasmujeres, 
                'actor_id' => $this->actor_id, 
                'activo' => $this->activo, 
            ]);
            session()->flash('message', 'Se guardaron los datos');
            break;
            case 3: // Personal
                $this->validate([
                    'modalidad' => 'required',
                    'fingreso' => 'required|date', 
                    'iminimo' => 'integer', 
                    'activo' => 'required', 
                ]);
                // DD($this->actor_id);
                $a = ActorPersonal::updateOrCreate(['actor_id' => $this->actor_id], [
                    'modalidad' => $this->modalidad,  
                    'fingreso' => $this->fingreso, 
                    'iminimo' => $this->iminimo, 
                    'cbu' => $this->cbu, 
                    'nrotramite' => $this->nrotramite, 
                    'patente' => $this->patente, 
                    'nrocta' => $this->nrocta,
                    'actor_id' => $this->actor_id, 
                    'activo' => $this->activo, 
                ]);
                session()->flash('message', 'Se guardaron los datos');
                break; 
            case 4:  // Proveedor
                $this->validate([
                    'iva_id' => 'integer',
                ]);
                $a = ActorProveedor::updateOrCreate(['actor_id' => $this->actor_id], [
                    'iva_id' => $this->iva_id,
                    'condicion_id' => $this->condicioniva_id,
                ]);
                session()->flash('message', 'Se guardaron los datos');
                break;
            case 5: // Cliente
                $this->validate([
                    'iva_id' => 'integer',
                ]);
                $a = ActorCliente::updateOrCreate(['actor_id' => $this->actor_id], [
                    'iva_id' => $this->iva_id,
                    'condicion_id' => $this->condicioniva_id,
                ]);
                session()->flash('message', 'Se guardaron los datos');
                break;
            case 6: // Vendedor
                $this->validate([
                    'iva_id' => 'integer',
                ]);
                $a = ActorVendedor::updateOrCreate(['actor_id' => $this->actor_id], [
                    'iva_id' => $this->iva_id,
                ]);
                session()->flash('message', 'Se guardaron los datos');
                break;
            case 7: // Empresa
                $this->validate([
                    'iva_id' => 'integer',
                ]);
                $a = ActorEmpresa::updateOrCreate(['actor_id' => $this->actor_id], [
                    'iva_id' => $this->iva_id,
                    'actividad' => $this->actividad,
                    'caracterdeltitular' => $this->caracterdeltitular,
                ]);
                session()->flash('message', 'Se guardaron los datos');
                break;
        }

    }

    public function showPDF() {
// dd('entro');
        // $this->agente_informes_id = 6;
        // $a = AgenteInforme::find($this->agente_informes_id);
        // $agente = Actor::find($a->agente_id);
        // $tituloInforme = Informe::find($a->informe_id);
        // $periodo = $a->nroperiodo;
        // $anio = $a->anio;
        // $profesional = Actor::find($a->profesional_id);
        // $informeespecifico = $this->informeespecifico;
        // dd($a);
        $pdf = PDF::loadView('livewire.actores.showPDF');
        // $pdf = PDF::loadView('livewire.actores.showPDF',compact('agente','tituloInforme','periodo','anio','profesional','informeespecifico'));
        return $pdf->stream('archivo.pdf');
        dd($pdf->stream('archivo.pdf'));
        return $pdf->download('pruebapdf.pdf');
    }
}
