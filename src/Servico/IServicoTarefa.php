<?php
namespace Landim\Notas\Servico;

use Landim\Notas\Modelo\Tarefa;

interface IServicoTarefa
{
    public function criarTarefa(array $formulario): Tarefa;
}