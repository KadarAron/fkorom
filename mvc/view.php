<?php
require_once "model.php";

class View {

    private $query;
    
    function __construct() {
        $this->query = new Model();
    }

    public function getDentists() {
        $renderData = $this->query->getDentists();

        return $renderData;
    }

    public function renderFilter() {
        $renderData = $this->query->queryServices();

        return $renderData;
    }

    public function users() {
        $renderData = $this->query->users();

        return $renderData;
    }

    public function threatments() {
        $renderData = $this->query->threatments();

        return $renderData;
    }

    public function getCurrentUser() {
        $renderData = $this->query->getCurrentUser();

        return $renderData;
    }

    public function getThreatment() {
        $renderData = $this->query->getThreatment([]);

        return $renderData;
    }

    public function getAppointments() {
        $renderData = $this->query->getAppointments();

        return $renderData;
    }

}

?>