<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'account');
require "PHPMailer/src/PHPMailer.php"; 
require "PHPMailer/src/SMTP.php"; 
require 'PHPMailer/src/Exception.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Users{

	function __construct(){
		$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		$this->dbh=$con;
		// Check connection (Kiểm tra kết nối)
		if (mysqli_connect_errno())
			{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
 			}
	}
	
	// for username availblty (kiểm tra xem đã có email nào chưa)
	public function emailavailblty($email) {
		$sql = "SELECT email FROM users WHERE email='$email'";
		$result =mysqli_query($this->dbh,$sql);
		return $result;

	}
	//Function for check pass
	public function check_pass($password,$cpassword){
		if ($password == $cpassword){
			  
			return true;
		}else{
			return false;
		}
	}
	// Function for registration (Function cho đăng ký)
	public function registration($username,$email,$password){
		$sql = "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";
		//ret change register
		$register=mysqli_query($this->dbh,$sql);
	return $register;
	
	}
	// Function for signin (function cho đăng nhập)
	public function signin($email,$password){
		$sql = "SELECT id,email FROM users WHERE email='$email' AND password='$password'";
		$result=mysqli_query($this->dbh,$sql);
	return $result;
	}
	public function processSendEmail($email){
		//$email=$_POST['email'];
		$sql = "SELECT * FROM users WHERE email = '$email'";
		$result= mysqli_query($this->dbh,$sql);
		//$resu = mysqli_fetch_assoc($result);

		if (mysqli_num_rows($result) > 0) {
			$this->sendEmail($email);
			echo "<script>alert('You got an email');</script>";
		}
		else{
			echo "<script>alert('You need have an account');</script>";

		}
		
	}

	public function sendEmail($email){
		$username=$_POST['username'];
		$password=$_POST['password'];
	  

		$mail = new PHPMailer(true);//true:enables exceptions
            try {
                $mail->SMTPDebug = 0; //0,1,2: chế độ debug
                $mail->isSMTP();  
                $mail->CharSet  = "utf-8";
                $mail->Host = 'smtp.gmail.com';  //SMTP servers
                $mail->SMTPAuth = true; // Enable authentication
                $mail->Username = 'linh.nguyenthikhanh02@gmail.com'; // SMTP username
                $mail->Password = 'Khanhlinh112002.';   // SMTP password
                $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
                $mail->Port = 465;  // port to connect to                
                $mail->setFrom('linh.nguyenthikhanh02@gmail.com', 'Du lịt cùng cu pé' ); 
                $mail->addAddress($email); 
                $mail->isHTML(true);  // Set email format to HTML
    	        $mail->Subject = 'Verify your email';
                $mail->Body =  "<p>Hello .$email</p><br>
				<p>Mình thấy bạn [username: .$username] có hứng thú với việc đăng xuất khỏi trái Đất cùng Khánh Linh</p>
				<p style='color:red;'>Chúc bạn có mụt chiến du lịt vui vẻ *đá đít*</p>
				<p style='color:red;'>Đây là mật khẩu tài khoản \".$password\" đừng quyên mật khẩu để được đá đít nhìu lần nhé!</p>
				<button  style='color:yellow; background:black;'>Tin nhắn được gửi từ cu pé đáng iu nhứt hệ mặt trời</button>";
				//$mail->addAttachment('https://images.pexels.com/photos/1275393/pexels-photo-1275393.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'khanhlinh');
				// <p>You're receiving this email because you recently signed up for a Ben Quick account. 
				// To complete the signup process, hit the button below to verify your account.</p><br>
				// <a href='signin.php'><button>Verify email</button></a><br>
				// <p>If you didn't sign up for an account with us, please ignore this message :)</p>
				// <span>- Ben Quick Team</span>";
                $mail->smtpConnect( array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                ));
                $mail->send();
            } catch (Exception $e) {
                echo 'Error: ', $mail->ErrorInfo;
            }
	}
	
}
?>