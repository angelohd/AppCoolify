<?php

use Illuminate\Database\Eloquent\Model;


if (!function_exists('logActivity')) {

    /**
     * Regista uma actividade no sistema
     *
     * @param string $descricao
     * @param Model|null $modelo
     * @param array $propriedades
     * @param \App\Models\User|null $usuario
     */


    function logActivity(
        string $descricao,
        Model $modelo = null,
        array $propriedades = [],
        $usuario = null
    ): void {
        $activity = activity();

        // Quem causou a ação
        if ($usuario) {
            $activity->causedBy($usuario);
        } elseif (auth()->check()) {
            $activity->causedBy(auth()->user());
        }

        // Sobre qual modelo
        if ($modelo) {
            $activity->performedOn($modelo);
        }

        $defaultProperties = [
            'ip' => request()->ip(),
            'rota' => url()->current(),
            'metodo' => request()->method(),
            'agente' => request()->userAgent(),
        ];
        $properties = array_merge($defaultProperties, $propriedades);
        $activity->withProperties($properties);
        $activity->log($descricao);
    }
}

