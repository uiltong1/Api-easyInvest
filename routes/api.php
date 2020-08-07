<?php

/*USUARIO*/
Route::post('register', 'api\UserController@registerUser'); //ROTA PARA REGISTRO DE NOVOS USUARIOS
Route::post('password/create', 'api\PasswordResetController@create'); //ROTA PARA CRIAR UMA SOLICITAÇÃO DE RECUPERAÇÃO DE SENHA
Route::get('password/find/{token}', 'api\PasswordResetController@find'); //ROTA PARA PEGAR DADOS DA SOLICITAÇÃO DE RECUPERAÇÃO DE SENHA
Route::post('password/reset', 'api\PasswordResetController@reset'); //ROTA PARA ALTERAR SENHA
Route::post('auth/login', 'api\AuthController@login'); //ROTA PARA FAZER LOGIN NO SISTEMA

/* ROTAS PROTEGIDAS POR AUTENTICAÇÃO */
Route::group(['middleware'=>['apiJwt']], function(){
/*USUARIO*/
Route::post('auth/logout', 'api\AuthController@logout'); //ROTA PARA SAIR DO SISTEMA
Route::get('users', 'api\UserController@listar'); //ROTA PARA LISTAR USUÁRIOS CADASTRADOS
/*PESSSOA*/
Route::apiResource('pessoas','api\PessoaController'); //ROTA PARA CONSULTAR DADOS PESSOAIS DE USUÁRIOS
Route::post('pessoa/create', 'api\PessoaController@create'); //ROTA PARA INSERIR DADOS PESSOAIS DE USUÁRIOS
Route::post('pessoa/update/{id}','api\PessoaController@update'); //ROTA PARA ALTERAR DADOS PESSOAIS DE USUÁRIOS
Route::delete('pessoa/delete/{id}','api\PessoaController@destroy'); //ROTA PARA EXCLUIR DADOS PESSOAIS DE USUÁRIOS
/*DESPESA*/
Route::get('despesas','api\DespesaController@index'); //ROTA PARA CONSULTAR DADOS DAS DESPEESAS DOS USUÁRIOS
Route::post('despesas/create', 'api\DespesaController@create'); //ROTA PARA INSERIR DADOS DE DESPESAS DO USUÁRIO
Route::post('despesas/update/{id}', 'api\DespesaController@update'); //ROTA PARA ATUALIZAR DADOS DE DESPESAS DO USUÁRIO
Route::delete('despesas/delete/{id}', 'api\DespesaController@destroy'); //ROTA PARA EXCLUIR DADOS DE DESPESAS DO USUÁRIO
Route::get('despesas/selectDespesas/{idusuario}', 'api\DespesaController@selectDespesas'); //ROTA PARA SELECIONAR DADOS DE DESPESAS DO USUÁRIO
Route::get('despesas/select/{id}/{idusuario}', 'api\DespesaController@selectDespesa'); //ROTA PARA SELECIONAR DADOS DE DESPESAS DO USUÁRIO
Route::get('despesas/despesaPeriodo/{idusuario}/{de}/{ate}', 'api\DespesaController@despesaPeriodo'); //ROTA PARA SELECIONAR DADOS DE DESPESAS DO USUÁRIO DURANTE UM DETERMINADO PERÍODO
Route::get('despesas/totaldespesa/{idusuario}', 'api\DespesaController@totalDespesa'); //ROTA PARA SELECIONAR TOTAL DE DESPESAS DO USUÁRIO 
Route::get('despesas/totaldespesaPeriodo/{idusuario}/{de}/{ate}', 'api\DespesaController@totalDespesaPeriodo'); //ROTA PARA SELECIONAR TOTAL DE DESPESAS DO USUÁRIO DURANTE UM DETERMINADO PERÍODO
Route::delete('despesas/deletelogic/{id}', 'api\DespesaController@logicDelete'); //ROTA PARA DESATIVAR DESPESA DO USUÁRIO
/*INVESTIMENTO*/
Route::get('investimentos','api\InvestimentoController@index'); //ROTA PARA CONSULTAR DADOS DAS INVESTIMENTOS DOS USUÁRIOS
Route::post('investimentos/create', 'api\InvestimentoController@create'); //ROTA PARA INSERIR DADOS DE INVESTIMENTOS DO USUÁRIO
Route::post('investimentos/update/{id}', 'api\InvestimentoController@update'); //ROTA PARA ATUALIZAR DADOS DE INVESTIMENTOS DO USUÁRIO
Route::delete('investimentos/delete/{id}', 'api\InvestimentoController@destroy'); //ROTA PARA EXCLUIR DADOS DE INVESTIMENTOS DO USUÁRIO
Route::get('investimentos/selectInvestimento/{idusuario}', 'api\InvestimentoController@selectInvestimentos'); //ROTA PARA SELECIONAR DADOS DE INVESTIMENTOS DO USUÁRIO
Route::get('investimentos/select/{id}/{idusuario}', 'api\InvestimentoController@selectInvestimento'); //ROTA PARA SELECIONAR DADOS DE INVESTIMENTOS DO USUÁRIO
Route::get('investimentos/investimentoPeriodo/{idusuario}/{de}/{ate}', 'api\InvestimentoController@investimentoPeriodo'); //ROTA PARA SELECIONAR DADOS DE INVESTIMENTOS DO USUÁRIO DURANTE UM DETERMINADO PERÍODO
Route::get('investimentos/totalinvestimento/{idusuario}', 'api\InvestimentoController@totalInvestimento'); //ROTA PARA SELECIONAR TOTAL DE INVESTIMENTOS DO USUÁRIO 
Route::get('investimentos/totalinvestimentoPeriodo/{idusuario}/{de}/{ate}', 'api\InvestimentoController@totalInvestimentoPeriodo'); //ROTA PARA SELECIONAR TOTAL DE INVESTIMENTOS DO USUÁRIO DURANTE UM DETERMINADO PERÍODO
Route::delete('investimentos/deletelogic/{id}', 'api\InvestimentoController@logicDelete'); //ROTA PARA DESATIVAR INVESTIMENTO DO USUÁRIO

});

