<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ClienteModel;

class ClientesController extends ResourceController
{
    protected $modelName = 'App\Models\ClienteModel';
    protected $format    = 'json';

    // GET /clientes (R do CRUD)
    public function index()
    {
        $clientes = $this->model->findAll();
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Dados retornados com sucesso"
            ],
            "retorno" => $clientes
        ]);
    }

        // GET /clientes/cpf_cnpj/{cpf_cnpj} (Busca cliente por CPF/CNPJ)
        public function getByCpfCnpj($cpf_cnpj = null)
        {
            $cliente = $this->model->where('cpf_cnpj', trim($cpf_cnpj))->first();
    
            if (!$cliente) {
                return $this->respond([
                    "cabecalho" => [
                        "status" => 404,
                        "mensagem" => "Cliente não encontrado com este CPF/CNPJ."
                    ],
                    "retorno" => null
                ], 404);
            }
    
            return $this->respond([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Cliente encontrado com sucesso"
                ],
                "retorno" => $cliente
            ]);
        }
    
        // GET /clientes/nome/{nome_razao_social} (Busca clientes por nome ou razão social)
        public function getByNomeRazaoSocial($nome_razao_social = null)
        {
            $clientes = $this->model->like('nome_razao_social', $nome_razao_social)->findAll();
    
            if (empty($clientes)) {
                return $this->respond([
                    "cabecalho" => [
                        "status" => 404,
                        "mensagem" => "Nenhum cliente encontrado com este nome/razão social."
                    ],
                    "retorno" => []
                ], 404);
            }
    
            return $this->respond([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Clientes encontrados com sucesso"
                ],
                "retorno" => $clientes
            ]);
        }
        
    // GET /clientes/{id} (R do CRUD por ID)
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Cliente não encontrado.');
        }
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Cliente encontrado com sucesso"
            ],
            "retorno" => $data
        ]);
    }


    // POST /clientes (C do CRUD)
    public function create()
    {
        $data = $this->request->getJSON(true);
        if ($this->model->insert($data)) {
            return $this->respondCreated([
                "cabecalho" => [
                    "status" => 201,
                    "mensagem" => "Cliente criado com sucesso"
                ],
                "retorno" => $data
            ]);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    // PUT /clientes/{id} (U do CRUD)
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respond([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Cliente atualizado com sucesso"
                ],
                "retorno" => $data
            ]);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    // DELETE /clientes/{id} (D do CRUD)
    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Cliente excluído com sucesso"
                ],
                "retorno" => ["id" => $id]
            ]);
        }
        return $this->failNotFound('Cliente não encontrado.');
    }
}
