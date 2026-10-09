# Oficina 3.0 — Sistema de Gestão de Orçamentos

Projeto de estudos desenvolvido com **PHP e Laravel** para praticar o gerenciamento de orçamentos de uma oficina mecânica. A aplicação oferece uma **interface web** para operações do dia a dia e uma **API REST** que disponibiliza os dados em JSON.

> **Sobre o projeto:** desenvolvido como exercício prático com acompanhamento de uma playlist de aulas no YouTube e apoio do ChatGPT para esclarecer dúvidas e resolver problemas durante o desenvolvimento.

## Funcionalidades

- Cadastro de orçamentos.
- Listagem paginada de orçamentos, com os mais recentes primeiro.
- Visualização dos detalhes de um orçamento.
- Edição e exclusão de registros.
- Pesquisa por cliente, vendedor e intervalo de datas na interface web.
- API REST para listar, consultar, cadastrar, atualizar e excluir orçamentos.
- Validação de dados por meio de Form Requests do Laravel.
- Respostas JSON estruturadas com API Resources e paginação na listagem da API.

## Tecnologias

- **PHP 8.3** no ambiente Docker/Sail configurado no projeto.
- **Laravel 9** — framework backend.
- **MySQL 8** — banco de dados relacional.
- **Laravel Sail e Docker Compose** — ambiente de desenvolvimento em contêineres.
- **Blade** — renderização das páginas web.
- **Laravel Mix, Tailwind CSS e Alpine.js** — ferramentas/dependências de frontend presentes no projeto.
- **phpMyAdmin** — interface auxiliar para inspecionar o banco localmente.

## Como executar localmente

### Pré-requisitos

- Git
- Docker com Docker Compose
- PHP e Composer disponíveis no computador para a instalação inicial das dependências, caso a pasta `vendor` ainda não exista

### Instalação

1. Clone o repositório e acesse a pasta:

   ```bash
   git clone https://github.com/jota12344/oficina3.0.git
   cd oficina3.0
   ```

2. Instale as dependências PHP e crie o arquivo de configuração local:

   ```bash
   composer install
   cp .env.example .env
   ```

3. Configure o `.env` para seu ambiente local. Confira especialmente estas variáveis:

   ```dotenv
   APP_NAME=Oficina
   APP_URL=http://localhost:8080
   APP_PORT=8080
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=oficina
   DB_USERNAME=sail
   DB_PASSWORD=password
   WWWUSER=1000
   WWWGROUP=1000
   ```

   Os valores acima são **exemplos para desenvolvimento local**. Ajuste `WWWUSER` e `WWWGROUP` conforme o UID/GID do seu usuário Linux (`id -u` e `id -g`). Não utilize essas credenciais de exemplo em produção. O arquivo `.env` não deve ser versionado.

4. Inicie os contêineres:

   ```bash
   docker compose up -d
   ```

5. Gere a chave da aplicação e execute as migrations:

   ```bash
   ./vendor/bin/sail artisan key:generate
   ./vendor/bin/sail artisan migrate
   ```

   **Atenção:** a configuração de banco precisa estar correta antes de executar as migrations. Não utilize `migrate:fresh` em um banco que contenha dados que você deseja preservar.

6. Acesse a aplicação:

   - **Orçamentos (interface web):** http://localhost:8080/budgets
   - **API (listagem JSON):** http://localhost:8080/api/budgets
   - **phpMyAdmin:** http://localhost:8081

### Recursos de frontend

O projeto contém dependências de frontend em `package.json`. Caso seja necessário recompilar os arquivos estáticos, instale as dependências com `npm install` e execute `npm run dev` no ambiente Node.js compatível com o projeto. Para uma instalação nova, vale verificar a compatibilidade das versões legadas do Laravel Mix antes de compilar.

## API REST

As rotas abaixo estão definidas em `routes/api.php`:

| Método | Endpoint | Descrição |
| --- | --- | --- |
| `GET` | `/api/budgets` | Lista orçamentos, com paginação de 10 registros |
| `GET` | `/api/budgets/{id}` | Consulta um orçamento pelo ID |
| `POST` | `/api/budgets` | Cadastra um orçamento |
| `PUT` | `/api/budgets/{id}` | Atualiza um orçamento |
| `DELETE` | `/api/budgets/{id}` | Exclui um orçamento |

Exemplo de consulta:

```bash
curl -H 'Accept: application/json' http://localhost:8080/api/budgets
```

A listagem utiliza `BudgetResource` para formatar os dados e inclui informações de paginação. As rotas de criação e atualização utilizam validação com `StoreBudgetRequest` e `UpdateBudgetRequest`.

> **Observação de segurança:** as rotas de orçamentos da API estão declaradas sem middleware de autenticação específico. O projeto deve ser tratado como **ambiente de estudos/local**, não como sistema pronto para exposição pública ou uso em produção.

## Estrutura principal

```text
app/
  Http/
    Controllers/BudgetController.php  # Ações web e da API
    Resources/BudgetResource.php      # Formatação de respostas JSON
    Requests/                        # Validação de entrada
  Models/Budget.php                   # Modelo de orçamento
routes/
  web.php                             # Rotas da interface web
  api.php                             # Rotas REST
```

## Aprendizados

Durante o desenvolvimento, pratiquei conceitos de **CRUD**, rotas e controllers do Laravel, integração com MySQL, consultas com Eloquent, validação de requisições, paginação, respostas JSON com Resources e execução de aplicações com Docker.

## Referência e créditos

Projeto realizado para fins de aprendizado, acompanhando uma [playlist de aulas no YouTube](https://www.youtube.com/watch?v=rljzeWpPNYU&list=PLVSNL1PHDWvQwfqqY7XSobGuV39KsM46G), com consultas ao ChatGPT para tirar dúvidas e apoiar a resolução de problemas.

## Autor

**Jonathan Figueiredo de Brito**  
[GitHub — jota12344](https://github.com/jota12344)

---

**Status:** projeto de estudos. Melhorias futuras podem incluir autenticação/autorização, testes automatizados, revisão de segurança e atualização de dependências.
