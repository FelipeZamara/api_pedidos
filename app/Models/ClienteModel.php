<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table      = 'clientes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['cpf_cnpj', 'nome_razao_social'];

    protected $useTimestamps = true;

    // Validações
    protected $validationRules = [
        'cpf_cnpj' => 'required|is_unique[clientes.cpf_cnpj]',
        'nome_razao_social' => 'required',
    ];
    protected $validationMessages = [
        'cpf_cnpj' => [
            'required' => 'O CPF ou CNPJ é obrigatório.',
            'is_unique' => 'Este CPF ou CNPJ já está cadastrado.',
        ],
        'nome_razao_social' => [
            'required' => 'O nome ou razão social é obrigatório.',
        ],
    ];
}
