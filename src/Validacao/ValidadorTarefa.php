<?php
namespace Landim\Notas\Validacao;

use Landim\Notas\Validacao\IValidadorTarefa;

class ValidadorTarefa implements IValidadorTarefa
{
    public function validarFormulario($form): void
    {
        if (!array_key_exists('data', $form)) {
            throw new \Exception('A data é obrigatória');
        }

        if (!array_key_exists('inicio', $form)) {
            throw new \Exception('O horário de início é obrigatório');
        }

        if (!array_key_exists('fim', $form)) {
            throw new \Exception('O horário de fim é obrigatório');
        }

        if (!array_key_exists('titulo', $form)) {
            throw new \Exception('O título é obrigatório');
        }

        $horarioInicio = \DateTime::createFromFormat('H:i', $form['inicio']);
        $horarioFim = \DateTime::createFromFormat('H:i', $form['fim']);

        if ($horarioFim < $horarioInicio) {
            throw new \Exception('O horário de fim é inválido');
        }
    }
}