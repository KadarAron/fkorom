<?php
require_once 'model.php';

class Controller {

    private $query;
    
    function __construct() {
        $this->query = new Model();
    }


    public function updateDentist(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->updateDentist($array),
        ];
        
        return json_encode($response);
    }

    public function updateDentistService(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->updateDentistService($array),
        ];
        
        return json_encode($response);
    }

    public function bookDentist(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->bookDentist($array),
        ];
        
        return json_encode($response);
    }
    
    public function updateService(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->updateService($array),
        ];
        
        return json_encode($response);
    }

    public function deleteService(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->deleteService($array),
        ];
        
        return json_encode($response);
    }

    public function createService(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->createService($array),
        ];
        
        return json_encode($response);
    }

    public function createThreatment(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->createThreatment($array),
        ];
        
        return json_encode($response);
    }

    public function getThreatment(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->getThreatment($array),
        ];
        
        return json_encode($response);
    }

    public function updateUser(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->updateUser($array),
        ];
        
        return json_encode($response);

    }

    public function negativeUser(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->negativeUser($array),
        ];
        
        return json_encode($response);

    }

    public function updateAppointment(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->updateAppointment($array),
        ];
        
        return json_encode($response);

    }

    public function deleteAppointment(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->deleteAppointment($array),
        ];
        
        return json_encode($response);

    }

    public function getAppointment(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->getAppointment($array),
        ];
        
        return json_encode($response);

    }

    public function cancelAppointment(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->cancelAppointment($array),
        ];
        
        return json_encode($response);

    }

    public function cancelUser(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->cancelUser($array),
        ];
        
        return json_encode($response);

    }
    
}

?>