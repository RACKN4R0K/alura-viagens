<?php

    class ValidadorCPF{

        public function ehValido($cpf){
            if(!ValidadorCPF:: ehCPF($cpf)) return false; //valido o regex

            $cpf_numeros = ValidadorCPF:: removeFormatacao($cpf);// removeu a formatação

            if(!ValidadorCPF::verificaNumerosIguais($cpf)) return false;// verificou se os dois digitos são iguais

            if(!ValidadorCPF::validadorDIgitos($cpf)) return false; // valido se os dois digitos são um CPFC


            return true;
        }
        private function ehCPF($cpf){
            $regex_cpf = "/^[0-9]{3}\.[0-9]{3}\.[0-9]{0-3}\-[0-9]{2}$/" ;
            return preg_match($regex_cpf ,$cpf);

        }
        private function  removeFormatacao($cpf){
            $somente_numero = str_replace([".", "-"], "", $cpf);
            // esse comando irá verificar todos os . e - do cpf e alterar por um vazio;
            return $somente_numero;
        }

        private function verificaNumerosIguais($cpf){
            for($i=0; $i<= 11; $i++){
                if(str_repeat($i, 11)== $cpf) return false;
            }
            return true;
        }

        private function validadorDIgitos($cpf){
            $primeiro_digito = 0;
            $segundo_digito = 0;

            for ($i=0, $peso = 10 ; $i <= 8; $i++, $peso--) { 
                $primeiro_digito += $cpf[$i] * $peso;
            }
            
            for ($i=0, $peso = 11 ; $i <= 9; $i++, $peso--) { 
                $segundo_digito += $cpf[$i] * $peso;
            }

            $calculo_um = (($primeiro_digito % 11) < 2) ? 0 : 11 - ($primeiro_digito % 11); 
            $calculo_dois = (($segundo_digito % 11) < 2) ? 0 : 11 - ($primeiro_digito % 11); 

            If($calculo_um<> $cpf[9] || $calculo_dois <> $cpf[10]) return false;

            return true;
        }

    }
    