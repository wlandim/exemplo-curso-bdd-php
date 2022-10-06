<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Landim\Notas\Modelo\Tarefa;
use Landim\Notas\Validacao\ValidadorTarefa;
use Landim\Notas\Servico\ServicoTarefa;
use PHPUnit\Framework\TestCase;

/**
 * Defines application features from the specific context.
 */
class TarefaContext extends TestCase implements Context
{
    private bool $erro;
    private array $form;
    private string $msgErro;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given que está na tela de criar uma nova tarefa
     */
    public function queEstaNaTelaDeCriarUmaNovaTarefa()
    {
        $this->erro = false;
        $this->form = [];
    }

    /**
     * @When são preenchidos dados válidos no formulário
     */
    public function saoPreenchidosDadosValidosNoFormulario()
    {
        $dataInicioValida = '2022-20-05';
        $horarioInicioValido = '22:00';
        $horarioFimValido = '23:00';
        
        $this->form['data'] = $dataInicioValida;
        $this->form['inicio'] = $horarioInicioValido;
        $this->form['fim'] = $horarioFimValido;
        $this->form['titulo'] = 'Assistir nova episódio da série';
    }

    /**
     * @When tenta salvar a tarefa
     */
    public function tentaSalvarATarefa()
    {
        try {
            $validadorTarefa = new ValidadorTarefa();
            $servico = new ServicoTarefa($validadorTarefa);
            $this->tarefa = $servico->criarTarefa($this->form);
        } catch (Exception $e) {
            $this->erro = true;
            $this->msgErro = $e->getMessage();
        }
    }

    /**
     * @Then uma mensagem de sucesso é exibida
     */
    public function umaMensagemDeSucessoEExibida()
    {
        $this->assertFalse($this->erro);
    }

    /**
     * @When nenhum dado é preenchido no formulário para criar uma nova tarefa
     */
    public function nenhumDadoEPreenchidoNoFormularioParaCriarUmaNovaTarefa()
    {
        $this->form = [];
    }

    /**
     * @Then uma mensagem de erro é exibida
     */
    public function umaMensagemDeErroEExibida()
    {
        $this->assertTrue($this->erro);
    }

    /**
     * @When o horário de início da tarefa é menor que o horário de fim
     */
    public function oHorarioDeInicioDaTarefaEMenorQueOHorarioDeFim()
    {
        $dataInicioValida = '2022-20-05';
        $horarioInicioValido = '22:00';
        $horarioFimInvalido = '20:00';
        
        $this->form['data'] = $dataInicioValida;
        $this->form['inicio'] = $horarioInicioValido;
        $this->form['fim'] = $horarioFimInvalido;
        $this->form['titulo'] = 'Assistir nova episódio da série';
    }

    /**
     * @Then a mensagem de horário de fim inválido é exibida
     */
    public function aMensagemDeHorarioDeFimInvalidoEExibida()
    {
        $this->assertEquals('O horário de fim é inválido', $this->msgErro);
    }

    /**
     * @When o campo :campoNaoPreenchido não é preenchido no formulário para criar uma nova tarefa
     */
    public function oCampoNaoEPreenchidoNoFormularioParaCriarUmaNovaTarefa($campoNaoPreenchido)
    {
        $dataInicioValida = '2022-20-05';
        $horarioInicioValido = '22:00';
        $horarioFimValido = '23:00';
        
        $this->form['data'] = $dataInicioValida;
        $this->form['inicio'] = $horarioInicioValido;
        $this->form['fim'] = $horarioFimValido;
        $this->form['titulo'] = 'Assistir nova episódio da série';
        unset($this->form[$campoNaoPreenchido]);
    }

    /**
     * @Then a mensagem :mensagemErro é exibida
     */
    public function aMensagemDeErroEExibida($mensagemErro)
    {
        $this->assertEquals($mensagemErro, $this->msgErro);
    }
    
    /**
     * @When a prioridade da tarefa não é informada
     */
    public function aPrioridadeDaTarefaNaoEInformada()
    {
        unset($this->form['prioridade']);
    }

    /**
     * @Then a prioridade da tarefa é definida como média
     */
    public function aPrioridadeDaTarefaEDefinidaComoMedia()
    {
        $this->assertEquals('media', $this->tarefa->getPrioridade());
    }

    /**
     * @When a prioridade da tarefa é informada como :prioridadeInformada
     */
    public function aPrioridadeDaTarefaEInformadaComo($prioridadeInformada)
    {
        $this->form['prioridade'] = $prioridadeInformada;
    }

    /**
     * @Then a prioridade da tarefa criade é :prioridadeEsperada
     */
    public function aPrioridadeDaTarefaCriadeE($prioridadeEsperada)
    {
        $this->assertEquals($prioridadeEsperada, $this->tarefa->getPrioridade());
    }
}
