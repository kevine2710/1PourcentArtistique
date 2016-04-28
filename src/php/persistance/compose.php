<?php
	class Compose {

		require_once 'connectionDB.php';

		/**
		Name of the material used by art
		@var nameMaterial
		*/
		private $nameMaterial;

		/**
		Name of the art
		@var nameArt
		*/
		private $nameArt;

		private $db;

		public function __construct ($nameMaterial, $nameArt)
		{
			$this->db = connection();
			$this->nameMaterial = $nameMaterial;
			$this->nameArt = $nameArt;
		}

		public function save () {
			$insert = $this->db->prepare("INSERT INTO COMPOSE(nameMaterial, nameArt) 
				VALUES (?, ?)");
			return $insert->execute(array($this->nameMaterial, $this->nameArt));
		}
	
	    /**
	     * Gets the Name of the material used by art.
	     *
	     * @return nameMaterial
	     */
	    public function getNameMaterial()
	    {
	        return $this->nameMaterial;
	    }

	    /**
	     * Sets the Name of the material used by art.
	     *
	     * @param nameMaterial $newNameMaterial the name material
	     */
	    private function setNameMaterial($newNameMaterial)
	    {
	        $this->nameMaterial = $newNameMaterial;
	    }

	    /**
	     * Gets the Name of the art.
	     *
	     * @return nameArt
	     */
	    public function getNameArt()
	    {
	        return $this->nameArt;
	    }

	    /**
	     * Sets the Name of the art.
	     *
	     * @param nameArt $newNameArt the name art
	     */
	    private function setNameArt($newNameArt)
	    {
	        $this->nameArt = $newNameArt;
	    }
	}