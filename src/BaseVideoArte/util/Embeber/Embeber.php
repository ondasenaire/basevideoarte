<?php
namespace BaseVideoArte\Util\Embeber;
 class Embeber{
 	
	private $vimeo_oembed_endpoint = 'http://vimeo.com/api/oembed';
	private	$youtube_oembeb = 'http://www.youtube.com/oembed';
	
	
	public function getIframe(){
		
	}
	
	public function procesarURL(){
		
	}
	
	public function getVimeoURL($video_url){
		return $this->vimeo_oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width=380';
		
		
	}
	
	public function getYoutubeURL($video_url){
		return $this->youtube_oembeb.'?url=' . rawurlencode($video_url). '&maxwidth=380' ;
		
	}
	
	public function embeber($url){
			
		if( strpos($url,'vimeo') !== false ){
			$json = json_decode($this->curl_get($this->getVimeoURL($url) ));
			$embebido = $json->html;
			$mensaje = 'es un video de vimeo '.$this->getVimeoURL($url);
			
		}elseif (strpos($url,'youtube') !== false ){
			$json = json_decode($this->curl_get($this->getyoutubeURL($url) ));	
			$embebido = $json->html;			
			$mensaje = 'es un video de youtube '.$this->getyoutubeURL($url);
			
		}else {
			$mensaje = 'hubo error con ...';
			$embebido = ' a';
		}
	
		return $embebido;
	}
	
	
	public function getYoutubeId(){
		
	}
	
	public function getVimeoId(){
		
	}
	
	
	function curl_get($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    return $return;
}
	
}
?>