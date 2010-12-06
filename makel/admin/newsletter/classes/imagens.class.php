<?php

/**
 * Essa classe foi projetada com PHP5 e alterada para PHP4, pode n�o funcionar corretamente
 * Classe com m�todos para tratamentos de imagens
 * 
 */
 

class imagens extends upload
{
	var $nome;	       // @var  nome da imagm
	var $ext;      	   // @var  extens�o da imagem
	var $extensoes = array('jpg','jpeg','gif','png'); // @var  Extens�es permitidas para tratar a imagem	
	
	// M�todo para checar extens�o do arquivo
	function checaArquivo($nome)
	{
		strtolower($nome);
		$ext  = explode('.',$nome);
		if(!in_array($ext[1],$this->extensoes))
		{
			echo "Tipo de imagem n�o permitido";
			exit(1);
					
		} else {
			$this->ext = $ext[1];
			$this->setaNome($nome);
		}
	}
	
	// M�todo para alterar o nome da imagem
	function  setaNome($nome)
	{
		$this->nome = $nome;
	}	

	// M�todo para configurar altura e tamanho da imagem
	function redimensiona($nome,$x,$y)
	{		
		$this->checaArquivo($nome);				
		
		switch($this->ext) 
		{
			case 'jpg': $imagem = imagecreatefromjpeg($this->pegaDir() . "/" . $this->nome);
			break;
			case 'jpeg': $imagem = imagecreatefromjpeg($this->pegaDir() . "/" . $this->nome);
			break;			
			case 'gif': $imagem = imagecreatefromgif($this->pegaDir() . "/" . $this->nome);
			break;			
			case 'png': $imagem = imagecreatefrompng($this->pegaDir() . "/" . $this->nome);
			break;
		}		
		
		$largura = imagesx($imagem); 
		$altura  = imagesy($imagem);

		if($x!=0 and $y!=0) 
		{
			$nx = $x;
			$ny = $y;
		} 
		elseif($x!=0 and $y==0) 
		{
			$nx = $x;
			$ny = ($altura*$nx)/$largura;
		} 
		elseif($x==0 and $y!=0) 
		{
			$nx = ($largura*$ny)/$altura;
			$ny = $y;
		}
		
		$nova_imagem = imagecreatetruecolor($nx, $ny);
		imagecopyresampled($nova_imagem, $imagem, 0, 0, 0, 0, $nx, $ny, $largura, $altura);
		imagedestroy($imagem);
		
		switch($this->ext) 
		{
			case 'jpg': 
			case 'jpeg': imagejpeg($nova_imagem, $this->pegaDir() . "/" . $this->nome,100);
			break;			
			case 'gif': imagegif($nova_imagem, $this->pegaDir() . "/" . $this->nome);
			break;
			case 'png': imagepng($nova_imagem, $this->pegaDir() . "/" . $this->nome);
			break;
		}				
		imagedestroy($nova_imagem); 		
	}	
	
}
 
?>