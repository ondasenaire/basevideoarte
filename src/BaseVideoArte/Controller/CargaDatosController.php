<?php
namespace BaseVideoArte\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
// src/BaseVideoArte/Controladores/VideoArteController.php

use BaseVideoArte\Entidades\Pais;
use BaseVideoArte\Entidades\Persona;

class CargaDatosController {
	

	//----------------------------------------------------------------
	// PERSONAS
	public function cargarDatosAction(Application $app) {
		$paises = $this->cargarPaises();
		
		
		//---PERSONAS--
		$denegri = new Persona('Andrés','Denegri','Es realizador independiente de cine, video y TV, 
		siguiendo una marcada tendencia de experimentación visual y narrativa, traspasa los formatos 
		clásicos al producir composiciones audiovisuales en vivo y trabajar también en el terreno de 
		las instalaciones. Estudió cinematografía en la Universidad del Cine, donde hoy se desempeña 
		como docente en la Carrera de Dirección Cinematográfica. También dicta clases en la Licenciatura
		 en Artes Visuales del Instituto Universitario Nacional de Artes (IUNA) y en la Licenciatura en 
		 Artes Electrónicas en la Universidad Nacional de Tres de Febrero (UNTREF), donde desarrolló y 
		 dirige CONTINENTE centro de investigación y desarrollos curatoriales, dedicado al respaldo y
		  la difusión de la creación audiovisual regional'
		  ,'1990','http://www2.sescsp.org.br/sesc/videobrasil/site/dossier022/bio_en.asp','h',true);
		
		$denegri->setPais($paises['argentina']);
		$personas[]= $denegri;
		//---
		$khourian = new Persona('Hernán','Khourián','','2000','http://www.hernankhourian.com.ar/','h',true);
		$khourian->setPais($paises['argentina']);	
		$personas[]= $khourian;
		//---
		$bambozzi = new Persona('lucas','bambozzi','Lucas Bambozzi is a multimedia artist based in São Paulo, Brazil. His works are constituted by pieces dealing with media in a wide variety of formats, such as installations, single channel videos, short films and interactive projects. His works have been shown in solo and collective exhibitions in more than 40 countries, often collecting relevant awards and prizes.
		  Was a visiting artist at the CAiiA-STAR Centre – currently operating as Planetary Collegium, where he 
		  has developed an extensive research about on-line privacy and pervasive systems, as part of his MPHIL 
		  studies, concluded in 2006 at the University of Plymouth, UK. Some curatorial projects include 
		  SonarSound (2004); Digitofagia (2004); Life Goes Mobile (Nokiatrends 2005 and 2006), Motomix Art 
		  & Music Festival (2006), O Lugar Dissonante (2009) among other shows. He is one of the initiators 
		  and curators of the arte.mov, International Mobile Media Art Festival (2006-2011). Took part in the 
		  collectives FAQ/feitoamãos and Cobaia, dealing with live video performances and media intervention 
		  projects in public spaces. Recent exhibitions: Interconnect at ZKM, Karlsruhe/Germany (2006), 
		  Pensé Sauvage at Frankfurter Kunstverein in Germany (2007) Emergentes at Laboral, (2007/2008) 
		  Gijon/Spain and Fundación Telefonica (2008), Buenos Aires/Argentina, RE:akt!, reconstruction, 
		  re-enactment, re-reporting, exhibited both at ŠKUC gallery, Ljubljana/Slovenia  and at Museum of 
		  Contemporary Art Rijeka/ Croatia (2009) and Restraint at Oboros Montreal/Canada. In 2010 took p
		  art in exhibitions at ISEA in Dortmund, Germany and at Ars Eletrônica, in Linz, Áustria. In 2011 
		  has a retrospective of his works at the Laboratorio Arte Alameda, in Mexico DF.','1990',
		  'http://www.lucasbambozzi.net/ - http://www.comum.com/lucas/','h',true);
		$bambozzi->setPais($paises['brasil']);
		$personas[]= $bambozzi;
		
		//--- diaz morales
		
		$diazMorales = new Persona('sebastían','Diaz Morales','','1990','http://www.sebastiandiazmorales.com/','h',true);
		$diazMorales->setPais($paises['argentina']);
		$personas[]= $diazMorales;
		
		//--- galuppo
		
		$galuppo = new Persona('Gustavo','Galuppo','','1990','http://boladenieve.org.ar/artista/8505/galuppo-gustavo','h',true);
		$galuppo->setPais($paises['argentina']);
		$personas[]= $galuppo;
		
		//--- Szperling
		
		$szperling = new Persona('Silvina','Szperling','','1990','http://www.videodanzaba.com.ar/szdanza/silvinasz-bio-es.htm','m',true);
		$szperling->setPais($paises['argentina']);
		$personas[]= $szperling;
		
		//--- Marino
		
		$marino = new Persona('Ivan','Marino','','1990','http://ivan-marino.net/','h',true);
		$marino->setPais($paises['argentina']);
		$personas[]= $marino;
		
		//---BRASIL
		//--- Marino
		
		$guimares = new Persona('Cao','Guimarães','','1990','http://www.caoguimaraes.com/','h',true);
		$guimares->setPais($paises['brasil']);
		$personas[]= $guimares;
		
		
		$cardoso = new Persona('Inés','Cardoso','','1990','http://vimeo.com/user2595777 - http://www2.sescsp.org.br/sesc/videobrasil/vbonline/bd/index.asp?cd_entidade=21274&cd_idioma=18531','m',true);
		$cardoso->setPais($paises['brasil']);
		$personas[]= $cardoso;
		
		$meneghetti = new Persona('César','Meneghetti','','1990','http://www.cesarmeneghetti.net/','h',true);
		$meneghetti->setPais($paises['brasil']);
		$personas[]= $meneghetti;
		
		
		$morales = new Persona('Wagner','Morales','','1990','http://www.videobrasil.org.br/ffdossier/ffdossier002/eng/ind.htm','h',true);
		$morales->setPais($paises['brasil']);
		$personas[]= $morales;
		
		
		$oliveira = new Persona('Solange','Oliveira Farkas','','1980','http://universes-in-universe.org/eng/bien/sesc_videobrasil/2011/solange_farkas','m',true);
		$oliveira->setPais($paises['brasil']);
		$personas[]= $oliveira;
		
		//----CHILE--
		
		$aravena = new Persona('Claudia','Aravena','','1990','http://www.claudiaaravenaabughosh.cl/ - http://www2.sescsp.org.br/sesc/videobrasil/site/dossier024/apresenta_en.asp','m',true);
		$aravena->setPais($paises['chile']);
		$personas[]= $aravena;	
		
		
		
		$cifuentes = new Persona('Guillermo','Cifuentes','','1990','http://revista.escaner.cl/node/192','h',true);
		$cifuentes->setPais($paises['chile']);
		$personas[]= $cifuentes;	
		
		
		$endress = new Persona('Edgar','Endress','','1990','http://eendress.wordpress.com/','h',true);
		$endress->setPais($paises['chile']);
		$personas[]= $endress;	
		
		$ramirez = new Persona('Enrique','Ramirez','','1990','http://www.enriqueramirez.net','h',true);
		$ramirez->setPais($paises['chile']);
		$personas[]= $ramirez;	
		
		$saquel = new Persona('Carolina','Saquel','','1990','http://www.carolinasaquel.com/','m',true);
		$saquel->setPais($paises['chile']);
		$personas[]= $saquel;	
		
		//----PARAGUAY
		
			
		$casco = new Persona('Fredi','Casco','','1990','http://www.nuestramirada.org/profile/fredicasco','h',true);
		$casco->setPais($paises['paraguay']);
		$personas[]= $casco;	
	
		$encina = new Persona('Paz','Encina','','1990','https://vimeo.com/user7170507','m',true);
		$encina->setPais($paises['paraguay']);
		$personas[]= $encina;		
		
		
		//---URUGUAY
		
		$aguerre = new Persona('Enrique','Aguerre','','1980','http://netart.org.uy/interfaces02/uy/aguerre_bio.html','h',true);
		$aguerre->setPais($paises['uruguay']);
		$personas[]= $aguerre;	
		
		$puppo = new Persona('Teresa','Puppo','','1990','http://teresapuppo.com/','m',true);
		$puppo->setPais($paises['uruguay']);
		$personas[]= $puppo;	
		
		//---------------
		foreach ($paises as $pais) {
			$app['db.orm.em']->persist( $pais);
		}
		
		foreach ($personas as $persona) {
			echo $persona->getApellido().'  <br>';
			$app['db.orm.em']->persist( $persona);
		}
		
		
		$app['db.orm.em']->flush();
		
		return new Response("");
	}


	

	public function cargarPaises(){
		$paises = array();
		$paises['argentina'] = new Pais('argentina');
		$paises['brasil'] = new Pais('brasil');
		$paises['bolivia'] = new Pais('bolivia');
		$paises['chile'] = new Pais('chile');
		$paises['colombia'] = new Pais('colombia');
		$paises['cuba'] = new Pais('cuba');
		$paises['ecuador'] = new Pais('ecuador');
		$paises['peru'] = new Pais('peru');
		$paises['paraguay'] = new Pais('paraguay');
		$paises['venezuela'] = new Pais('venezuela');
		return $paises;
	}
	

}
