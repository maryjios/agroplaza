<?php namespace App\Controllers\ModuloUsuarios;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class BuscarInactivos extends BaseController {

	public function index(){
		$data['modulo_selected'] = "Usuarios";
		$data['opcion_selected'] = "BuscarInactivos";

		echo view('template/header', $data);
		echo view('ModuloUsuarios/buscar_inactivos');
		echo view('template/footer');
	}	
	public function listarinactivos(){
		$usuarios = new UsuariosModel();
		$usuarios = $usuarios->select('*')->where('estado','INACTIVO')->findAll();
		if ($usuarios) {
			 echo json_encode($usuarios);
			
		} else {
			echo json_encode('error');
		
		}
		
	   
		
	}
  
}