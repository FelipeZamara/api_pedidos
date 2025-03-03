<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'client_ped' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'produtos_ped' => [
                'type' => 'JSON',
            ],
            'preco_ped' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Em Aberto', 'Pago', 'Cancelado'],
                'default' => 'Em Aberto'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pedidos');
        $this->forge->addForeignKey('client_ped', 'clientes', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('pedidos', 'pedidos_client_ped_foreign');
        $this->forge->dropTable('pedidos');
    }
}

/* 
exemplo de dado no campo produtos_ped:
{
    "produtos_ped": [
        {
            "produto_id": 1,
            "quantidade": 2,
            "preco": 29.90
        },
        {
            "produto_id": 3,
            "quantidade": 1,
            "preco": 15.50
        }
    ]
}
*/
