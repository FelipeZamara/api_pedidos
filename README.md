# API de Pedidos

## 📌 Sobre a API
Esta API foi desenvolvida utilizando **CodeIgniter 4** e **MySQL** para gerenciar pedidos e seus produtos.

## 🛠 Tecnologias Utilizadas
- **CodeIgniter 4** (Framework PHP)
- **MySQL** (Banco de Dados)
- **Composer** (Gerenciador de dependências)
- **Postman / Insomnia** (Para testar a API)

## 🚀 Configuração Inicial

### 📂 Clonar o repositório
```sh
git clone https://github.com/FelipeZamara/api_pedidos.git
cd api_pedidos
```

### ⚙️ Instalar dependências
```sh
composer install
```

### 🔧 Configurar o ambiente
Renomeie o arquivo `.env.example` para `.env` e edite as configurações do banco de dados:
```env
database.default.hostname = localhost
database.default.database = sua_base_de_dados
database.default.username = seu_usuario
database.default.password = 
database.default.DBDriver = MySQLi
```

### 🔄 Executar as migrações do banco de dados
```sh
php spark migrate
```

### 🚀 Iniciar o servidor
```sh
php spark serve
```
A API estará acessível em `http://localhost:8080`

---

## 📖 Endpoints

### CLIENTE E PRODUTO
### 1️⃣ Criar um Cliente
**Rota:** `POST /clientes`

#### Exemplo de Body (JSON):
```json
{
    "cpf_cnpj": "12345678901234",
    "nome_razao_social": "Nome do Cliente"
}
```

**Resposta esperada:**
```json
{
    "id": 1,
    "cpf_cnpj": "12345678901234",
    "nome_razao_social": "Nome do Cliente",
    "created_at": "2025-03-03T00:00:00",
    "updated_at": "2025-03-03T00:00:00"
}
```

### 2️⃣ Criar um Produto
**Rota:** `POST /produtos`

#### Exemplo de Body (JSON):
```json
{
    "nome": "Produto Exemplo",
    "preco_prod": 99.99
}
```

**Resposta esperada:**
```json
{
    "id": 1,
    "nome": "Produto Exemplo",
    "preco_prod": 99.99,
    "created_at": "2025-03-03T00:00:00",
    "updated_at": "2025-03-03T00:00:00"
}
```

### PEDIDO
### 1️⃣ Criar um Pedido
**Rota:** `POST /pedidos`

**Exemplo de Body (JSON):**
```json
{
    "client_ped": 1,
    "produtos_ped": [
        { "produto_id": 2, "quantidade": 1, "preco": 2998.98 },
        { "produto_id": 1, "quantidade": 1, "preco": 1999.90 }
    ],
    "preco_ped": 4998.97,
    "status": "Em Aberto"
}
```

**Resposta esperada:**
```json
{
    "status": "Pedido criado com sucesso"
}
```

### 2️⃣ Listar Todos os Pedidos
**Rota:** `GET /pedidos`

**Resposta esperada:**
```json
[
    {
        "id": 1,
        "client_ped": 1,
        "produtos_ped": [
            { "produto_id": 2, "quantidade": 1, "preco": 2998.98 },
            { "produto_id": 1, "quantidade": 1, "preco": 1999.90 }
        ],
        "preco_ped": 4998.97,
        "status": "Em Aberto"
    }
]
```

### 3️⃣ Atualizar um Pedido
**Rota:** `PUT /pedidos/{id}`

**Exemplo de Body:**
```json
{
    "status": "Finalizado"
}
```

**Resposta esperada:**
```json
{
    "status": "Pedido atualizado com sucesso"
}
```

### 4️⃣ Deletar um Pedido
**Rota:** `DELETE /pedidos/{id}`

**Resposta esperada:**
```json
{
    "status": "Pedido removido com sucesso"
}
```

---
