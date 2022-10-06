<?php
namespace Landim\Notas\Servico;

use Landim\Notas\Modelo\Tarefa;
use Landim\Notas\Servico\IServicoTarefa;
use Landim\Notas\Validacao\IValidadorTarefa;

class ServicoTarefa implements IServicoTarefa
{
    private IValidadorTarefa $validador;

    public function __construct(IValidadorTarefa $validador) {
        $this->validador = $validador;
    }

    public function criarTarefa(array $formulario): Tarefa {
        $this->validador->validarFormulario($formulario);

        $dataInicio = \DateTime::createFromFormat('Y-m-d H:i', "{$formulario['data']} {$formulario['inicio']}");
        $dataFim = \DateTime::createFromFormat('Y-m-d H:i', "{$formulario['data']} {$formulario['fim']}");
        $titulo = $formulario['titulo'];

        $tarefa = new Tarefa(
            $dataInicio,
            $dataFim,
            $titulo
        );

        $tarefa->setDetalhes($formulario['detalhes'] ?? '');
        $tarefa->setPrioridade($formulario['prioridade'] ?? 'media');

        return $tarefa;
    }
}