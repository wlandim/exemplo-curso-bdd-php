<?php
namespace Landim\Notas\Modelo;

class Tarefa
{
    private \DateTime $inicio;
    private \DateTime $fim;
    private string $titulo;
    private string $detalhes;
    private string $prioridade;

    public function __construct(\DateTime $inicio, \DateTime $fim, string $titulo)
    {
        $this->inicio = $inicio;
        $this->fim = $fim;
        $this->titulo = $titulo;
    }

    public function setDetalhes(string $detalhes): void
    {
        $this->detalhes = $detalhes;
    }

    public function setPrioridade(string $prioridade): void
    {
        $this->prioridade = $prioridade;
    }

    public function getPrioridade(): string
    {
        return $this->prioridade;
    }
}
