<?php
include __DIR__.'/../db.php';
include __DIR__.'/../register/functions_def.php';


class Model {

    private $connection;

    function __construct() {
        $this->connection = DB::connect();
    }

    public function getDentists() {

        $sql = "SELECT dentists.picture,dentists.id,dentists.working_end,dentists.working_start, dentists.name as 'dentist', dentists.specialization, service.name , service.price , service.length , group_concat(appointment.time) as 'time', group_concat( appointment.date) as 'date', appointment.code, group_concat(appointment.active) as active FROM `dentists` LEFT JOIN dentist_service ON dentist_service.dentist_id = dentists.id LEFT JOIN service ON dentist_service.service_id = service.id LEFT JOIN appointments ON appointments.dentist_id = dentists.id LEFT JOIN appointment ON appointments.appointment_id = appointment.id GROUP BY dentists.id ";
        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateDentist(array $data) {

        $sql = "UPDATE `dentists` SET `working_end` = '$data[working_end]' , `working_start` = '$data[working_start]' WHERE `dentists`.`id` = '$_SESSION[id]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "Success";
    }

    public function updateDentistService(array $data) {

        $sql = "SELECT * FROM `dentist_service` WHERE dentist_id = '$data[id]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        if(!$result->num_rows){
            $sql = "INSERT INTO `dentist_service`(`dentist_id`, `service_id`) VALUES ('$data[id]','$data[service]')";
    
            $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     
        }else{
            $sql = "UPDATE `dentist_service` SET `service_id` = '$data[service]' WHERE dentist_id = '$data[id]'";
    
            $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        }

        return "Success";
    }

    public function bookDentist(array $data){
        if($data['date']){
            $onemonth = date('Y-m-d', strtotime("+1 month"));
            if($data['date'] < $onemonth){
                return "You can not book on that date.";
            }
        }

        $code = createCode(10);
        $sql = "INSERT INTO `appointment`(`date`, `time`, `code`,`userid`) VALUES ('$data[date]','$data[time]','$code', '$_SESSION[id]')";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));  
    
        $id = $this->connection->insert_id;

        $user = "SELECT email FROM `users` WHERE id_user = '$_SESSION[id]'";
        $userResult = mysqli_query($this->connection, $user) or die(mysqli_error($this->connection));    
    	$userResult = $userResult->fetch_all(MYSQLI_ASSOC);

        $header = "From: WEBMASTER <webmaster@vts.su.ac.rs>\n";
        $header .= "X-Sender: webmaster@vts.su.ac.rs\n";
        $header .= "X-Mailer: PHP/" . phpversion();
        $header .= "X-Priority: 1\n";
        $header .= "Reply-To:support@vts.su.ac.rs\r\n";
        $header .= "Content-Type: text/html; charset=UTF-8\n";
        $message = "";
        $message .= "Your code is : $code";
        $to = $userResult[0]['email'];
        $subject = "Book on Dentist";
        mail($to, $subject, $message, $header);

        $sql = "INSERT INTO `appointments` (`dentist_id`, `appointment_id`) VALUES ('$data[dentist]','$id')";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     
        
        return "Success";
    }

    public function queryServices(){
        $sql = "SELECT * FROM `service`";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));


        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function updateService(array $data) {

        $sql = "UPDATE `service` SET `length`='$data[length]',`price`='$data[price]',`name`='$data[name]' WHERE `service`.`id` = '$data[id]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "Success";
    }

    public function deleteService(array $data) {

        $sql = "DELETE FROM `service` WHERE `service`.`id` = '$data[id]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "Success";
    }
   
    public function createService(array $data) {

        $sql = "INSERT INTO `service`(`length`, `price`, `name`) VALUES ('$data[length]','$data[price]','$data[name]')";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "Success";
    }

    public function users() {

        $sql = "SELECT * FROM users WHERE user_type = '2'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function threatments() {

        $sql = "SELECT * FROM threament";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createThreatment(array $data) {

        $sql = "INSERT INTO `threament`(`threatment`, `price`, `picture`) VALUES ('$data[threatment]','$data[price]','$data[picture]')";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        $id = $this->connection->insert_id;
        
        $sql = "INSERT INTO `user_threatment`(`user_id`, `threatment_id`) VALUES ('$data[id]','$id')";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "Success";
    }

    public function getThreatment(array $data) {
        $id = 0;

        if(!isset($data['id'])){
            $id = $_SESSION['id'];
        }else{
            $id = $data['id'];
        }

        $sql = "SELECT * FROM `user_threatment` JOIN `threament` ON user_threatment.threatment_id = threament.id WHERE user_threatment.user_id =  '$id'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAppointments() {

        $sql = "SELECT * FROM `appointment` WHERE userid = $_SESSION[id]";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCurrentUser() {

        $sql = "SELECT firstname, lastname, phone FROM `users` WHERE id_user = $_SESSION[id]";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUser($data) {

        $sql = '';

        if(isset($data['password'])){
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE `users` SET `password` = '$password' WHERE `users`.`id_user` = $_SESSION[id]";
        }else{
            $sql = "UPDATE `users` SET `firstname` = '$data[first_name]', `lastname` = '$data[last_name]', `phone` = '$data[phone]' WHERE `users`.`id_user` = $_SESSION[id]";
        }

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "Success";
    }

    public function negativeUser($data) {


        $sql = "UPDATE `users` SET `negative_points` = negative_points + 1 WHERE `users`.`id_user` = '$data[id]'";


        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        $shouldBlock = "SELECT `negative_points` FROM `users` WHERE `users`.`id_user` = '$data[id]'";

        $shouldBlockRes = mysqli_query($this->connection, $shouldBlock) or die(mysqli_error($this->connection));
        
        $points = $shouldBlockRes->fetch_all(MYSQLI_ASSOC);

        if($points[0]['negative_points'] == '3'){
            $sql = "UPDATE `users` SET `active` = '0' WHERE `users`.`id_user` = '$data[id]'";
            $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        }
        return "Success";
    }

    public function cancelUser($data) {

        $active = "SELECT `active` FROM `users` WHERE `id_user` = '$data[id]'";
        $result = mysqli_query($this->connection, $active) or die(mysqli_error($this->connection));     
        $active = $result->fetch_all(MYSQLI_ASSOC);

        $message = "";
        if($active[0]['active'] == 0) {
            $active = 1;
            $message = "The user has been unlocked.";
        }else{
            $active = 0;
            $message = "The user has been blocked.";
        }

        $sql = "UPDATE `users` SET `active` = '$active' WHERE `users`.`id_user` = '$data[id]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $message;
    }

    public function updateAppointment($data) {
        if($data['date']){
            $onemonth = date('Y-m-d', strtotime("+1 month"));
            if($data['date'] < $onemonth){
                return "You can not book on that date.";
            }
        }

        $sql = "UPDATE `appointment` SET `date`='$data[date]',`time`='$data[time]' WHERE `code`='$data[code]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "Success";
    }
    
    public function deleteAppointment($data) {

        $sql = "DELETE FROM `appointments` WHERE `appointment_id`='$data[code]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     


        $sql = "DELETE FROM `appointment` WHERE `id`='$data[code]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "Success";
    }

    public function getAppointment($data) {

        $sql = "SELECT firstname, lastname, phone, date, time   FROM `appointment` JOIN users ON id_user = userid WHERE date = '$data[date]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function cancelAppointment($data) {
        
        $sql = "UPDATE `appointment` SET `active`='0' WHERE `code`='$data[code]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));   


        return "Success";
    }
    
}

?>

