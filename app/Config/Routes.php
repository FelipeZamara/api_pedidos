<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('clientes/cpf_cnpj/(:segment)', 'ClientesController::getByCpfCnpj/$1');
$routes->get('clientes/nome/(:any)', 'ClientesController::getByNomeRazaoSocial/$1');
$routes->get('produtos/nome/(:segment)', 'ProdutosController::getByNome/$1');
$routes->resource('clientes', ['controller' => 'ClientesController']);
$routes->resource('produtos', ['controller' => 'ProdutosController']);
$routes->resource('pedidos', ['controller' => 'PedidosController']);
