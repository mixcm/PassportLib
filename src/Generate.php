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
    
    class Generate {

        public function from(){

            $arg = func_get_args();
            $r = [];
            foreach($arg as $k=>$v){
                $r = array_merge($r, $v);
            }

            return $r;

        }

        public function run($length = 50, $from = ['a','b','c','1','2','3']){
            
            $gen = "";
            $count = count($from);

            for($i = 0; $i < $length; $i++){
                $ch = $from[rand(0, $count-1)];
                $gen .= $ch;
            }

            return $gen;

        }

        public function __invoke($length = 50, $from = ['a','b','c','1','2','3']){
            return $this->run($length, $from);
        }

        public function salt($length = 60){

            return $this->run($length, $this->from(
                range('a', 'z'),
                range('A', 'Z'),
                range('0', '9'),
                ['_', '-', '&', '$', '=', '+', "/", "."]
            ));

        }

        public function uniqid(){
            $id = base64_encode(uniqid() . $this->salt(20) . rand(0,250));
            return $id;
        }

        public function secret($length = 120){
            return $this->run($length, $this->from(
                range('a', 'z'),
                range('A', 'Z'),
                range('0', '9'),
                ['_', '-', '&', '$', '=', '+', "/", "."]
            ));
        }

        public function string($length = 20){
            return $this->run($length, $this->from(
                range('a', 'z'),
                range('A', 'Z')
            ));
        }

    }