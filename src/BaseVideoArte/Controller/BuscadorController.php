<?php
namespace BaseVideoArte\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//formularios
use BaseVideoArte\Form\Buscador\BuscadorGeneralType;
use BaseVideoArte\Form\Buscador\BuscadorPersonasType;
use BaseVideoArte\Form\Buscador\BuscadorObrasType;

class BuscadorController {

	public function buscadoresAction(Application $app, Request $request) {

//  FORM GENERAL
		$buscadorGeneral = new BuscadorGeneralType();
		$form_general = $app["form.factory"] -> create($buscadorGeneral);
//  FORM PERSONAS		
		$buscadorPersonas = new BuscadorPersonasType();
		$form_personas = $app["form.factory"] -> create($buscadorPersonas);
//  FORM OBRAS
		$buscadorObras = new BuscadorObrasType();
		$form_obras = $app["form.factory"] -> create($buscadorObras);
//  FORM AVANZADo

// FORM EVENTOS

//---------------
		if ($request -> isMethod('POST')) {

			if ($request -> request -> has('buscador_general')) {
				echo 'buscador general';
			}

			if ($request -> request -> has('buscador_personas')) {
				echo 'buscador personas';
			}
			
			if ($request -> request -> has('buscador_obras')) {
				echo 'buscador obras';
			}

		}

		return $app['twig'] -> render('/busqueda.twig.html', 
				array('form_general' => $form_general -> createView(),
				'form_personas' => $form_personas -> createView(),
				'form_obras' => $form_obras -> createView(),
				 'pagina_actual'=>'busqueda'  ));

	}

	public function bucadorGeneral() {

	}

}
