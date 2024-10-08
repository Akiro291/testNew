<?php 
namespace app\presenters;

require_once '../interfaces/TechnicInterface.php';
require_once '../models/Car.php';
require_once '../models/Tank.php';

use interfaces\TechnicInterface;
use Models\Car;
use Models\Tank;

class TechnicPresenter {
    private TechnicInterface $modelInlet;

    public function __construct(TechnicInterface $model) {
        $this->modelInlet = $model;
    }
    
    public function displayInfo() {
        return $this->modelInlet->displayInfo();
    }
    
    public function getTechnic() {
        return $this->modelInlet;
    }
    
    public function displayName() {
        if ($this->modelInlet instanceof Car) {
            return htmlspecialchars($this->modelInlet->getName());
        } elseif ($this->modelInlet instanceof Tank) {
            return htmlspecialchars($this->modelInlet->getTitle());
        }
        return '';
    }

    public function displayAdditionalInfo() {
        if ($this->modelInlet instanceof Car) {
            return "Speed: " . htmlspecialchars($this->modelInlet->getSpeed()) . ", Production Date: " . htmlspecialchars($this->modelInlet->getProductionDate());
        } elseif ($this->modelInlet instanceof Tank) {
            return "Max Speed: " . htmlspecialchars($this->modelInlet->getMaxSpeed()) . ", Weight: " . htmlspecialchars($this->modelInlet->getWeight());
        }
        return '';
    }
}
