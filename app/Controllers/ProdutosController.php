<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ProdutoModel;

class ProdutosController extends ResourceController
{
    protected $modelName = 'App\Models\ProdutoModel';
    protected $format    = 'json';

    // GET /produtos
    public function index()
    {
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Lista de produtos"
            ],
            "retorno" => $this->model->findAll()
        ]);
    }

    // GET /produtos/{id}
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Produto não encontrado.');
        }
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Produto encontrado com sucesso"
            ],
            "retorno" => $data
        ]);
    }

    // GET /produtos/nome/{nome}
    public function getByNome($nome = null)
    {
        $produtos = $this->model->like('nome', $nome)->findAll();
        if (empty($produtos)) {
            return $this->failNotFound('Nenhum produto encontrado com este nome.');
        }
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Produtos encontrados com sucesso"
            ],
            "retorno" => $produtos
        ]);
    }

    // POST /produtos
    public function create()
    {
        $data = $this->request->getJSON(true);
        if ($this->model->insert($data)) {
            return $this->respondCreated([
                "cabecalho" => [
                    "status" => 201,
                    "mensagem" => "Produto criado com sucesso"
                ],
                "retorno" => $data
            ]);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    // PUT /produtos/{id}
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respond([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Produto atualizado com sucesso"
                ],
                "retorno" => $data
            ]);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    // DELETE /produtos/{id}
    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Produto excluído com sucesso"
                ]
            ]);
        }
        return $this->failNotFound('Produto não encontrado.');
    }
}
