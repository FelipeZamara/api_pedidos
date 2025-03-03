<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table      = 'pedidos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['client_ped', 'produtos_ped', 'preco_ped', 'status'];
    protected $useTimestamps = true;

    // Validações
    protected $validationRules = [
        'cliente_ped' => 'required|is_natural_no_zero',  // Garante que o id do cliente é um numero válido
        'produtos_ped' => 'required',
        'preco_ped' => 'required|decimal',
        'status' => 'required|in_list[Em Aberto,Pago,Cancelado]',
    ];

    protected $validationMessages = [
        'client_ped' => [
            'required' => 'O cliente é obrigatório.',
            'is_natural_no_zero' => 'O ID do cliente deve ser um número válido.',
        ],
        'produtos_ped' => [
            'required' => 'Os produtos do pedido são obrigatórios.',
        ],
        'preco_ped' => [
            'required' => 'O preço do pedido é obrigatório.',
            'decimal' => 'O preço do pedido deve ser um valor decimal.',
        ],
        'status' => [
            'required' => 'O status do pedido é obrigatório.',
            'in_list' => 'O status do pedido deve ser um dos seguintes: Em Aberto, Pago ou Cancelado.',
        ],
    ];

    protected array $casts = [
        'produtos_ped' => 'json-array', // Garante que o JSON seja convertido para array
    ];


    // Relacionamento com cliente
    public function getCliente($id)
    {
        $clienteModel = new ClienteModel();
        return $clienteModel->find($id);
    }
}