
![Logo](https://ik.imagekit.io/nvc1oeg660m/paypro_a-b_E3Pmb.png?updatedAt=1694543532974)


## Stack utilizada

**Front-end:** Blade Components, TailwindCSS, AlpineJS

**Back-end:** Laravel, PHP, PestPHP


## Referência

 - [Laravel](https://laravel.com/)
  - [AlpineJS](https://alpinejs.dev/)
- [PestPHP](https://pestphp.com/)


 - [TailwindCSS](https://tailwindcss.com/)
 - [Actions Pattern](https://medium.com/@remi_collin/keeping-your-laravel-applications-dry-with-single-action-classes-6a950ec54d1d)



# Instalando o projeto

O projeto se utiliza de contêineres Docker, através do pacote *Laravel Sail* para facilitar a configuração do ambiente de desenvolvimento. Portanto, é necessário que já possua o Docker e o Docker Compose instalados na máquina.

Você é livre para rodar o projeto em ambiente local mas esse texto não tratará essa situação.

Links para instalação e configuração de Docker:

- [Windows](https://docs.docker.com/docker-for-windows/install/)
- [Linux (Debian based)](https://docs.docker.com/engine/install/ubuntu/)



### Observações
- O arquivo .env está sendo versionado somente para facilitar o setup do projeto, visto também que o projeto é privado, mas em hipótese alguma deve se versionar esse arquivo
- No cadastro de usuário coloque um cpf de formato válido (Pode utilizar gerador de cpf)

### Funcionalidades
- Cadastro de usuário
- Login de usuário
- Transação por boleto
- Transação por Pix
- Transação por cartão de crédito



### Passos para o rodar o projeto localmente:

- Faça um clone do projeto para sua máquina local
- acesse a pasta do projeto via console (terminal/PowerShell/CMD)
- execute o comando:
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
 ```
- Após finalizado processamento, execute o comando `./vendor/bin/sail up -d`

O primeiro comando realiza a instalação dos pacotes via composer especificados no arquivo `composer.json` e uma vez que a instalação termina, a pasta *vendor* passa a ficar disponível no projeto. O comando seguinte levanta os contêineres baseado na descrição de serviços feita no arquivo `docker-compose.yml`.

Por padrão, não é necessária nenhuma configuração no arquivo *.env* do projeto. Caso seja necessária alguma edição na configuração padrão (relacionado a binding ports ou credenciais de banco de dados), basta editar o arquivo *.env*.


O projeto vai estar disponível na porta definida no arquivo .env e você poderá acessar com `localhost:{PORT}`

### Rodando as migrations
- As migrations são arquivos que populam a base de dados com as tabelas pré definidas. Para rodar basta executar o seguinte comando dentro do projeto

```shell
./vendor/bin/sail artisan migrate

```

### Criar link simbólico para pasta public

```shell
./vendor/bin/sail artisan storage:link

```



### Instalar/Buildar depedências de Javascript

```shell
./vendor/bin/sail npm install
./vendor/bin/sail npm run build


```







## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
./vendor/bin/sail test
```


## Cartão de crédito para teste

- Aqui vão os dados do cartão de crédito que é aceito no ambiente de sandbox


**Nome cartão:**  marcelo h almeida

**número:** 5162306219378829

**cep:** 89223-005


**mês:** 05

**ano:** 2024

**ccv:** 318

**Número casa:** 200

**Número telefone:**: 4738010919















## Autores

- [@jeffersonsevero](https://www.github.com/octokatherine)
