# language: pt

Funcionalidade: Criar uma nova tarefa

    Como usuário do app
    Eu quero criar uma nova tarefa
    Para que eu possa lembrar de fazê-la

    Contexto: Iniciar na tela de criação de tarefas
        Dado que está na tela de criar uma nova tarefa

        @alta-prioridade
        Cenário: Criar uma tarefa com sucesso
            Quando são preenchidos dados válidos no formulário
            E tenta salvar a tarefa
            Então uma mensagem de sucesso é exibida

        @media-prioridade
        Cenário: Tentar criar tarefa sem informar nenhum dado
            Quando nenhum dado é preenchido no formulário para criar uma nova tarefa
            E tenta salvar a tarefa
            Então uma mensagem de erro é exibida

        @media-prioridade
        Cenário: Tentar criar tarefa com horário de fim menor que horário de início
            Quando o horário de início da tarefa é menor que o horário de fim
            E tenta salvar a tarefa
            Então a mensagem de horário de fim inválido é exibida
        
        @baixa-prioridade
        Esquema do Cenário: Tentar criar tarefa sem informar dado obrigatório
            Quando o campo "<campo>" não é preenchido no formulário para criar uma nova tarefa
            E tenta salvar a tarefa
            Então a mensagem "<mensagem>" é exibida

            Exemplos:
            | campo  | mensagem                          |
            | data   | A data é obrigatória              |
            | inicio | O horário de início é obrigatório |
            | fim    | O horário de fim é obrigatório    |
            | titulo | O título é obrigatório            |

        Cenário: Definir prioridade média quando a prioridade da tarefa não for informada
            Quando são preenchidos dados válidos no formulário
            Mas a prioridade da tarefa não é informada
            E tenta salvar a tarefa
            Então a prioridade da tarefa é definida como média

        Esquema do Cenário: Verifica que as prioridades estão sendo atribuídas corretamente
            Quando são preenchidos dados válidos no formulário
            E a prioridade da tarefa é informada como "<prioridade-informada>"
            E tenta salvar a tarefa
            Então a prioridade da tarefa criade é "<prioridade-esperada>"

            Exemplos:
            | prioridade-informada | prioridade-esperada |
            | alta                 | alta                |
            | media                | media               |
            | baixa                | baixa               |