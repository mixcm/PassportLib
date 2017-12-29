<?php
    /**
     * Mixcm PassportLib
     * 
     * @author Tianle Xu <xtl@xtlsoft.top>
     * @package PassportLib
     * @license MIT
     * 
     */

    namespace Mixcm\PassportLib;
    
    class Password {

        public function encrypt($password, $salt, $algo = "x"){

            if($algo != "x"){
                throw new \Exception('Mixcm_PassportLib_Error: Undefined Algorithm : '.$algo);
            }

            $password = hash('sha512', $password);
            $password = hash('sha512', ($salt . $password . 'password') );
            $password = hash('sha512', ('algox' . $salt . $password . 'algox'));
            $password = base64_encode($password);

            $salt = base64_encode($salt);

            $password = "x;=;$password;.;$salt";

            return $password;

        }

        public function check($input, $password){

            $p = explode(';=;', $password);
            $algo = $p[0];
            $password = $p[1];

            switch($algo){
                case 'x': 

                    $pass1 = explode(';.;', $password);
                    $pass = $pass1[0];
                    $salt = base64_decode($pass1[1]);

                    $input = hash('sha512', $input);
                    $input = hash('sha512', ($salt . $input . 'password') );
                    $input = hash('sha512', ('algox' . $salt . $input . 'algox'));
                    $input = base64_encode($input);
                    
                    if($input === $pass){
                        return true;
                    }else{
                        return false;
                    }

                    break;
                
                case 'plain':
                    
                    $pass = $password;
                    if($input == $pass){
                        return true;
                    }else{
                        return false;
                    }
                    
                    break;
                
                default:
                    throw new \Exception("Unknown Encrypt Algorithm: $algo");
            }

        }

    }
