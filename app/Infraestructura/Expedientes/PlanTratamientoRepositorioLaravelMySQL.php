<?php
namespace Siacme\Infraestructura\Expedientes;
use Illuminate\Support\Collection;
use Siacme\Dominio\Consultas\DientePlan;
use Siacme\Dominio\Consultas\PlanTratamiento;
use Siacme\Dominio\Consultas\OtroTratamiento;
use DB;
use Siacme\Dominio\Pacientes\Diente;
use Siacme\Dominio\Pacientes\DientePadecimiento;
use Siacme\Dominio\Pacientes\DienteTratamiento;

/**
 * Class PlanTratamientoRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 */
class PlanTratamientoRepositorioLaravelMySQL implements PlanTratamientoRepositorioInterface
{
    /**
     * update a table plan
     * @param PlanTratamiento $plan
     * @return bool
     */
    public function actualizarAtencionTratamiento(PlanTratamiento $plan)
    {
        // TODO: Implement actualizarAtencionTratamiento() method.
        try {
            foreach ($plan->getListaDientes() as $diente) {
                if ($diente->tieneTratamientos()) {
                    foreach ($diente->getListaTratamientos() as $dientePlan) {
                        DB::table('diente_diente_tratamiento')
                            ->where('idPlanTratamiento', $plan->getId())
                            ->where('Numero', $diente->getNumero())
                            ->where('idDienteTratamiento', $dientePlan->getDienteTratamiento()->getId())
                            ->update([
                                'Atendido'          => 1,
                                'FechaModificacion' => date('Y-m-d H:m:i')
                            ]);
                    }
                }
            }

            if ($plan->atendido()) {
                $this->actualizarPlan($plan);
            }

            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * @param PlanTratamiento $plan
     * @return bool
     */
    public function actualizarPlan(PlanTratamiento $plan)
    {
        try {
            DB::table('plan_tratamiento')
                ->where('idPlanTratamiento', $plan->getId())
                ->update([
                    'Activo'            => 0,
                    'FechaModificacion' => date('Y-m-d H:m:i')
                ]);

            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * obtener un plan por su id
     * @param $id
     * @return PlanTratamiento
     */
    public function obtenerPorId($id)
    {
        // TODO: Implement obtenerPorId() method.
        try {
            $planes = DB::table('plan_tratamiento')
                ->where('idPlanTratamiento', $id)
                ->first();

            if (count($planes) > 0) {
                // buscar la lista de dientes
                $dientes = DB::table('diente')
                    ->orderBy('Numero')
                    ->get();

                $plan         = new PlanTratamiento(!$planes->Activo);
                $listaDientes = new Collection();
                $plan->setId($planes->idPlanTratamiento);

                foreach ( $dientes as $dientes ) {
                    $dienteActual = new Diente($dientes->Numero);

                    // padecimientos dentales
                    $dientesPadecimientos = DB::table('diente_diente_padecimiento')
                        ->join('diente_padecimiento', 'diente_padecimiento.idDientePadecimiento', '=', 'diente_diente_padecimiento.idDientePadecimiento')
                        ->where('diente_diente_padecimiento.idPlanTratamiento', $planes->idPlanTratamiento)
                        ->where('diente_diente_padecimiento.Numero', $dientes->Numero)
                        ->get();

                    foreach ( $dientesPadecimientos as $dientesPadecimientos ) {
                        $padecimiento = new DientePadecimiento($dientesPadecimientos->idDientePadecimiento, $dientesPadecimientos->DientePadecimiento, $dientesPadecimientos->RutaImagen);
                        $dienteActual->agregarPadecimiento($padecimiento);
                    }

                    //===============================================================================
                    // tratamientos dentales
                    $dientesTratamientos = DB::table('diente_diente_tratamiento')
                        ->leftJoin('diente_tratamiento', 'diente_tratamiento.idDienteTratamiento', '=', 'diente_diente_tratamiento.idDienteTratamiento')
                        ->where('diente_diente_tratamiento.idPlanTratamiento', $planes->idPlanTratamiento)
                        ->where('diente_diente_tratamiento.Numero', $dientes->Numero)
                        ->get();

                    if (count($dientesTratamientos) > 0) {
                        $index = 1;
                        foreach ( $dientesTratamientos as $dientesTratamientos ) {
                            $tratamiento = new DientePlan(new DienteTratamiento((int)$dientesTratamientos->idDienteTratamiento, $dientesTratamientos->DienteTratamiento, $dientesTratamientos->Costo), $dientesTratamientos->Atendido === 1 ? true : false);

                            $dienteActual->agregarTratamiento((string)$index, $tratamiento);
                            $index++;
                        }
                    } else {

                    }
                    //if($dientes->Numero === 18) { dd($dienteActual); }
                    $listaDientes->push($dienteActual);
                }

                // otros tratamientos
                $otrosTratamientos = DB::table('plan_tratamiento_otros')
                    ->join('plan_otro_tratamiento', 'plan_otro_tratamiento.idOtroTratamiento', '=', 'plan_tratamiento_otros.idOtroTratamiento')
                    ->where('plan_tratamiento_otros.idPlanTratamiento', $plan->getId())
                    ->get();

                if (count($otrosTratamientos) > 0) {
                    foreach ($otrosTratamientos as $otrosTratamientos) {
                        $otroTratamiento = new OtroTratamiento($otrosTratamientos->idOtroTratamiento, $otrosTratamientos->OtroTratamiento, $otrosTratamientos->Costo);

                        $plan->agregarOtroTratamiento($otroTratamiento->getId(), $otroTratamiento);
                    }
                }

                $plan->setCosto($planes->Costo);
                $plan->setListaDientes($listaDientes);

                return $plan;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}