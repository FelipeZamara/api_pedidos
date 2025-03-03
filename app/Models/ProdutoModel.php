<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table      = 'produtos';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'preco_prod'];

    // Protege os campos de atualização automática
    protected $useTimestamps = true;

    // Validações
    protected $validationRules = [
        'nome' => 'required',
        'preco_prod' => 'required|decimal',
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'O nome do produto é obrigatório.',
        ],
        'preco_prod' => [
            'required' => 'O preço do produto é obrigatório.',
            'decimal' => 'O preço do produto deve ser um valor decimal.',
        ],
    ];
}
