<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PedidoModel;

class PedidosController extends ResourceController
{
    protected $modelName = 'App\Models\PedidoModel';
    protected $format    = 'json';

    // GET /pedidos
    public function index()
    {
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Lista de pedidos obtida com sucesso"
            ],
            "retorno" => $this->model->findAll()
        ]);
    }

    // GET /pedidos/{id}
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Pedido não encontrado.');
        }
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Pedido encontrado com sucesso"
            ],
            "retorno" => $data
        ]);
    }

    // GET /pedidos/cliente/{cliente_ped}
    public function getByClientePed($cliente_ped = null)
    {
        $pedidos = $this->model->where('cliente_ped', $cliente_ped)->findAll();
        if (!$pedidos) {
            return $this->failNotFound('Nenhum pedido encontrado para este cliente.');
        }
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Pedidos encontrados com sucesso"
            ],
            "retorno" => $pedidos
        ]);
    }

    // GET /pedidos/preco/{preco_ped}
    public function getByPrecoPed($preco_ped = null)
    {
        $pedidos = $this->model->where('preco_ped', $preco_ped)->findAll();
        if (!$pedidos) {
            return $this->failNotFound('Nenhum pedido encontrado com este preço.');
        }
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Pedidos encontrados com sucesso"
            ],
            "retorno" => $pedidos
        ]);
    }

    // GET /pedidos/status/{status}
    public function getByStatus($status = null)
    {
        $pedidos = $this->model->where('status', $status)->findAll();
        if (!$pedidos) {
            return $this->failNotFound('Nenhum pedido encontrado com este status.');
        }
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Pedidos encontrados com sucesso"
            ],
            "retorno" => $pedidos
        ]);
    }

    // POST /pedidos
    public function create()
    {
        $data = $this->request->getJSON(true);
    
        if (isset($data['produtos_ped']) && is_array($data['produtos_ped'])) {
            // Certifique-se de que os dados estejam sendo convertidos corretamente para JSON
            $data['produtos_ped'] = json_encode($data['produtos_ped'], JSON_UNESCAPED_UNICODE);
        }
    
        if ($this->model->insert($data)) {
            return $this->respondCreated(['status' => 'Pedido criado com sucesso']);
        }
        
        return $this->failValidationErrors($this->model->errors());
    }
    // PUT /pedidos/{id}
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respond([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Pedido atualizado com sucesso"
                ],
                "retorno" => $data
            ]);
        }
        return $this->failValidationErrors($this->model->errors());
    }

    // DELETE /pedidos/{id}
    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Pedido excluído com sucesso"
                ]
            ]);
        }
        return $this->failNotFound('Pedido não encontrado.');
    }
}
